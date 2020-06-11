<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class MiscajaxController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function setBgmon(Request $request) {
        $user = Auth::user();
        $val = $request->input('bg_val');

        DB::update('UPDATE users SET bgm_on=? WHERE id=?', [$val, $user->id]);
        $result_array = array('result' => 'success');
        return response()->json($result_array);
    }
    public function mailToWinner(Request $request){
      $user = Auth::user();
      if(!$user){
        exit;
      }
      $to = $user->email;
      $subject = 'Congratulations!!';
      $data = [
          'title' => 'Congratulations!!',
          'user'  => $user->name
      ];

      // Mail::send('prizewinnermail', $data, function($message) use($to, $subject) {
      //     $message->to($to)->subject($subject);
      // });
      Mail::to($to)->send(new SendMail($data));
      exit;
    }
    public function getSpinRemains(Request $request){
      $user = Auth::user();
      $prize_id = $request->input('prize_id');
      $prize_user_info = DB::table('user_prize')->where([['prize_id', '=', $prize_id], ['user_id', '=', $user->id]])->get()->first();
      echo $prize_user_info->spin_count;
      exit;
    }
    public function getPrizeIndex(Request $request) {
        $user = Auth::user();
        $prize_id = $request->input('prize_id');
        $prize_info = DB::table('prizes')->where('id', $prize_id)->get()->first();
        $prize_user_info = DB::table('user_prize')->where([['prize_id', '=', $prize_id], ['user_id', '=', $user->id]])->get()->first();
        $spin_times = 1;
        $spin_indexs = config('constants.spin_indexs');
        $query="SELECT spin_index,count(spin_index) AS scount FROM user_prize_won WHERE prize_id={$prize_id} GROUP BY spin_index";
        $prize_wins_infos=DB::select($query);
        $prize_win_remains=array();
        foreach ($spin_indexs as $key => $spin_index) {
            $table_filed=$spin_indexs[$key][3];
            if(isset($prize_info->$table_filed)){
                $prize_win_remains[$key]=$prize_info->$table_filed;
            }else{
                $prize_win_remains[$key]=$spin_index[2];
            }
        }
        foreach($prize_wins_infos as $prize_wins_info){
            $table_filed=$spin_indexs[$prize_wins_info->spin_index][3];
            $prize_win_remains[$prize_wins_info->spin_index]=$prize_info->$table_filed-$prize_wins_info->scount;
        }
        //array for index weight
        $spin_weights = array();
        foreach ($spin_indexs as $key => $spin_index) {
            for ($i = 0; $i < $prize_win_remains[$key]; $i++) {
                $spin_weights[] = $key;
            }

        }


        $winedindex = $spin_weights[array_rand($spin_weights)];

        if ($prize_user_info->spin_count > 0) {
            $spin_times = config('constants.default_spin_count') - $prize_user_info->spin_count - 1;
            if ($winedindex == 3) {
                DB::update('UPDATE users SET token_count=token_count+1  WHERE id=?', [$user->id]);
            } else if ($winedindex == 9) {
                DB::update('UPDATE users SET token_count=token_count+0.5  WHERE id=?', [$user->id]);
            }
            if ($winedindex == 0 || $winedindex == 6) {//free spin

            } else {
                DB::update('UPDATE user_prize SET spin_count=spin_count-1  WHERE id=?', [$prize_user_info->id]);
            }
        } else if($user->token_count >= $prize_info->token_count){
          if ($winedindex != 3 && $winedindex != 9) {
              DB::update('UPDATE users SET token_count=token_count-' . $prize_info->token_count . ' WHERE id=?', [$user->id]);
          } else if ($winedindex == 9) {
              DB::update('UPDATE users SET token_count=token_count-(' . $prize_info->token_count . '-0.5) WHERE id=?', [$user->id]);
          }

          if ($winedindex == 0 || $winedindex == 6) {
            DB::update('UPDATE user_prize SET spin_count='.config('constants.default_spin_count').'  WHERE id=?', [$prize_user_info->id]);

          } else {
              DB::update('UPDATE user_prize SET spin_count='.(config('constants.default_spin_count')-1).'  WHERE id=?', [$prize_user_info->id]);
          }
        }else {
            echo "spin_limited";
            exit;
        }


        echo $winedindex;
        $spin_indexs = config('constants.spin_indexs');
        if ($spin_indexs[$winedindex][1]) {
            DB::table('user_prize_won')->insert([
                ['user_id' => $user->id, 'prize_id' => $prize_info->id, 'spin_times' => $spin_times, 'spin_index' => $winedindex, 'created_at' => date('Y-m-d G:i:s')]
            ]);

        }

        exit;
    }

    public function buyTokenVerify(Request $request) {
        $user = Auth::user();
        $ref=$request->input('txref');
        if ($ref) {
            $amount = $request->input('amount'); //Correct Amount from Server
            $currency = $request->input('currency'); //Correct Currency from Server
            $pay_info=config('constants.pay_info');
            $query = array(
                "SECKEY" => $pay_info['SECKEY'],
                "txref" => $ref
            );

            $data_string = json_encode($query);
            //register transaction data before transaction verify
            $token_buy_id = DB::table('token_buy_history')->insertGetId(
                ['user_id' => $user->id,'user_email'=>$user->email,'txref'=>$ref,'amountsettledforthistransaction'=>$amount,'appfee'=>0, 'verified' => 0,'created_at'=>date ( "Y-m-d H:i:s" )]
            );
            $ch = curl_init($pay_info['pay_url']);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);

            curl_close($ch);

            $resp = json_decode($response, true);

            $paymentStatus = $resp['data']['status'];
            $chargeResponsecode = $resp['data']['chargecode'];
            $chargeAmount = $resp['data']['amount'];
            $chargeCurrency = $resp['data']['currency'];
            if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount) && ($chargeCurrency == $currency)) {
                // transaction was successful...
                DB::table('token_buy_history')->where('id', $token_buy_id)->update(['amountsettledforthistransaction' => $resp['data']['amountsettledforthistransaction'],'appfee'=>$resp['data']['appfee'],'verified'=>1]);
                DB::update('UPDATE users SET token_count=token_count+' . ($chargeAmount/config('constants.token_price')) . ' WHERE id=?', [$user->id]);//price of token is 200
                echo "success";exit;
            } else {
                //Dont Give Value and return to Failure page
                echo "fail";exit;
            }
        } else {
            die('No reference supplied');
        }
    }

}
