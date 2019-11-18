
@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body">
            <h5 class="card-title text-center">Novo Usuário</h5>
            <form method="POST" action="/new_user" class="form-signin">
                @csrf
                <div class="row">
                    <div class="form-label-group col-md-6">
                        <label for="inputNome">Nome</label>
                        <input type="text" id="inputNome" name="inputNome" class="form-control" required autofocus>
                    </div>
                    <div class="form-label-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" id="inputEmail" name="inputEmail" class="form-control" required autofocus>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-label-group col-md-9">
                        <label for="inputSenha">Senha</label>
                        <input type="password" id="inputSenha" name="inputSenha" class="form-control" data-toggle="tooltip" data-placement="top" title="Mínimo 6 dígitos" required autofocus>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-label-group col-md-8">
                        <label for="inputPsnLogin">Login PSN</label>
                        <input type="text" id="inputPsnLogin" name="inputPsnLogin" class="form-control" required autofocus>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-label-group col-md-8">
                        <label for="inputUuid">Link</label>
                        <input type="text" id="inputUuid" name="inputUuid" class="form-control" required autofocus>
                    </div>
                    <div class="form-label-group col-md-4">
                        <label for="input2SV">Código Celular</label>
                        <input type="text" id="input2SV" name="input2SV" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <button class="site-btn btn-sm" type="submit">Entrar</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
