@extends('layouts.app')

@section('title', '新規登録')

@section('content')
    <h2>新規登録</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">お名前:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <label for="password_confirmation">パスワード（確認用）:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit">登録する</button>
    </form>
@endsection
