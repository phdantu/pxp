@extends('layout')

@section('content')
<br><br>
    <div class="container">
        <div class="col-md-12">
            <div class="bg-game">
                <div class="row">
                <div class="col-md-2"><img src="{{ $user->avatarUrl() }}" alt="avatar"></div>
                    <div class="col-md-10">
                        <div class="row">
                            <h1>{{ $user->onlineId() ?? 'test' }}</h1>
                        </div>
                        <div class="row">
                                <footer class="blockquote-footer">{{ $user->aboutMe() ?? 'test' }}</footer>
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
                        <div class="col-md-2">
                            <img class="img-thumbnail" src="{{ $g->imageUrl() }}" alt="">
                        </div>
                        <div class="col-md-4">
                            <a href="/game/{{ $g->titleId() }}" class="row">{{ $g->name() }}</a>
                            <div class="row">
                            <img class="imgTrophies" src="{{ asset('images/3.png') }}" alt="" >
                                <h6 class="textTrophy">{{ $g->definedTrophies()['bronze'] }}</h6>
                            <img class="imgTrophies" src="{{ asset('images/2.png') }}" alt="">
                                <h6 class="textTrophy">{{ $g->definedTrophies()['silver'] }}</h6>
                            <img class="imgTrophies" src="{{ asset('images/1.png') }}" alt="">
                                <h6 class="textTrophy">{{ $g->definedTrophies()['gold'] }}</h6>
                            @if ( $g->definedTrophies()['gold'] > 0 )
                            <img class="imgTrophies" src="{{ asset('images/0.png') }}" alt="">
                                <h6 class="textTrophy">{{ $g->definedTrophies()['gold'] }}</h6>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="container">
                                <h5 class="textTrophy" >Progresso</h5>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $g->getPercentual() }}%;" aria-valuenow="{{ $g->getPercentual() }}" aria-valuemin="0" aria-valuemax="100">{{ $g->getPercentual() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
    <br><br>
@endsection
