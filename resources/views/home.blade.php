@extends('layouts.app')

@section('title','マイページ')

@section('content')
    <h1 class="c-heading u-center">マイページ</h1>
    <div class="p-home">
        <div class="p-home__block">
            <a class="p-home__link" href="/mypage/change">登録情報変更</a>
        </div>
        <div class="p-home__block">
            <a class="p-home__link" href="/quiz/make">クイズ作成</a>
        </div>
        <div class="p-home__block">
            <a class="p-home__link" href="/quiz/list">クイズ一覧</a>
        </div>
    </div>
@endsection
