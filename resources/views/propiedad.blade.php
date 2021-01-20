@extends('layouts.public.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.nice-number.css') }}">
@endsection

@section('content')
<main class="cont-body int-mobile">
    <h1 class="ml2">Escoge la rifa que quieres ganar</h1>
    <br>
    <form class="form-buscar wow slideInLeft" data-wow-delay="0.4s" action="{{ asset('tienda-rifo-propiedades') }}" method="POST">
        @csrf
        <input class="form-control-buscar lg-12" type="search" placeholder="Buscar" aria-label="Search" name="buscadorDeRifa">
        <button class="btn-buscar" type="submit">Buscar</button>
      </form>
    <br>
    
      <!--  <div class="cont-tarjetas">
    <div class="tarjeta wow fadeInUpBig" data-wow-delay="0.6s"> 
       <div>
           <ul class="share">
               <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
               <li><a href=""><i class="fab fa-twitter"></i></a></li>
           </ul>
           <p class="precio">$20.000.-</p>
           <img src="images/edificio.jpg" alt="">
        </div>
       <div class="text-tarjeta">
           <h3>Lorem, ipsum.</h3>
           <p><i class="fas fa-map-marker-alt"></i> Ubicación</p>
           <p>Lorem ipsum dolor sit amet consectetur.</p>
           <div>
               <ul>
                   <li><i class="fas fa-home"></i> x.xxx UF</li>
                   <li><i class="fas fa-bed"></i> 3 Dorm</li>
                   <li><i class="fas fa-bath"></i> 2 Baños</li>
                   <li><i class="fas fa-gift"></i> Regalos Sorpresa</li>
               </ul>
           </div>
    </div> <br>
    <a class="btn-tickets-int" href="detalle.html">Detalles</a>
    </div> <br>
    <div class="tarjeta wow fadeInUpBig" data-wow-delay="0.8s">
        <div>
            <ul class="share">
                <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
                <li><a href=""><i class="fab fa-twitter"></i></a></li>
            </ul>
            <p class="precio">$20.000.-</p>
            <img src="images/edificio.jpg" alt="">
         </div>
        <div class="text-tarjeta">
            <h3>Lorem, ipsum.</h3>
            <p><i class="fas fa-map-marker-alt"></i> Ubicación</p>
            <p>Lorem ipsum dolor sit amet consectetur.</p>
            <div>
                <ul>
                    <li><i class="fas fa-home"></i> x.xxx UF</li>
                    <li><i class="fas fa-bed"></i> 3 Dorm</li>
                    <li><i class="fas fa-bath"></i> 2 Baños</li>
                    <li><i class="fas fa-gift"></i> Regalos Sorpresa</li>
                </ul>
            </div>
     </div> <br>
     <a class="btn-tickets-int" href="detalle.html">Detalles</a>
     </div> <br>
    
     <div class="tarjeta wow fadeInUpBig" data-wow-delay="1s">
        <div>
            <ul class="share">
                <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
                <li><a href=""><i class="fab fa-twitter"></i></a></li>
            </ul>
            <p class="precio">$20.000.-</p>
            <img src="images/edificio.jpg" alt="">
         </div>
        <div class="text-tarjeta">
            <h3>Lorem, ipsum.</h3>
            <p><i class="fas fa-map-marker-alt"></i> Ubicación</p>
            <p>Lorem ipsum dolor sit amet consectetur.</p>
            <div>
                <ul>
                    <li><i class="fas fa-home"></i> x.xxx UF</li>
                    <li><i class="fas fa-bed"></i> 3 Dorm</li>
                    <li><i class="fas fa-bath"></i> 2 Baños</li>
                    <li><i class="fas fa-gift"></i> Regalos Sorpresa</li>
                </ul>
            </div>
     </div> <br>
     <a class="btn-tickets-int" href="detalle.html">Detalles</a>
     </div>
    <br>
        </div> -->
        <div class="infinite-scroll" >

            <div class="cont-propiedades1">
                @foreach ($propiedades as $propiedad)
                @php
                    $nombrePropiedad = str_replace(" ", "-", $propiedad->nombrePropiedad);
                @endphp
                    <div class="propiedades wow fadeInUpBig">
                        <div class="slide-img swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset($propiedad->fotoPrincipal) }}" alt="Propiedad a rifar"></div>
                                <div class="swiper-slide"><img src="{{ asset($propiedad->fotoMapa) }}" alt="Mapa ubicación propiedad"></div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="info-propiedad">
                            <p><strong>{{ $propiedad->nombrePropiedad }}</strong></p>
                            <p><i class="fas fa-map-marker-alt"></i>{{ $propiedad->nombreComuna }},{{ $propiedad->nombreRegion }}</p>
                            <p>${{ number_format($propiedad->valorRifa,0,',','.') }}.-</p>
                            <p>{!! $propiedad->descripcionPropiedad !!}</p>
                            <br>
                            <p class="titlePremios">10 premios a repartir</p>
                            <div class="cont-premios-prop">
                                @if ($premios->where('idPropiedad',$propiedad->idPropiedad))
                                    @php
                                        $arraySinEdicion = $premios->where('idPropiedad',$propiedad->idPropiedad);
                                        $primerValorPremios = $arraySinEdicion->shift();
                                    @endphp
                                    <ul class="premios-list">
                                        <p class="titlePremioSingular"><i class="fas fa-award"></i> {{ $primerValorPremios['nombreTipoPremio'] }}</p> 
                                        {!! $primerValorPremios['descripcion'] !!}
                                    </ul>
                                    @foreach ($arraySinEdicion as $premio)
                                    <div class="premios-list">
                                        <p class="titlePremioSingular"><i class="fas fa-money-bill-alt"></i> {{ $premio->nombreTipoPremio }}</p> 
                                        {!! $premio->descripcion !!}
                                    </div>
                                    @endforeach
                                    
                                @endif

                            </div>
                            <br>
                            <div class="cont-botones"> <br>
                                <a class="btn-tickets-int" href="{{ asset('rifo-propiedades/detalle') }}?nombrePropiedad={{ $nombrePropiedad }}&idPropiedad={{ Crypt::encrypt($propiedad->idPropiedad) }}">Detalles</a>
                                <div class="width">
                                    <ul class="share-detail">
                                        @if ($propiedad->urlFacebook)
                                            <li><a target="_blank" href="{{ $propiedad->urlFacebook }}"><i class="fab fa-facebook-square wow bounceIn" data-wow-delay="0.4s"></i></a></li>
                                        @endif
                                        @if ($propiedad->urlInstagram)
                                            <li><a target="_blank" href="{{ $propiedad->urlInstagram }}"><i class="fab fa-instagram wow bounceIn" data-wow-delay="0.6s"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $propiedades->links() }}
        </div>
    </main>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

<script>
$( document ).ready(function() {
    document.getElementById('contenido-cambio').classList.remove('cont-nav');
    document.getElementById('contenido-cambio').classList.add('cont-nav-int');
    
});
</script>
<script>
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
      },
    });
</script>
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            debug: true,
            loadingHtml: '<div align="center"><img src="{{ asset('img/loading.gif') }}" alt="Loading..." /></div>',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: '.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
@endsection