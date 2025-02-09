@extends('layouts.app')

@section('content')
    <h2 class="subtitle">Contact</h2>

    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf
        <table class="contact-table">
            <!-- お名前 -->
            <tr>
                <th>お名前 <span>※</span></th>
                <td class="name-input">
                    <input type="text" name="last_name" placeholder="例: 山田">
                    <input type="text" name="first_name" placeholder="例: 太郎">
                </td>
            </tr>

            <!-- 性別 -->
            <tr>
                <th>性別 <span>※</span></th>
                <td>
                    <label><input type="radio" name="gender" value="男性"> 男性</label>
                    <label><input type="radio" name="gender" value="女性"> 女性</label>
                    <label><input type="radio" name="gender" value="その他"> その他</label>
                </td>
            </tr>

            <!-- メールアドレス -->
            <tr>
                <th>メールアドレス <span>※</span></th>
                <td><input type="email" name="email" placeholder="例: test@example.com"></td>
            </tr>

            <!-- 電話番号 -->
            <tr>
                <th>電話番号 <span>※</span></th>
                <td class="tel-input">
                    <input type="text" name="tel1" placeholder="080">
                    <span class="hyphen">-</span>
                    <input type="text" name="tel2" placeholder="1234">
                    <span class="hyphen">-</span>
                    <input type="text" name="tel3" placeholder="5678">
                </td>
            </tr>

            <!-- 住所 -->
            <tr>
                <th>住所 <span>※</span></th>
                <td><input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"></td>
            </tr>

            <!-- 建物名 -->
            <tr>
                <th>建物名</th>
                <td><input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101"></td>
            </tr>

            <!-- お問い合わせの種類 -->
            <tr>
                <th>お問い合わせの種類 <span>※</span></th>
                <td>
                    <select name="category">
                        <option value="">選択してください</option>
                        <option value="1">商品のお届けについて</option>
                        <option value="2">商品の交換について</option>
                        <option value="3">商品トラブル</option>
                        <option value="4">ショップへの問い合わせ</option>
                        <option value="5">その他</option>
                    </select>
                </td>
            </tr>

            <!-- お問い合わせ内容 -->
            <tr>
                <th class="align-top">お問い合わせ内容 <span>※</span></th>
                <td><textarea name="message" placeholder="お問い合わせ内容をご記載ください"></textarea></td>
            </tr>
        </table>

        <button type="submit" class="submit-btn">確認画面へ</button>
    </form>
@endsection
