@extends('layout')

@section('content')
<br><br>
    <div class="container">
        <div class="col-md-12">
            <div class="card bg-game">
                <div class="row">
                <div class="col-md-2"><img src="{{ $user->avatarUrl() }}" alt="avatar"></div>
                    <div class="col-md-10">
                        <div class="row">
                            <h1>{{ $user->onlineId() ?? 'test' }}</h1>
                        </div>
                        <div class="row">
                            {{ $user->aboutMe() ?? 'test' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- area onde sera mostrado o Jogo e seus trofeus --}}
        @foreach ($games as $g)
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                    <div class="col-md-2"><img src="{{ $g->imageUrl() }}" alt=""></div>
                        <div class="col-md-10">
                            <div class="row">{{ $g->name() }}</div>
                            <div class="row">tesestes</div>
                        </div>
                    </div>
                    {{--<div class="row">
                        <div class="col-md-2">

                        </div>
                         <div class="col-md-9">
                            <div class="row">nome do trofeu</div>
                            <div class="row">descricao do trofeu</div>
                        </div>
                        <div class="col-md-1">percentual do trofeu</div>
                    </div>--}}
                </div>
            </div>

        @endforeach
    </div>
    <br><br>
@endsection
