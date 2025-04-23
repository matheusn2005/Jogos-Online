<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login do Cliente</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>
