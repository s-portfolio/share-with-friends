@extends('layouts.app')

@section('title','クイズ作成')

@section('content')
    <h1 class="c-heading u-center">作成したクイズリスト</h1>
    <div class="p-list">
        @for($i=0;$i < count($problems);$i++)
            <a href="/quiz/list/{{ $problems[$i]->id }}" class="p-list__block">
                <label class="p-list__label" for="subject">クイズのテーマ</label>
                <p class="p-list__subject">{{ $problems[$i]->subject }}</p>
                <i class="fas fa-external-link-alt p-list__icon"></i>
            </a>
        @endfor
    </div>
@endsection
