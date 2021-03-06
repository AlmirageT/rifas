@extends('layouts.public.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.nice-number.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/sweetalert2.css') }}">
<style>
  .portada{
      background-image: url('{{ asset('images/banner_Mesa de trabajo 1.jpg') }}'); 
      background-size: cover;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      width:100%;
      height:100%;
    }
    .responsive {
      width: 100%;
      height: auto;
    }
</style>
<style type="text/css">
    .swal2-modal {
        max-width: 100%;
        padding: 5px;
        margin: 5px;
    }

    .swal2-image {
        height: auto !important;
        width: auto !important;
        margin: auto;
    }
    .carousel {
        /height: 100vh;/
        width: 100%;
        overflow:hidden;
    }
    .carousel .carousel-inner {
        height:100%;    
    }
    .carousel .carousel-inner img {
        display:block;
        object-fit: cover;
    }
</style>
<style>
  .swal2-confirm{
    width: 100px !important;
  }
</style>
@endsection
@section('imagen-inicio')
<a href="{{ asset('/') }}"><img src="{{ asset('images/logo-blanco.png') }}" alt=""></a>
@endsection
@section('cont-header')
<div class="single-item">
  <img src="{{ asset('images/banner_Mesa de trabajo 1.jpg') }}" alt="" class="responsive">
  <img src="{{ asset('images/BANNER 2_Mesa de trabajo 1.jpg') }}" alt="" class="responsive">

</div>
{{-- 
<a class="btn-comprar-flotante letras-btn" href="{{ asset('tienda-rifo-propiedades') }}">Comprar<br><i class="fas fa-shopping-cart" aria-hidden="true"></i> </a>
 --}}

<div class="cont-header">
  <div class="cont-tittle">
    {{--  
      <h1 class="ml2">Rifa Departamento de Lujo</h1> <br>--}}
      <p class="wow slideInLeft" data-wow-delay="0.6s">No llegaste a Rifopoly porque sí, cree en tu suerte. Compra tu número y desafía al destino.</p> 
      <p class="wow slideInLeft" data-wow-delay="0.6s">Valor ticket de la suerte : <strong>${{ number_format($propiedades->first()->valorRifa,0,',','.') }}.-</strong></p>
      <br>
      <p class="">Son 10 premios: Departamento de Lujo(premio mayor) y 9 premios en efectivo.</p>

      <br> <br>
      <a href="{{ asset('tienda-rifo-propiedades') }}">Ver Premios <i class="far fa-building"></i></a> 
      <!--<a href="{{ asset('tienda-rifo-propiedades') }}">Quiero saber más</a>-->
  </div>
{{--  
  <div class="cont-img wow fadeInUp" data-wow-delay="0.7s">
      <img src="{{ asset('images/gifHomeCompress.gif') }}" alt="">
  </div>--}}
</div>
{{--  
<div class="circle"></div> --}}
<div class="flotante-compraProp">
  <form action="{{ asset('compra-ticket-directo') }}/{{ $propiedades->first()->idPropiedad }}" method="POST">
    @csrf
      <label for="numero" class="tamanoLetra">Cantidad de Tickets</label>
      <input type="number" id="numero"  name="numero" class="" placeholder="" value="1" min="1">
      
      <p class="tamanoLetra" id="totalBoletos">TOTAL: ${{ number_format($propiedades->first()->valorRifa,0,',','.') }}.-</p>
      <div class="cont-botonesCompra">
      <button class="btnCompra" type="submit">Comprar ahora</button>
      <!--<button class="btnCarrito" type="submit">Agregar al carrito</button> -->
  </div>
  </form>
</div>
@endsection

@section('content')
<div class="cont-seccion2">
  <div class="seccion-1">
    <div class="cont-video">
      <iframe src="https://www.youtube.com/embed/hC9sOjeMOHU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div> 
  </div>
  <div class="seccion-2">
      <h2 class="wow zoomIn">¿Dónde y cómo se realiza?</h2>
      <p class="wow fadeInUp">Comprando tu ticket de la suerte por ${{ number_format($propiedades->first()->valorRifa,0,',','.') }} participas en el sorteo de 10 premios en total. Se realizará en la notaria Manquehual de Santiago, ante Notario, jefa de Registro y Mr. Rifopoly. Se transmitirá por YouTube live y redes sociales, de este modo todos los compradores pueden presenciarlo.</p>
  </div>
