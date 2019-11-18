
@extends('layout')
@section('content')
<div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form class="form-signin">
                  <div class="form-label-group">
                    <input type="text" id="inputLogin" class="form-control" placeholder="Login" required autofocus>
                  </div>
                  <br>
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                  </div>

                  <div class="custom-control custom-checkbox mb-3">
                  </div>
                  <button class="site-btn btn-sm" type="submit">Entrar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
