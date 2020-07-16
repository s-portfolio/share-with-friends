@extends('layouts.app')

@section('title','登録情報変更')

@section('content')
    <h1 class="c-heading u-center">登録情報変更</h1>
    <div class="p-change">
        <div class="p-form__item">
            <form class="p-form" method="post" action="">
                <label for="" class="p-form__label">twitter連携</label>
                @if($twitter)
                    <button class="c-btn c-btn__twitter u-center" href="" disabled="disabled">Twitter連携済</button>
                @else
                    <a class="c-btn c-btn__twitter u-center" href="/auth/twitter">Twitterを連携する</a>
                @endif
                @component('components.form',['name' => 'email','value' => $email])
                    {{ __('E-Mail Address') }}
                @endcomponent
                <button type="submit" class="c-btn c-btn__login">
                    変更する
                </button>
            </form>
        </div>
    </div>
@endsection
