@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<div class="admin-container">
    <div class="header">
        <div class="admin-nav">
            <span>Admin</span>
            <a href="{{ route('logout') }}">logout</a>
        </div>
    </div>

    <div class="search-form">
        <form action="{{ route('admin.index') }}" method="GET" class="search-flex">
            <input type="text" name="name" placeholder="名前やメールアドレスを入力" value="{{ request('name') }}" class="search-name">
            <select name="gender" class="search-gender">
                <option value="all">性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>他</option>
            </select>
            <select name="category_id" class="search-category">
                <option value="">種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date') }}" class="search-date">
            <button type="submit" class="search-button">検索</button>
            <button type="reset" class="reset-button">リセット</button>
        </form>
    </div>

    <div class="contacts-table">
        @if (!empty($contacts) && $contacts->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                            <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category->content }}</td>
                            <td><button class="detail-button" data-id="{{ $contact->id }}">詳細</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $contacts->links() }}
            </div>
        @else
            <p>お問い合わせ情報が見つかりません。</p>
        @endif
    </div>
</div>

<!-- モーダルウィンドウ -->
<div id="contactModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>お問い合わせ詳細</h2>
        <table class="contact-table">
            <tr>
                <th>お名前</th>
                <td id="modal-name"></td>
            </tr>
            <tr>
                <th>性別</th>
                <td id="modal-gender"></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td id="modal-email"></td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td id="modal-tel"></td>
            </tr>
            <tr>
                <th>住所</th>
                <td id="modal-address"></td>
            </tr>
            <tr>
                <th>建物名</th>
                <td id="modal-building"></td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td id="modal-category"></td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td id="modal-detail"></td>
            </tr>
            <tr>
                <th>作成日</th>
                <td id="modal-created_at"></td>
            </tr>
        </table>
        <button id="deleteButton" class="delete-button">削除</button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("contactModal");
    const closeButton = document.querySelector(".close");
    const detailButtons = document.querySelectorAll(".detail-button");
    const deleteButton = document.getElementById("deleteButton");

    // 詳細ボタンをクリックしたとき
    detailButtons.forEach(button => {
        button.addEventListener("click", function() {
            const contactId = this.getAttribute("data-id");

            // Ajaxで詳細データを取得
            fetch(`/admin/contacts/${contactId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("modal-name").textContent = `${data.first_name} ${data.last_name}`;
                    document.getElementById("modal-gender").textContent = data.gender == 1 ? "男性" : data.gender == 2 ? "女性" : "その他";
                    document.getElementById("modal-email").textContent = data.email;
                    document.getElementById("modal-tel").textContent = data.tel;
                    document.getElementById("modal-address").textContent = data.address;
                    document.getElementById("modal-building").textContent = data.building;
                    document.getElementById("modal-category").textContent = data.category.content;
                    document.getElementById("modal-detail").textContent = data.detail;
                    document.getElementById("modal-created_at").textContent = data.created_at;

                    // モーダルを表示
                    modal.style.display = "block";

                    // 削除ボタンの動作を設定
                    deleteButton.setAttribute("data-id", contactId);
                })
                .catch(error => console.error("Error:", error));
        });
    });

    // 閉じるボタンをクリックしたとき
    closeButton.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // モーダル外をクリックしたとき
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // 削除ボタンをクリックしたとき
    deleteButton.addEventListener("click", function() {
        const contactId = this.getAttribute("data-id");

        if (confirm("本当に削除しますか？")) {
            fetch(`/admin/contacts/${contactId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
            })
            .then(response => {
                if (response.ok) {
                    alert("削除が完了しました。");
                    modal.style.display = "none";
                    location.reload();
                } else {
                    alert("削除に失敗しました。");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    });
});
</script>

@endsection
