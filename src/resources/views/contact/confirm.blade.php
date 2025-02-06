@extends('layouts.app')

@section('title', '確認画面')

@section('content')
    <h2>確認画面</h2>
    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <p>姓: {{ $data['first_name'] }}</p>
        <p>名: {{ $data['last_name'] }}</p>
        <p>性別: {{ ['1' => '男性', '2' => '女性', '3' => 'その他'][$data['gender']] }}</p>
        <p>メールアドレス: {{ $data['email'] }}</p>
        <p>電話番号: {{ $data['tel'] }}</p>
        <p>住所: {{ $data['address'] }}</p>
        <p>お問い合わせ内容: {{ $data['detail'] }}</p>
        <button type="submit">送信する</button>
        <a href="{{ url()->previous() }}">修正する</a>
    </form>
@endsection
