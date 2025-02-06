@extends('layouts.app')

@section('title', 'お問い合わせフォーム')

@section('content')
    <h1>お問い合わせフォーム</h1>
    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf
        <label for="first_name">姓:</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
        @error('first_name') <p class="error">{{ $message }}</p> @enderror

        <label for="last_name">名:</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
        @error('last_name') <p class="error">{{ $message }}</p> @enderror

        <label for="gender">性別:</label>
        <select name="gender" id="gender">
            <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>男性</option>
            <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>女性</option>
            <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>その他</option>
        </select>
        @error('gender') <p class="error">{{ $message }}</p> @enderror

        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="tel">電話番号:</label>
        <input type="text" id="tel" name="tel" value="{{ old('tel') }}">
        @error('tel') <p class="error">{{ $message }}</p> @enderror

        <label for="address">住所:</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}">
        @error('address') <p class="error">{{ $message }}</p> @enderror

        <label for="detail">お問い合わせ内容:</label>
        <textarea id="detail" name="detail">{{ old('detail') }}</textarea>
        @error('detail') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">確認画面へ</button>
    </form>
@endsection
