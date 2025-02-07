@extends('layouts.app')

@section('title', 'お問い合わせ詳細')

@section('content')
    <h2>お問い合わせ詳細</h2>
    <p>名前: {{ $contact->first_name }} {{ $contact->last_name }}</p>
    <p>メール: {{ $contact->email }}</p>
    <p>電話: {{ $contact->tel }}</p>
    <p>住所: {{ $contact->address }}</p>
    <p>内容: {{ $contact->detail }}</p>
    <a href="{{ route('admin.contacts') }}">一覧に戻る</a>
@endsection
