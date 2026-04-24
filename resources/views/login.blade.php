<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Silakan Login</h2>

    @if(session('success'))
        <p style="color: green"><b>{{ session('success') }}</b></p>
    @endif

    @if($errors->any())
        <p style="color: red"><b>{{ $errors->first() }}</b></p>
    @endif

    <form action="/login" method="POST">
        @csrf
        <label>No HP:</label><br>
        <input type="text" name="no_hp" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Masuk</button>
    </form>
</body>
</html>