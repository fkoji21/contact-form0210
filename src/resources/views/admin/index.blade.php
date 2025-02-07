@extends('layouts.app')

@section('title', '管理画面')

@section('content')
    <h2>管理画面</h2>
    <p>ようこそ、{{ auth()->user()->name }} さん</p>
    <ul>
        <li><a href="{{ route('admin.contacts') }}">お問い合わせ一覧</a></li>
    </ul>
    <a href="{{ route('logout') }}">ログアウト</a>
@endsection
