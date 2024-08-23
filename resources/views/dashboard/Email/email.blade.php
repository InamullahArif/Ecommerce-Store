<!DOCTYPE html>
<html>
<head>
    <title>Get 5% Off on Our Latest Product!</title>
</head>
<body>
    <h1>Hello {{ $name }},</h1>
    <p>We are excited to offer you a special 5% discount on our latest product!</p>
    <h2>{{ $latestProduct->name }}</h2>
    <p>{{ $latestProduct->description->description }}</p>
    <p><strong>Regular Price:</strong> ${{ $latestProduct->price }}</p>
    <p>Use the code <strong>NEW5OFF</strong> at checkout to receive your discount.</p>
    <p>Thank you for being a valued customer!</p>
</body>
</html>
