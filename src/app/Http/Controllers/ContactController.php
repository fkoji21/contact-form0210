<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // お問い合わせフォームの表示
    public function index()
    {
        return view('contact.index');
    }

    // 確認画面の表示（バリデーション済みのデータを取得）
    public function confirm(ContactRequest $request)
    {
        // 受け取ったリクエストデータをログに出力
        \Log::info($request->all());
        
        $data = $request->validated();
        $data['tel'] = $data['tel1'] . '-' . $data['tel2'] . '-' . $data['tel3'];
        return view('contact.confirm', compact('data'));
    }

    // フォーム送信処理（データの保存）
    public function store(ContactRequest $request)
    {
        \Log::info('🟢 store() メソッドが実行されました');

    // リクエストデータをログ出力
    \Log::info('リクエストデータ:', $request->all());

    // バリデーション済みデータを取得
    $data = $request->validated();
    \Log::info('バリデーション済みデータ:', $data);

    // 電話番号を結合
    $data['tel'] = $data['tel1'] . '-' . $data['tel2'] . '-' . $data['tel3'];

    // 🔥 `category` を `category_id` に変換（ここが重要）
    $data['category_id'] = (int) $data['category'];
    unset($data['category']); // `category` は不要なので削除

    // データ保存を試みる
    try {
        $contact = Contact::create($data);
        if ($contact) {
            \Log::info('✅ データが正常に保存されました', $contact->toArray());
        } else {
            \Log::error('⚠️ データの保存に失敗しました');
        }
    } catch (\Exception $e) {
        \Log::error('🛑 データベースエラー: ' . $e->getMessage());
    }

    return redirect()->route('contact.thanks');
    }
}
