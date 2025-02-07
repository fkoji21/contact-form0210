@extends('layouts.app')

@section('title', 'お問い合わせ一覧')

@section('content')
    <h2>お問い合わせ一覧</h2>

    <form method="GET" action="{{ route('admin.contacts') }}">
        <input type="text" name="search" placeholder="キーワード検索" value="{{ request('search') }}">
        <select name="category_id">
            <option value="">全カテゴリー</option>
            <option value="1" {{ request('category_id') == 1 ? 'selected' : '' }}>カテゴリ1</option>
            <option value="2" {{ request('category_id') == 2 ? 'selected' : '' }}>カテゴリ2</option>
        </select>
        <button type="submit">検索</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メール</th>
            <th>電話</th>
            <th>詳細</th>
            <th>削除</th>
        </tr>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->tel }}</td>
                <td><a href="{{ route('admin.contacts.show', $contact->id) }}">詳細</a></td>
                <td>
                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $contacts->links() }}
@endsection
