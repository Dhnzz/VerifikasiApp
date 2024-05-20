<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="post">
        @csrf
        @method('put')
        <label for="">NIM</label>
        <input type="text" class="form-control" name="credential" value="{{ $mahasiswa->user->credential }}">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="name" value="{{ $mahasiswa->name }}">
        <label for="">Angkatan</label>
        <input type="text" class="form-control" name="angkatan" value="{{ $mahasiswa->angkatan }}">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password">
        <button type="submit">Submit</button>
    </form>
</body>

</html>
