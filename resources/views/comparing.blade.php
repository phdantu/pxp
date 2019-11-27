@extends('layout')

@section('content')
<br><br>
    <div class="container">
        <div class="col-md-12">
            <div class="bg-game">
                <div class="row">
                        {{-- Meu avatar --}}
                    <div class="offset-1 col-md-2"><img src="{{ $me->avatarUrl() }}" alt="avatar"></div>
                        {{-- Avatar Amigo --}}
                    <div class="offset-4 col-md-2"><img src="{{ $friend->avatarUrl() }}" alt="avatar"></div>
                </div>
                <div class="row">
                    <div class="offset-1 col-md-5">
                        <div class="row">
                            <h1>{{ $me->onlineId() ?? 'test' }}</h1>
                        </div>
                        <div class="row">
                                <footer class="blockquote-footer">{{ $me->aboutMe() ?? 'test' }}</footer>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="row">
                            <h1>{{ $friend->onlineId() ?? 'test' }}</h1>
                        </div>
                        <div class="row">
                                <footer class="blockquote-footer">{{ $friend->aboutMe() ?? 'test' }}</footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- area onde sera mostrado o Jogo e seus trofeus --}}
        @foreach ($gamesGroups as $g)
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-2">
                            @foreach ($g as $gg)
                                <img class="img-thumbnail" src="{{ $gg->game->game->trophyTitleIconUrl }}" alt="">
                                @break
                            @endforeach
                        </div>
                            @php
                                $myProgress = 0.00; $fProgress = 0.00; $total = 0;
                                foreach($g as $group){
                                    if(property_exists($group->group,'comparedUser')){
                                        $fProgress = $fProgress +  $group->group->comparedUser->earnedTrophies->bronze +
                                                        $group->group->comparedUser->earnedTrophies->silver +
                                                        $group->group->comparedUser->earnedTrophies->gold +
                                                        $group->group->comparedUser->earnedTrophies->platinum;
                                    }
                                    if(property_exists($group->group,'fromUser')){
                                        $myProgress = $myProgress + $group->group->fromUser->earnedTrophies->bronze +
                                                        $group->group->fromUser->earnedTrophies->silver +
                                                        $group->group->fromUser->earnedTrophies->gold +
                                                        $group->group->fromUser->earnedTrophies->platinum;
                                    }
                                    $total = $total + $group->group->definedTrophies->bronze +
                                                $group->group->definedTrophies->silver +
                                                $group->group->definedTrophies->gold +
                                                $group->group->definedTrophies->platinum;
                                }
                            @endphp

                        @php
                            $myProgress = number_format(($myProgress/$total)*100,2,'.','');
                            if($fProgress > 0){
                                $fProgress = number_format(($fProgress/$total)*100,2,'.','');
                            }

                        @endphp
                        {{-- meu usuario --}}
                        <div class="col-md-4">
                            <div class="container">
                                <h5 class="textTrophy" >Progresso</h5>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $myProgress }}%;"
                                        aria-valuenow="{{ $myProgress }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $myProgress }}%</div>
                                </div>
                            </div>
                        </div>
                        {{-- amigo --}}
                        <div class="col-md-4">
                            <div class="container">
                                <h5 class="textTrophy" >Progresso</h5>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $fProgress }}%;"
                                        aria-valuenow="{{ $fProgress }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $fProgress }}%</div>
                                </div>
                            </div>
                        </div>
                        @if ($myProgress > $fProgress)
                            <div class="col-md-1 center">
                                <form action="{{url('/notificacao/insert/')}}" method="post">
                                    @csrf
                                    <button class="btn-primary" id="pokeJogo" name="pokeJogo" type="submit" value="{{ $gg->game->game->trophyTitleName }}">Desafiar</button>
                                    <input type="hidden" id="pokeUserTo" name="pokeUserTo" value="{{ $friend->onlineId() }}">
                                    <input type="hidden" id="pokeUserFrom" name="pokeUserFrom" value="{{ $me->onlineId() }}">
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        @endforeach
    </div>
    <br><br>
@endsection
