<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $mahasiswa->user->credential }}</h1>
    @if ($mahasiswa->dosen_id != null)
        <h1>{{ $mahasiswa->dosen->name }}</h1>
    @else
        <h1>Mahasiswa belum memiliki dosen verificator</h1>
    @endif
    <h1>{{ $mahasiswa->name }}</h1>
    <h1>{{ $mahasiswa->angkatan }}</h1>
    <h1>Password tidak dapat ditampilkan karena alasan keamanan.</h1>
    <a href="{{ route('mahasiswa.index') }}">Kembali</a>
</body>
</html>