</div>
<main class="cont-body ">
  <h2 class="wow fadeInRight">Este departamento puede ser tuyo</h2> 
  <div class="seccion1 swiper-container ">
      <div class="swiper-wrapper">
      <br>
        @foreach ($propiedades as $propiedad)
          @php
              $nombrePropiedad = str_replace(" ", "-", $propiedad->nombrePropiedad);
          @endphp
          <div class="cont-propiedades swiper-slide">
              <div class="cont-tour wow zoomIn" data-wow-delay="1s">
                  <h3>La propiedad</h3>
                  <br>
                  <img src="{{ $propiedad->fotoPrincipal }}" alt="Propiedad en rifa">
                  <!--<iframe class="frame-mapa" src="{{ $propiedad->urlGoogleMaps }}" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
              </div>

              <div class="cont-lista wow zoomIn" data-wow-delay="0.4s">
                  <h3>{{ $propiedad->nombrePropiedad }}</h3>
                  <h4><i class="fas fa-map-marker-alt"></i> {{ $propiedad->nombreComuna }}, {{ $propiedad->nombreRegion }}</h4>
                  <p>{!! $propiedad->descripcionPropiedad !!}</p>
                  {{--  <p> <strong>Hay {{ $propiedad->cantidadTotalPremios }} premios esperando por ti.</strong> </p>
                  <br>
                  
                  @if ($premios->where('idPropiedad',$propiedad->idPropiedad))
                    @php
                        $arraySinEdicion = $premios->where('idPropiedad',$propiedad->idPropiedad);
                        $primerValorPremios = $arraySinEdicion->shift();
                    @endphp
                    <ul>
                        <h4><i class="fas fa-award"></i> {{ $primerValorPremios['nombreTipoPremio'] }}</h4>
                        <li>{!! $primerValorPremios['descripcion'] !!}</li>
                    </ul> <br>
                    @foreach ($arraySinEdicion as $premio)
                      <ul>
                          <h4><i class="fas fa-money-bill-alt"></i> {{ $premio->nombreTipoPremio }}</h4>
                          <li> {!! $premio->descripcion !!}</li>
                      </ul><br>
                    @endforeach
                  @endif
                  <br> <br>--}}
                  <br>
                  <a class="btn-tickets" href="{{ asset('rifo-propiedades/detalle') }}?nombrePropiedad={{ $nombrePropiedad }}&idPropiedad={{ Crypt::encrypt($propiedad->idPropiedad) }}">Quiero saber más</a>
                  <br> <br>
              </div>
          </div>
        @endforeach

      </div>
     <!-- <div class="swiper-pagination"></div> 
   <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div> -->
  </div>

  


</main>

<!--    <div class="contenedor-tarjetas-home">
<div class="tarjetas-home">
  <div class="imgBX">
<a href="detalle.html"> <img src="images/edificio - copia.jpg" alt=""> </a>
  </div>
  <div class="content-card-home">
<h2>Marina Golf Rapel</h2>
<p>Departamento de Lujo</p>
  </div>

</div>

<div class="tarjetas-home">
  <div class="imgBX">
      
<img src="images/edificio - copia.jpg" alt="">
  </div>
  <div class="content-card-home">
<h2>Card One</h2>
<p>Lorem ipsum, dolor</p>
  </div>
</div>

<div class="tarjetas-home">
  <div class="imgBX">
<img src="images/edificio - copia.jpg" alt="">
  </div>
  <div class="content-card-home">
<h2>Card One</h2>
<p>Lorem ipsum, dolor.</p>
  </div>
</div>

</div> -->




<div id="contacto"  class="cont-form">
  <div class="contenedor-form">
      <form action="{{ asset('enviar-consulta') }}" class="formulario-bottom" method="post">
        @csrf
          <h2 class="">CONTÁCTANOS</h2>
          <div style="text-align: center;">
            <a style="color: black" href="tel:+56942940824" ><i class="fa fa-mobile"></i>Asistente Teléfonico +56 9 4294 0824</a>
            <br>
          </div>
          <label for="nombre" class="form-label"></label>
          <input type="text" id="nombre" name="nombre" class="form-input-bottom" placeholder="Tu Nombre" required>
          
          <label for="correo" class="form-label"></label>
          <input type="email" name="correo" id="correo" class="form-input-bottom" placeholder="Correo Electr&oacute;nico" required>
          
          <label for="fono" class="form-label"></label>
          <input type="number" id="fono" name="fono" class="form-input-bottom" placeholder="Tel&eacute;fono 987654321" min="111111111" max="999999999" required>
          
          <label for="msg" class="azul form-label">Escribe tu mensaje a continuación</label>
          <textarea class="form-input" id="msg" cols="30" rows="5" name="consulta" required > </textarea>
          
          <input type="submit" class="btn-submit-bottom" value="Solicita información">
      </form>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/jquery.nice-number.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script>
  $(function(){
    $('#numero').niceNumber({
        onIncrement: function () {
            
            var cantidadTickets = document.getElementById('numero').value;
            var total = {{ $propiedad->valorRifa }} * cantidadTickets;
            total = total.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            total = total.split('').reverse().join('').replace(/^[\.]/,'');
            document.getElementById('totalBoletos').innerHTML = 'TOTAL: $'+total+'.-';
            
        },
        onDecrement: function () {
            var cantidadTickets = document.getElementById('numero').value;
            var total = {{ $propiedad->valorRifa }} * cantidadTickets;
            total = total.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            total = total.split('').reverse().join('').replace(/^[\.]/,'');
            document.getElementById('totalBoletos').innerHTML = 'TOTAL: $'+total+'.-';
        },
    });
  });
</script>
<script>
  
  var swiper = new Swiper('.swiper-container', {
      pagination: {
          el: '.swiper-pagination',
          type: 'progressbar',
      },
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
  });
  
  

</script>
<script>
  $('.single-item').slick({
    autoplay: true,
    autoplaySpeed: 3000,
  });
</script>
<script>
  $(document).ready(function(){
    // initAlert();
    function initAlert() {

        Swal.fire({
            imageUrl: '{{ asset('/images/popup RIFOPOLY_pop up.jpg') }}',
            imageHeight: 300,
            imageAlt: 'pop up',
            allowEscapeKey: true,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            showCloseButton: true,
            cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
            timer: 150000
        }).then((result) => {
            if (result.value) {
                console.log(result.value);
            }
        });
      }
  });
</script>
@endsection