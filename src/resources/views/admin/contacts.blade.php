@extends('layouts.app')

@section('content')
<h2>お問い合わせ一覧</h2>

<!-- 検索フォーム -->
<form action="{{ route('admin.contacts') }}" method="GET">
    <input type="text" name="name" placeholder="名前で検索" value="{{ request('name') }}">
    <label>
        <input type="checkbox" name="exact_match" {{ request('exact_match') ? 'checked' : '' }}> 完全一致
    </label>
    
    <input type="text" name="email" placeholder="メールアドレスで検索" value="{{ request('email') }}">

    <select name="gender">
        <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>性別</option>
        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
    </select>

    <select name="category_id">
        <option value="">お問い合わせ種類</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->content }}
            </option>
        @endforeach
    </select>

    <input type="date" name="date_from" value="{{ request('date_from') }}">
    <input type="date" name="date_to" value="{{ request('date_to') }}">

    <button type="submit">検索</button>
    <a href="{{ route('admin.contacts') }}">リセット</a>
</form>

<!-- 検索結果の表示 -->
<table>
    <tr>
        <th>名前</th>
        <th>メールアドレス</th>
        <th>性別</th>
        <th>お問い合わせ種類</th>
        <th>日付</th>
        <th>詳細</th>
    </tr>
    @foreach($contacts as $contact)
    <tr>
        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
        <td>{{ $contact->email }}</td>
        <td>
            @if($contact->gender == 1) 男性 
            @elseif($contact->gender == 2) 女性 
            @else その他 
            @endif
        </td>
        <td>{{ $contact->category->content }}</td>
        <td>{{ $contact->created_at->format('Y-m-d') }}</td>
        <td><button class="detail-button" data-id="{{ $contact->id }}">詳細</button></td>
    </tr>
    @endforeach
</table>

<!-- ページネーション -->
{{ $contacts->links() }}

<!-- エクスポートボタン -->
<form action="{{ route('admin.contacts.export') }}" method="GET">
    <button type="submit">エクスポート</button>
</form>

<!-- モーダルウィンドウ -->
<div id="contactModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; box-shadow: 0px 0px 10px gray;">
    <h2>お問い合わせ詳細</h2>
    <p><strong>名前:</strong> <span id="modal-name"></span></p>
    <p><strong>メール:</strong> <span id="modal-email"></span></p>
    <p><strong>電話:</strong> <span id="modal-tel"></span></p>
    <p><strong>住所:</strong> <span id="modal-address"></span></p>
    <p><strong>カテゴリー:</strong> <span id="modal-category"></span></p>
    <p><strong>内容:</strong> <span id="modal-detail"></span></p>
    <button id="close-modal">閉じる</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.detail-button').forEach(button => {
        button.addEventListener('click', function () {
            const contactId = this.dataset.id; // ボタンの data-id から ID を取得
            console.log("取得するID: ", contactId);

            fetch(`/admin/contacts/${contactId}`)
                .then(response => response.json())
                .then(data => {
                    console.log("取得したデータ: ", data); // JSONデータが正しく取得できているか確認

                    // モーダル内の各要素にデータを設定
                    document.getElementById('modal-name').textContent = data.first_name + ' ' + data.last_name;
                    document.getElementById('modal-email').textContent = data.email;
                    document.getElementById('modal-tel').textContent = data.tel;
                    document.getElementById('modal-address').textContent = data.address;
                    document.getElementById('modal-category').textContent = data.category.content;
                    document.getElementById('modal-detail').textContent = data.detail;

                    // モーダルを表示
                    document.getElementById('contactModal').style.display = 'block';
                })
                .catch(error => console.error("エラー: ", error));
        });
    });

    // モーダルを閉じる処理
    document.getElementById('close-modal').addEventListener('click', function () {
        document.getElementById('contactModal').style.display = 'none';
    });
});
</script>

@endsection
