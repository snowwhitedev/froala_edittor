<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;

class UserController extends Controller
{
    public function __constructor () {
        $this.load.helper('database');
    }

    public function login(Request $req){
        $strUserName = $req['username'];
        $strPassword = $req['password'];
        
        $umodel = new UserModel;
        
        $strByName = ["name" => $strUserName, "password" => md5($strPassword)];
        $strByEmail = ["email" => $strUserName, "password" => md5($strPassword)];
        $users = UserModel::where($strByName)
                            ->get();
        if(count($users) == 0){
            $users = UserModel::where($strByEmail)
                            ->get();
        }
        session([
            'userID'    => '',
            'userName'  => '',
            'userEmail' => '',
            'login'     => false
        ]);

        if(count($users) > 0){
            session([
                'userID'    => $users[0]->id,
                'userName'  => $users[0]->name,
                'userEmail' => $users[0]->email,
                'login'     => true
            ]);
            return redirect('dashboard/');
        }
        else{
            return redirect('/');
        } 
    }

    public function signup(Request $req){
        $user = new UserModel;
        $user->name = $req['usernamesignup'];
        $user->email = $req['emailsignup'];
        $user->password = md5($req['passwordsignup']);
        $user->save();
        session()->flash('signup', "The registeration was successfully done.Please sign in.");
    
        return redirect('/');
    }

    public function logout(Request $req){
        
        $req->session()->flush();
        
        return redirect('/');
    }
}
