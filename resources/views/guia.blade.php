@extends('layout')
@section('content')
        <!-- Latest news section -->
        <div class="latest-news-section">
            <div class="ln-title">Latest News</div>
            <div class="news-ticker">
                <div class="news-ticker-contant">
                    <div class="nt-item"><span class="new">new</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
                    <div class="nt-item"><span class="strategy">strategy</span>Isum dolor sit amet, consectetur adipiscing elit. </div>
                    <div class="nt-item"><span class="racing">racing</span>Isum dolor sit amet, consectetur adipiscing elit. </div>
                </div>
            </div>
        </div>
        <!-- Latest news section end -->


        <!-- Page info section -->
        <section class="page-info-section set-bg" data-setbg="{{ asset('img/page-top-bg/1.jpg') }}">
            <div class="pi-content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 text-white">
                            <h2>{{ $guias->nome_guia }}</h2>
                            <p>Aqui você encontra os guias para finalizar seus jogos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page info section -->


        <!-- Page section -->
        <section class="page-section recent-game-page spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xg-8">
                        <div class="card">
                            <h6 class="card-header">Troféus</h6>
                            @foreach($guiaTrofeus as $g)
                                    <div class="card-header" id="headingOne">
                                        <div class="row align-items-start"><!-- DIV PARA CADA TROFEU -->
                                            <div class="col-md-2"><!-- IMAGEM DESCRIÇÂO E TITULO DO TROFEU -->
                                                <image class="img-thumbnail" src="/images/{{ $g->tipo }}.png" height="30px" ></image>
                                            </div>
                                            <div class="col-md-10">
                                                <font color="#6583be"><h5>{{ $g->nome }}</h5></font>
                                                <font size="2"><p>{{ $g->detalhes }}</p></font>
                                            </div>
                                        </div>
                                    </div>
                                          <!-- ID DITA ANTERIORMENTE -->
                                    <div class="card-body"> <!-- descricao trofeu -->
                                        {!! $g->descricao !!}
                                    </div>
                                    @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page section end -->


@endsection
