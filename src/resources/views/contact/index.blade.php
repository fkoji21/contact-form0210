@extends('layouts.app')

@section('title', 'お問い合わせフォーム')

@section('content')
    <h1>お問い合わせフォーム</h1>
    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf
        <label for="first_name">姓:</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>

        <label for="last_name">名:</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>

        <label for="gender">性別:</label>
        <select name="gender" id="gender">
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>

        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="tel">電話番号:</label>
        <input type="text" id="tel" name="tel" value="{{ old('tel') }}">

        <label for="address">住所:</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}">

        <label for="detail">お問い合わせ内容:</label>
        <textarea id="detail" name="detail">{{ old('detail') }}</textarea>

        <button type="submit">確認画面へ</button>
    </form>
@endsection
