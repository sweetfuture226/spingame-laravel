<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
Use Redirect;
use Session;

use App\Notifications\SprizeWon;
use App\User;
use Illuminate\Support\Facades\Auth;
/**
 * Description of UsermngController
 *
 * @author admin11
 */
class PrizemngController  extends Controller{
    public function prizeslist(){
        if(!Session::get('admin_id')){
            Redirect::to(route('admin.loginpage'))->send();
        }
        $prizes = DB::table('prizes')->orderBy('id', 'desc')->get();
        /*$users = array_map(function ($value) {
            return (array)$value;
        }, $users);*/
        $user_prize_infos= DB::table('user_prize')
                     ->select(DB::raw('count(*) user_count,prize_id'))
                     ->groupBy('prize_id')
                     ->get();
        foreach ($prizes as $key => $prize) {
          $prizes[$key]->user_count=0;
          foreach ($user_prize_infos as $user_prize_info) {
              if($prize->id==$user_prize_info->prize_id){
                  $prizes[$key]->user_count=$user_prize_info->user_count;
                  continue;
              }
          }
        }

        
        return view('admin/prizes',['prizes'=>$prizes]);
    }
    public function ajaxPrizeInfo(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $id = $request->input('id');
        $prize_info = DB::table('prizes')->where([
            ['id', '=',$id]
        ])->get()->first();
        //$result_array = array('result' => 'success', 'url' => route('home'));
        return response()->json($prize_info);
    }
    public function ajaxPrizeEditAction(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $id = $request->input('id');
        $prize_name=$request->input('prize_name');
        $prize_cost=$request->input('prize_cost');
        $prize_category = $request->input('prize_category');
        $token_count = $request->input('token_count');
        $description = $request->input('description');
        $img_url=$request->input('img_url');
        $start_time=$request->input('start_time');
        $expire_time=$request->input('expire_time');
        $winners_jackpot=$request->input('winners_jackpot');
        $winners_n500=$request->input('winners_n500');
        $winners_free_token=$request->input('winners_free_token');
        $winners_half_token=$request->input('winners_half_token');
        $winners_mystery_prize=$request->input('winners_mystery_prize');
        $winners_free_spin=$request->input('winners_free_spin');
        $winners_cash=$request->input('winners_cash');
        $cash_price=$request->input('cash_price');
        $mystery_prize=$request->input('mystery_prize');
        try{
            DB::update('UPDATE prizes SET prize_name=?,prize_cost=?,prize_category=?,token_count=?,updated_at=?,description=?,img_url=?,start_time=?,expire_time=?,winners_jackpot=?,winners_n500=?,winners_free_token=?,winners_half_token=?,winners_mystery_prize=?,winners_free_spin=?,winners_cash=?,cash_price=?,mystery_prize=? WHERE id=?',[$prize_name,$prize_cost,$prize_category,$token_count,date("Y-m-d H:i:s"),$description,$img_url,$start_time,$expire_time,$winners_jackpot,$winners_n500,$winners_free_token,$winners_half_token,$winners_mystery_prize,$winners_free_spin,$winners_cash,$cash_price,$mystery_prize,$id]);
            echo "success";exit;
        } catch (Exception $ex) {
            echo "fail";exit;
        }

    }
    public function ajaxPrizeAddAction(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $prize_name=$request->input('prize_name');
        $prize_cost=$request->input('prize_cost');
        $prize_category = $request->input('prize_category');
        $token_count = $request->input('token_count');
        $description = $request->input('description');
        $img_url=$request->input('img_url');
        $start_time=$request->input('start_time');
        $expire_time=$request->input('expire_time');
        $winners_jackpot=$request->input('winners_jackpot');
        $winners_n500=$request->input('winners_n500');
        $winners_free_token=$request->input('winners_free_token');
        $winners_half_token=$request->input('winners_half_token');
        $winners_mystery_prize=$request->input('winners_mystery_prize');
        $winners_free_spin=$request->input('winners_free_spin');
        $winners_cash=$request->input('winners_cash');
        $cash_price=$request->input('cash_price');
        $mystery_prize=$request->input('mystery_prize');
        try{
            DB::table('prizes')->insert([
                ['prize_name' => $prize_name,'prize_cost'=>$prize_cost, 'prize_category' => $prize_category, 'token_count' => $token_count, 'created_at' => date('Y-m-d G:i:s'),'description'=>$description,'img_url'=>$img_url,'start_time'=>$start_time,'expire_time'=>$expire_time,'winners_jackpot'=>$winners_jackpot,'winners_n500'=>$winners_n500,'winners_free_token'=>$winners_free_token,'winners_half_token'=>$winners_half_token,'winners_mystery_prize'=>$winners_mystery_prize,'winners_free_spin'=>$winners_free_spin,'winners_cash'=>$winners_cash,'cash_price'=>$cash_price,'mystery_prize'=>$mystery_prize]
            ]);
            echo "success";exit;
        } catch (Exception $ex) {
            echo "fail";exit;
        }
    }
    public function ajaxPrizeDeleteAction(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $id=$request->input('id',0);
        if($id){
            DB::delete('DELETE FROM prizes WHERE id=?',[$id]);
            echo "success";
        }else{
            echo "failure-".$id;
        }
    }
    public function imgUpload(Request $request){

        $file = $request->file('file_upload');
        if (Input::hasFile('file_upload')) {
            $filename = Input::file('file_upload')->getClientOriginalName();
        }
        //using array instead of object
        //$image['filePath'] = time().'_'.$filename;
        $prefix=time();
        $file->move(public_path().'/uploads/', $prefix.'_'.$filename);
        echo '/uploads/'.$prefix.'_'.$filename;
        exit;
    }
    public function prizeWinners(Request $request){
        if(!Session::get('admin_id')){
            Redirect::to(route('admin.loginpage'))->send();
        }
        $users=DB::table('users')->orderBy('id', 'desc')->get();
        $prizes = DB::table('prizes')->orderBy('id', 'desc')->get();
        $query="SELECT user_prize_won.spin_index,user_prize_won.created_at,users.firstname,users.lastname,users.email,prizes.prize_name,prizes.img_url FROM user_prize_won INNER JOIN users ON(user_prize_won.user_id=users.id) INNER JOIN prizes ON(user_prize_won.prize_id=prizes.id) WHERE user_prize_won.created_at <> '' ";
        $selected_user=$request->input('user',0);
        $selected_prize=$request->input('prize',0);
        if($selected_user){
            $query.=" AND user_prize_won.user_id={$selected_user}";
        }
        if($selected_prize){
            $query.=" AND user_prize_won.prize_id={$selected_prize}";
        }
        $query.=" ORDER BY user_prize_won.id DESC";


        $user_month = DB::table('token_buy_history')->join('users', 'users.id', '=', 'token_buy_history.user_id')->where('token_buy_history.created_at', '>=', Carbon::now()->startOfMonth())->get();

        $prize_winners=DB::select($query);
        return view('admin/prizewinners',['users'=>$users,'prizes'=>$prizes,'prize_winners'=>$prize_winners,'selected_user'=>$selected_user,'selected_prize'=>$selected_prize, 'user_month' => $user_month]);
    }
}
