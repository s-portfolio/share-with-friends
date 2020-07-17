@extends('layouts.app')

@section('title','ログイン')

@section('content')
    <h1 class="c-heading u-center">{{ __('Login') }}</h1>
    <div class="p-form u-border__bottom">
        <h3 class="c-heading__sub">SNSを使ったログイン</h3>
        <a class="c-btn c-btn__twitter u-center" href="/auth/twitter"><i class="fab fa-twitter"></i> Twitterでログイン</a>
    </div>
    <form class="p-form" method="POST" action="{{ route('login') }}">
        @csrf
        <h3 class="c-heading__sub">メールアドレスを使ったログイン</h3>
        @component('components.form',['name' => 'email','value' => ''])
            {{ __('E-Mail Address') }}
        @endcomponent
        @component('components.form',['name'=>'password','type'=>'password','value'=>''])
            {{ __('Password') }}
        @endcomponent

        <div class="p-form__item2">
            <input class="c-input2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="c-input2__text" for="remember">
                &nbsp;{{ __('Remember Me') }}
            </label>
        </div>
        <div class="p-form__item">
            <button type="submit" class="c-btn c-btn__login">
                {{ __('Login') }}
            </button>
        </div>
    </form>
@endsection
