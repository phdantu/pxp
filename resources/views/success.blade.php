@extends('layout')

@section('content')
<br><br>
<div class="containter">
    <div class="col-md-12">
        <div class="text-center">

            <h4>Seu {{ $method }} foi enviado com sucesso para {{ $value['usuarioDestino'] }}</h4>
        </div>
    </div>
</div>

<br><br>
@endsection
