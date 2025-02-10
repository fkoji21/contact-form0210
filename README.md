# お問い合わせフォーム（ログイン機能あり）

## 環境構築手順

1. **コンテナを立ち上げる**
    ```bash
    docker compose up -d --build
    ```

2. **環境変数ファイル（.env）を作成**
    ```bash
    cp src/.env.example src/.env
    ```
    → `.env` の中身を確認し、**DB の設定が正しいか確認** する。

3. **PHP コンテナに入る**
    ```bash
    docker compose exec php bash
    ```

4. **Composer のインストール**
    ```bash
    composer install
    ```

5. **アプリケーションキーを生成**
    ```bash
    php artisan key:generate
    ```

6. **マイグレーションを実行（テーブル作成）**
    ```bash
    php artisan migrate
    ```

7. **（オプション）シーディングを実行（ダミーデータ登録）**
    ```bash
    php artisan db:seed
    ```
    ⚠ `db:seed` は **ダミーデータを入れたい場合のみ実行** してください。

8. **ブラウザで動作確認**
    - `http://localhost/` にアクセスしてアプリが動作するか確認する。
    - `http://localhost:8080/` にアクセスして phpMyAdmin でデータを確認できる。

## **使用技術（実行環境）**
- **言語**: PHP 8.2.27
- **フレームワーク**: Laravel 8.83.29
- **データベース**: MariaDB 10.3.39
- **コンテナ管理**: Docker, docker-compose  
- **フロントエンド**: Bladeテンプレート, HTML, CSS  
- **認証**: Laravel Fortify  