<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'お問い合わせフォーム')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('contact.index') }}">ホーム</a></li>
                <li><a href="{{ route('admin.index') }}">管理画面</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 お問い合わせフォーム</p>
    </footer>
</body>
</html>
