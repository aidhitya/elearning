<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $judul }}</h1>
    <small>{{ $created_at }}</small>
    @if ($gambar !== null)
        <img src="{{ asset('storage/'. $gambar) }}" alt="">
    @endif
    <p>{!! $isi !!}</p>
</body>
</html>