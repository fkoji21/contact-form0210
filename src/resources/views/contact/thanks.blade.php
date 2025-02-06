@extends('layouts.app')

@section('title', 'お問い合わせ完了')

@section('content')
    <h2>お問い合わせありがとうございました</h2>
    <p>担当者よりご連絡いたします。</p>
    <a href="{{ route('contact.index') }}">トップページへ戻る</a>
@endsection
