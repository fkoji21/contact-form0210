@extends('layouts.app')

@section('title', '確認画面')

@section('content')
    <h2>確認画面</h2>
    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        
        @if(isset($data))
        <p>姓: {{ $data['first_name'] }}</p>
        <p>名: {{ $data['last_name'] }}</p>
        <p>性別: {{ $data['gender'] }}</p>
        <p>メールアドレス: {{ $data['email'] }}</p>
        <p>電話番号: {{ $data['tel'] }}</p>
        <p>住所: {{ $data['address'] }}</p>
        <p>お問い合わせ内容: {{ $data['detail'] }}</p>

        <!-- 送信時にデータを保持するための hidden input -->
            <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            <input type="hidden" name="email" value="{{ $data['email'] }}">
            <input type="hidden" name="tel" value="{{ $data['tel'] }}">
            <input type="hidden" name="address" value="{{ $data['address'] }}">
            <input type="hidden" name="detail" value="{{ $data['detail'] }}">

        @else
        <p>データがありません。</p>
        @endif

        <button type="submit">送信する</button>
    </form>
    <a href="{{ url()->previous() }}">修正する</a>
@endsection
