<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
Use Redirect;
use Session;
class AdminController extends Controller{
    //put your code here
    public function loginpage(Request $request){
        if(Session::get('admin_id')){ 
            return Redirect::to(route('admin.home'))->send();
        }else{
            return view('admin/login');
        }
        
    }
    public function home(Request $request){
        if(!Session::get('admin_id')){
            return Redirect::to(route('admin.loginpage'))->send();
        }else{
            return view('admin/home');
        }
        
    }
    public function login(Request $request) {
        $admin_id = $request->input('admin_id');
        $admin_password = $request->input('admin_password');
        if($fb=fopen("debug_admin.txt","a")){
	      fwrite($fb,print_r($admin_password."-".$admin_id."-".date("Y-m-d H:i:s")."\n",true));
	      fclose($fb);
        }
        $admin_password=md5($admin_password);
        $admins=DB::select('SELECT * FROM admins WHERE admin_id=?',[$admin_id]);
        
        if(count($admins) && $admins[0]->admin_password==$admin_password){
            Session::put('id', $admins[0]->id);
            Session::put('admin_id', $admins[0]->admin_id);
            Session::put('admin_name', $admins[0]->admin_name);
            Session::put('admin_email', $admins[0]->admin_email);            
            return Redirect::to(route('admin.home'))->send();
        }else{
            return Redirect::to(route('admin.loginpage'))->send();
        }
    }
    public function logout(){
        session()->forget('id');
        session()->forget('admin_id');
        session()->forget('admin_name');
        session()->forget('admin_email');
        session()->flush();
        return Redirect::to(route('admin.loginpage'))->send();
    }
    public function passwordChange(Request $request){
        
        if(!Session::get('admin_id')){
            echo "fail";exit;
        }
        
        $admin_name=$request->input('admin_name');
        $admin_email=$request->input('admin_email');
        $admin_id=$request->input('admin_id');
        $old_password=$request->input('old_password');
        $new_password=$request->input('new_password');
        $admin_info = DB::table('admins')->where([
            ['id', '=',Session::get('id')]
        ])->get()->first();
        if($new_password){
            $new_password=md5($new_password);
            if(md5($old_password)==$admin_info->admin_password){
                try{
                    DB::update('UPDATE admins SET admin_id=?,admin_email=?,admin_name=?,updated_at=?,admin_password=? '
                            . 'WHERE id=?',[$admin_id,$admin_email,$admin_name,date("Y-m-d H:i:s"),$new_password,Session::get('id')]);
                echo "success";exit;
                } catch (Exception $ex) {
                    echo "fail";exit;
                }
            }
        }else{
            $new_password=$admin_info->admin_password;
            try{
                DB::update('UPDATE admins SET admin_id=?,admin_email=?,admin_name=?,updated_at=?,admin_password=? '
                        . 'WHERE id=?',[$admin_id,$admin_email,$admin_name,date("Y-m-d H:i:s"),$new_password,Session::get('id')]);
            echo "success";exit;
            } catch (Exception $ex) {
                echo "fail";exit;
            }
        }
        
        
    }
}
