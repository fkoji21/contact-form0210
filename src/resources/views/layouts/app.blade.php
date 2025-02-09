<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <h1 class="title">FashionablyLate</h1>
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
