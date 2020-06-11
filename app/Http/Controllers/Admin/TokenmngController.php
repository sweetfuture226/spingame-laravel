<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
Use Redirect;
use Session;
/**
 * Description of TokenmngController
 *
 * @author admin11
 */
class TokenmngController {
    //put your code here
    public function __construct() {
       
    }
    public function tokenBuyHistory(Request $request){
         if(!Session::get('admin_id')){
            Redirect::to(route('admin.loginpage'))->send();
        }
        $token_buy_histories= DB::table('token_buy_history')->orderBy('created_at', 'desc')->get();
        return view('admin/tokenbuyhistory',['token_buy_histories'=>$token_buy_histories]);
    }
    public function ajaxGetRow(Request $request){
         if(!Session::get('id')){
            echo "fail";exit;
        }
        $id=$request->input('id');
        $row_info = DB::table('token_buy_history')->where([
            ['id', '=',$id]
        ])->get()->first();
        return response()->json($row_info); 
    }
    public function ajaxTransactionEdit(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $id = $request->input('id');
        $amountsettledforthistransaction = $request->input('amountsettledforthistransaction');
        $appfee = $request->input('appfee');
        $verified = $request->input('verified');
        try{
            DB::update('UPDATE token_buy_history SET amountsettledforthistransaction=?,appfee=?,verified=?,updated_at=? WHERE id=?',[$amountsettledforthistransaction,$appfee,$verified,date("Y-m-d H:i:s"),$id]);
            echo "success";exit;
        } catch (Exception $ex) {
            echo "fail";exit;
        }
    }
    public function ajaxTransactionDelete(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $id=$request->input('id',0);
        if($id){
            DB::delete('DELETE FROM token_buy_history WHERE id=?',[$id]);
            echo "success";
        }else{
            echo "failure-".$id;
        }
    }
}
