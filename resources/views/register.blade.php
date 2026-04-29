<!DOCTYPE html>
<html>
<head><title>Registrasi</title></head>
<body>
    <h2>Pendaftaran Akun</h2>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf <label>Nama:</label><br>
        <input type="text" name="name" required><br><br>

        <label>No HP:</label><br>
        <input type="text" name="no_hp" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Daftar</button>
    </form>
</body>
</html>