<?php

namespace App\Http\Controllers;

use App\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function __construct(){
        set_time_limit(86400);
    }
    //twitterの認証画面にredirectする
    public function redirect(){
        return Socialite::with('Twitter')->redirect();
    }

    //twitterの認証画面から戻ってきた際の処理
    public function callback(){
        //twitterのuser情報を取得する
        try{
            //user情報を変数の中に入れる
            $user = Socialite::driver('Twitter')->user();
            //twitterのuser情報を取得できなかった場合
        }catch(Exception $e){
            //認証画面に戻す
            return redirect('auth/twitter');
        }
        //userのidを変数の中に入れる
        $user_id = $user->id;
        //userのトークンを変数の中に入れる
        $user_token = $user->token;
        //userのtoken_secretを変数の中に入れる
        $user_secret = $user->tokenSecret;
        //usersテーブルにすでに情報が登録されているか調べる
        $authUser = User::where('twitter_id',$user_id)->first();
        //ログインしている場合
        if(Auth::id()){
            //もしアカウントがある場合
            if($authUser){
                //ホーム画面へ遷移する
                return redirect('/')->with('status','twitterは他のアカウントに連携されています');
                //アカウントがない場合
            }else{
                //ログインしているidを取得
                $id = Auth::id();
                //今ログインしているユーザーにtwitter情報を追加する
                User::where('id',$id)
                    ->update(['twitter_id' => $user_id,
                        'twitter_oauth_token' => $user_token,
                        'twitter_oauth_token_secret' => $user_secret ]);
                //マイページ画面に戻る
                return redirect('/home')->with('status','twitterを連携しました');
            }
            //ログインしていない場合
        }else{
            //usersテーブルにすでに情報がある場合
            if($authUser){
                //twitter情報を更新する
                User::where('twitter_id',$user_id)
                    ->update(['twitter_oauth_token' => $user_token,
                        'twitter_oauth_token_secret' => $user_secret ]);
                //ログインする
                Auth::login($authUser,true);

                //usersテーブルに情報がなく新規登録をする場合
            }else{
                //ユーザーを新規に作り、そのデーターをnewUser変数に入れる
                $newUser = User::create([
                    'twitter_id' => $user_id,
                    'twitter_oauth_token' => $user_token,
                    'twitter_oauth_token_secret' => $user_secret
                ]);
                //ログインする
                Auth::login($newUser,true);
            }
            //ホーム画面へ遷移する
            return redirect('/')->with('status','ログインしました。');
        }
    }
}
