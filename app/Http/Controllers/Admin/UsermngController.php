<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
Use Redirect;
use Session;

/**
 * Description of UsermngController
 *
 * @author admin11
 */
class UsermngController  extends Controller{
    public function __construct() {

    }
    public function userslist(){
        if(!Session::get('id')){
            Redirect::to(route('admin.loginpage'))->send();
        }
        $users=DB::select('SELECT * FROM users');
        $users = array_map(function ($value) {
            return (array)$value;
        }, $users);
        return view('admin/users',['users'=>$users]);
    }
    public function ajaxUserInfo(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $id = $request->input('id');
        $user_info = DB::table('users')->where([
            ['id', '=',$id]
        ])->get()->first();
        //$result_array = array('result' => 'success', 'url' => route('home'));
        return response()->json($user_info);
    }
    public function ajaxUserEditAction(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $id = $request->input('id');
        $name=$request->input('name');
        $email = $request->input('email');
        $ins_username = $request->input('ins_username');
        $token_count = $request->input('token_count');
        $state = $request->input('state');
        $activated = $request->input('activated');
        try{
            DB::update('UPDATE users SET name=?,email=?,ins_username=?,state=?,updated_at=?,token_count=?,activated=? WHERE id=?',[$name,$email,$ins_username,$state,date("Y-m-d H:i:s"),$token_count,$activated,$id]);
            echo "success";exit;
        } catch (Exception $ex) {
            echo "fail";exit;
        }

    }
    public function userDelete(Request $request){
        if(!Session::get('id')){
            echo "fail";exit;
        }
        $id=$request->input('id',0);
        if($id){
            DB::delete('DELETE FROM users WHERE id=?',[$id]);
            echo "success";
        }else{
            echo "failure-".$id;
        }
    }
}
