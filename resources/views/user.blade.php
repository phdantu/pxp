@extends('layout')
@section('content')
        <!-- Page section -->
        <section class="page-section recent-game-page spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                IconePSN
                            </div>
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <img class="trofeu-image" src="{{ asset('images/0.png') }}" alt=""> 12
                                    </div>
                                    <div class="col-lg-2">
                                        <img class="trofeu-image" src="{{ asset('images/1.png') }}" alt=""> 21212
                                    </div>
                                    <div class="col-lg-2">
                                        <img class="trofeu-image" src="{{ asset('images/2.png') }}" alt=""> 1212
                                    </div>
                                    <div class="col-lg-2">
                                        <img class="trofeu-image" src="{{ asset('images/3.png') }}" alt=""> 12122
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                Jogo 1
                            </div>
                            <div class="col-lg-8">
                                Nome e descrição do Jogo
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                Grupo de Trofeu (se houver)
                            </div>
                            <div class="col-lg-8">
                                Nome e descrição do GrupoTrofeu
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                Trofeu 1
                            </div>
                            <div class="col-lg-8">
                                Nome e descrição do Trofeu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page section end -->


@endsection
