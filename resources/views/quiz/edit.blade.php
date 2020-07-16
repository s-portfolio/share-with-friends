@extends('layouts.app')

@section('title','クイズ編集')

@section('content')
    <div id="app">
        <edit :old_problem="{{ $problem }}"></edit>
    </div>
@endsection
