@extends('layouts.app')

@section('title', '管理画面')

@section('content')
    <h2>管理画面</h2>
    <ul>
        <li><a href="{{ route('admin.contacts') }}">お問い合わせ一覧</a></li>
    </ul>
@endsection
