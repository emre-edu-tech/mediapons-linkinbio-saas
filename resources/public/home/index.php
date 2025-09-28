<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Home') ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main style="padding: 2rem; font-family: sans-serif;">
        <h1><?= htmlspecialchars($title ?? 'Welcome!') ?></h1>
        <p>This is your <strong>Home Page</strong>. The Router, Controller, and View system are working!</p>

        <nav style="margin-top: 1rem;">
            <a href="/">Home</a> |
            <a href="/about">About</a>
        </nav>
    </main>
</body>
</html>
