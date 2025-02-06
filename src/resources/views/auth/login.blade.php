@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <h2>ログイン</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">ログイン</button>
    </form>
    <p><a href="{{ route('register') }}">新規登録はこちら</a></p>
@endsection
