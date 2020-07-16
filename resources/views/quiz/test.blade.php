@extends('layouts.app')

@section('title','クイズ')

@section('content')
    <div id="app">
        <test :test="{{ $problem }}"></test>
    </div>
@endsection
