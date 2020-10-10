<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Mail;
class RegisterController extends Controller {

    public function request(RegisterRequest $request) {
        $user = User::create([
            'email'=> $request->get("email"),
            'password'=> md5($request->get("password")),
            'token' => md5(time()),
            'deleted_at'=>new \DateTime()]
        );
        Mail::send(['text' => 'mail'],['name', 'Test'], function($message){
            $message->to ($user->take('email'), 'To web dev blog')->subject('Test mail');
            $message->from ('artikdx2@gmail.com', 'Web dev blog');
        });

    }
}