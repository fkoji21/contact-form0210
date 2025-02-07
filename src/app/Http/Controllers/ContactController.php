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
        return view('contact.confirm', compact('data'));
    }

    // フォーム送信処理（データの保存）
    public function store(ContactRequest $request)
    {
        \Log::info('store メソッドが実行されました。');
        \Log::info($request->validated());

        // バリデーション済みデータを取得
        $data = $request->validated();

        // category_id のデフォルト値を設定 (もし未指定なら 1 を設定)
        $data['category_id'] = $data['category_id'] ?? 1;

        // データを保存
        $contact = Contact::create($data);

        if ($contact) {
            \Log::info('データが正常に保存されました');
        } else {
            \Log::error('データの保存に失敗しました');
        }

        return redirect()->route('contact.thanks');
    }

    // サンクスページの表示
    public function thanks()
    {
        return view('contact.thanks');
    }
}
