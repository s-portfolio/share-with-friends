@extends('layouts.app')

@section('title','新規登録')

@section('content')
    <h1 class="c-heading u-center">{{ __('Register') }}</h1>
    <div class="p-form u-border__bottom">
        <h3 class="c-heading__sub">SNSを使った登録</h3>
        <a class="c-btn c-btn__twitter u-center" href="/auth/twitter"><i class="fab fa-twitter"></i> Twitterで登録</a>
    </div>
    <form class="p-form" method="POST" action="{{ route('register') }}">
        @csrf
        <h3 class="c-heading__sub">メールアドレスを使った登録</h3>
        @component('components.form',['name' => 'email','value'=>''])
            {{ __('E-Mail Address') }}
        @endcomponent
        @component('components.form',['name'=>'password','type'=>'password','value'=>''])
            {{ __('Password') }} <span class="u-sub">※8文字以上入力してください</span>
        @endcomponent
        @component('components.form',['name'=>'password_confirmation','type'=>'password','value'=>''])
            {{ __('Confirm Password') }}
        @endcomponent

        <div class="p-form__item">
            <button type="submit" class="c-btn c-btn__login c-btn__register">
                {{ __('Register') }}
            </button>
        </div>
    </form>
@endsection
