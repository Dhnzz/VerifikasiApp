<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('mahasiswa.store') }}" method="post">
        @csrf
        <label for="">NIM</label>
        <input type="text" class="form-control" name="credential">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="name">
        <label for="">Angkatan</label>
        <input type="text" class="form-control" name="angkatan">
        <button type="submit">Submit</button>
    </form>
</body>

</html>
