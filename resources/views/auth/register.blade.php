<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif


<div class="d-flex justify-content-center m-5">
  <div class="row justify-content-center">
    <div class="col">
        <div class="card" style="width: 28rem;">
            <div class="card-body">
                <h2 class="card-title">Registro do Cliente</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Nome:</label>
                            <input class="form-control" type="text" name="name" required><br><br>
                        </div>

                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Email:</label>
                            <input class="form-control" type="email" name="email" required><br><br>
                        </div>

                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Senha:</label>
                            <input class="form-control" type="password" name="password" required><br><br>
                        </div>

                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Confirme a Senha:</label>
                            <input class="form-control" type="password" name="password_confirmation" required><br><br>
                        </div> 
                    </div>
                    <button class="btn btn-primary" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>
