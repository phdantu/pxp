@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
                <br><br>
                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Quem</th>
                                <th scope="col">Jogo</th>
                                <th scope="col">Data</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 5; $i++)
                                <tr>
                                  <th scope="row">Fulano</th>
                                  <td>Jogo X</td>
                                  <td>Hj</td>
                                </tr>

                                @endfor
                            </tbody>
                          </table>
                          <br><br>
            </div>
    </div>
</div>
@endsection
