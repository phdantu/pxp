@extends('layout')
@section('content')
{{-- <div class="row">
        <div class="col-md-4">
            <img src="{{ $games->imageUrl() }}" alt="">
        </div>
        <div class="col-md-8 center bgTitleGame">
            <h4>{{ $games->name() }}</h4>
        </div>
    </div> --}}
    <!-- Page info section -->
    {{ $dir = '' }}
    <section class="page-info-section set-bg" data-setbg="{{ asset('img/page-top-bg/'.rand(1,5).'.jpg') }}">
        <div class="pi-content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 text-white">
                        <h2 class="borderText">{{ $games->name() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="col-md-12">
        @foreach ($games->trophyGroups() as $tg)
            @if ($tg->id() != "default")
                <h6 class="text-center" style="padding-top:4%; padding-bottom:4%">DLC {{ $tg->name() }}</h6>
            @else
                <h6 class="text-center" style="padding-top:4%; padding-bottom:4%">Troféus Principais</h6>
            @endif
            @foreach ($tg->trophies("pt") as $t)
            <div class="card bgTitleGame">
                <div class="row">
                    <div class="col-md-1">
                    <img class="imgTrophiesGamePage" src="{{ $t->iconUrl() }}" alt="">
                    </div>
                    <div class="col-md-8">
                        <div class="row"> <b>{{ $t->name() }}</b></div>
                        <div class="row">{{ $t->detail() }}</div>
                    </div>
                    <div class="col-md-1 center" data-toggle="tooltip"  data-placement="top" title="Percentual de Conquista">{{ $t->earnedRate() }}%</div>

                    @if ($t->type() == "bronze")
                    <div class="col-md-1 center"><img class="img-responsive img-thumbnail imgTrophyGamePageThumbnail" src="{{ asset('images/3.png') }}" alt="{{ $t->type() }}" data-toggle="tooltip" title="{{ $t->type() }}"></div>
                    @else
                        @if ($t->type() == "silver")
                        <div class="col-md-1 center"><img class="img-responsive img-thumbnail imgTrophyGamePageThumbnail" src="{{ asset('images/2.png') }}" alt="{{ $t->type() }}" data-toggle="tooltip" title="{{ $t->type() }}"></div>
                        @else
                            @if ($t->type() == "gold")
                            <div class="col-md-1 center"><img class="img-responsive img-thumbnail imgTrophyGamePageThumbnail" src="{{ asset('images/1.png') }}" alt="{{ $t->type() }}" data-toggle="tooltip" title="{{ $t->type() }}"></div>
                            @else
                            <div class="col-md-1 center"><img class="img-responsive img-thumbnail imgTrophyGamePageThumbnail" src="{{ asset('images/0.png') }}" alt="{{ $t->type() }}" data-toggle="tooltip" title="{{ $t->type() }}"></div>
                            @endif
                        @endif
                    @endif
                    @if (property_exists($t->trophy,'fromUser') && $t->trophy->fromUser->earned == true)
                        <div class="col-md-1 center"><img class="img-responsive img-thumbnail imgTrophyGamePageThumbnail" src="{{ asset('img/icons/earned.png') }}" alt="Earned" data-toggle="tooltip" title="Conquistou em: {{ date('d/m/Y', strtotime($t->trophy->fromUser->earnedDate)) }}"></div>
                    @endif
                </div>
            </div>
            @endforeach
        @endforeach
    </div>
</div>
<br><br>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
