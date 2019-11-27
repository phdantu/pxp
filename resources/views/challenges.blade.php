@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                <br><br>
                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Quem enviou</th>
                                <th scope="col">Jogo</th>
                                <th scope="col">Data</th>
                              </tr>
                            </thead>
                            @foreach ($notif as $n)
                            <tbody>
                                    <th scope="row">{{ $n->usuarioRemetente }}</th>
                                    <td>{{ $n->jogos }}</td>
                                    <td>{{ $n->created_at->format('d/m/Y') }}</td>
                                </tbody>
                                @endforeach
                          </table>
                          <br><br>
            </div>
    </div>
</div>
@endsection
