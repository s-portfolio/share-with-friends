@extends('layouts.app')

@section('title','クイズ作成')

@section('content')
    <h1 class="c-heading u-center">作成クイズ詳細</h1>
    <div class="p-detail__container">
        <label class="p-detail__label" for="">友達への共有リンク　：　</label>
        <input class="p-detail__link" type="text" readonly="readonly"
               value="">
    </div>
    <p class="p-detail__subject u-center">クイズテーマ　：　{{ $problem->subject }}</p>
    @for($i=0;$i<5;$i++)
        <div class="p-detail">
            <div class="p-detail__problem">
                <p>問題{{ $i + 1 }} :{{ json_decode($problem->problem)[$i] }}</p>
            </div>
            <div class="p-detail__choice">
                <p class="p-detail__choice--txt">選択肢１ : {{ json_decode($problem->choice1)[$i] }}</p>
                <p class="p-detail__choice--txt">選択肢2 : {{ json_decode($problem->choice2)[$i] }}</p>
                <p class="p-detail__choice--txt">選択肢3 :{{ json_decode($problem->choice3)[$i] }}</p>
                <p class="p-detail__choice--txt">選択肢4 : {{ json_decode($problem->choice4)[$i] }}</p>
            </div>
            <div class="p-detail__answer">
                <p>解答 : {{ json_decode($problem->answer)[$i] }}</p>
            </div>
        </div>
    @endfor
    <a class="c-btn u-center" href="/quiz/edit/{{ $problem->id }}">編集する</a>
    <div>
        <form action="/quiz/delete/{{ $problem->id }}" method="post">
            @csrf
            <button type="submit" onclick="alert('削除しますか')" class="c-btn">削除する</button>
        </form>
    </div>
@endsection
