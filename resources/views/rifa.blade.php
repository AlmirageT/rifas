@extends('layouts.public.app')
@section('meta')
    <meta property="og:url" content="{{ $url }}">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Participa por esta propiedad {{ $propiedad->nombrePropiedad }}" >
    <meta property="og:description" content="Una propiedad de lujo puede ser tuya por ${{ number_format($propiedad->valorRifa,0,',','.') }}" >
    <meta property="og:image" content="{{ asset($propiedad->fotoPrincipal) }}" >
    <meta property="og:image:width" content="200" >
    <meta property="og:image:height" content="200" >
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.nice-number.css') }}">
@endsection
@section('imagen-inicio')
<a href="{{ asset('/') }}"><img src="{{ asset('images/logo rifopoly_Mesa de trabajo 1.png') }}" alt=""></a>
@endsection
@section('content')
<main class="cont-body int-mobile">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1 class="ml2">{{ $propiedad->nombrePropiedad }}</h1>
    <br>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            
            <div class="contenedor-galeria swiper-slide">
                <div class="img1">
                    <div class="contenedor-videos wow zoomIn">
                        <video controls>
                            <source  src="{{ asset($propiedad->urlVideo) }}">
                        </video>
                        
                    </div>
                </div>
                <div class="mosaic">
                    @for ($i = 0; $i < count($imagenesPropiedad); $i++)
                        @if (($i+1)%7 == 0)
                            @break
                        @else
                            <a href="{{ asset($imagenesPropiedad[$i]->urlImagen) }}" data-lightbox="roadtrip"><img src="{{ asset($imagenesPropiedad[$i]->urlImagen) }}" alt=""></a> 
                        @endif
                    @endfor
                    
                </div>
            </div>

            <div class="contenedor-galeria swiper-slide">
                <div class="img1">
                    @if (isset($portada1->urlImagen))
                        <a href="{{ asset($portada1->urlImagen) }}" data-lightbox="roadtrip"><img src="{{ asset($portada1->urlImagen) }}" alt=""></a> 
                    @endif
                </div>
                <div class="mosaic">
                    @for ($i = 7; $i < count($imagenesPropiedad); $i++)
                        @if (($i+1)%14 == 0)
                            @break
                        @else
                            <a href="{{ asset($imagenesPropiedad[$i]->urlImagen) }}" data-lightbox="roadtrip"><img src="{{ asset($imagenesPropiedad[$i]->urlImagen) }}" alt=""></a> 
                        @endif
                    @endfor
                </div>
            </div>
            <div class="contenedor-galeria swiper-slide">
                <div class="img1">
                    @if (isset($portada2->urlImagen))
                        <a href="{{ asset($portada2->urlImagen) }}" data-lightbox="roadtrip"><img src="{{ asset($portada2->urlImagen) }}" alt=""></a> 
                    @endif
                </div>
                <div class="mosaic">
                    @for ($i = 14; $i < count($imagenesPropiedad); $i++)
                        @if (($i+1)%21 == 0)
                            @break
                        @else
                            <a href="{{ asset($imagenesPropiedad[$i]->urlImagen) }}" data-lightbox="roadtrip"><img src="{{ asset($imagenesPropiedad[$i]->urlImagen) }}" alt=""></a> 
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <br>
    <div class="flotante-compra" id="btn-flotante">
        <form action="{{ asset('compra-ticket-directo') }}/{{ $propiedad->idPropiedad }}" method="POST">
            @csrf
            <label for="numero" class="tamanoLetra">Cantidad de Tickets</label> <br> <br>
            <input type="number" id="numero" name="numero" class="" placeholder="" value="1" min="1">
            <br> <br>
            <p class="tamanoLetra" id="totalBoletos">TOTAL: ${{ number_format($propiedad->valorRifa,0,',','.') }}.-</p>
            <div class="cont-botonesCompra">
                <button class="btnCompra" style="cursor:pointer;" type="submit">Comprar ahora</button>
                {{--  
                <button class="btnCarrito"  style="cursor:pointer;" onclick="agregarPropiedadCarrito(event)">Agregar al carrito</button>
                --}}
            </div>
        </form>
    </div> 
    <br>
    <div class="cont-detalles" id="cont-detalles">
        <h3 class="text-detail wow fadeInLeft" data-wow-delay="0.4s">{{ $propiedad->subtituloPropiedad }}</h3>
        <h4 class="text-detail wow fadeInLeft" data-wow-delay="0.4s"><i class="fas fa-map-marker-alt"></i> {{ $propiedad->nombreComuna }}, {{ $propiedad->nombreRegion }}</h4>
        <ul class="share-detail margen">
            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"><i class="fab fa-facebook-square wow bounceIn" data-wow-delay="0.4s"></i></a></li>
            <li><a target="_blank" href="https://twitter.com/intent/tweet?text=Una propiedad de lujo puede ser tuya por ${{ number_format($propiedad->valorRifa,0,',','.') }}&amp;url={{ $url }}"><i class="fab fa-twitter wow bounceIn" data-wow-delay="0.6s"></i></a></li>
        </ul>
        <hr>
        <br>
        <p class="text-detail wow fadeInLeft" data-wow-delay="0.6s">{!! $propiedad->descripcionDetalle !!}</p> <br>
        <ul class="text-detail wow fadeInLeft" data-wow-delay="0.7s">
            @foreach ($propiedadCaracteristicas as $propiedadCaracteristica)
                <li><i class="{{ $propiedadCaracteristica->itag }}"></i> {{ $propiedadCaracteristica->descripcionCaracterisitca }}</li>
            @endforeach
        </ul> <br>
        {{--  
        @if ($propiedad->pdfBasesLegales)
            <a class="download" href="{{ asset($propiedad->pdfBasesLegales) }}" download="BasesLegalesMarinaGolf">Descargar bases legales</a>
        @endif
--}}
    </div>
    <br>
    @if ($propiedad->urlMattlePort)
        
        <div class="cont-matterport">
            <h2>Visita virtual de la propiedad</h2>
            @if ($propiedad->urlMattlePort)
                <iframe  src="{{ $propiedad->urlMattlePort }}" frameborder='0' allowfullscreen allow='xr-spatial-tracking'></iframe>
            @endif
        </div>
    @endif

    <br>
    @if (count($premios)>0)
        
        <div class="cont-premios-detail">
            <h2>El premio mayor tambi??n incluye</h2>
            <div class="cont-premios">
                <div class="contListaPremios">
                    @php
                        $primerValorPremios = $premios->shift();
                    @endphp
                    <img src="{{ asset($primerValorPremios->imagenPremio) }}" alt="">
                    <ul>
                        {{--  
                        <p><i class="fas fa-award"></i> {{ $primerValorPremios->nombreTipoPremio }}</p>--}}
                        {!! $primerValorPremios->descripcion !!}
                    </ul>
                    
                </div>
                {{--  
                @foreach ($premios as $premio)

                <div class="contListaPremios">
                    <img src="{{ asset($premio->imagenPremio) }}" alt="">

                    <ul>
                        <p><i class="fas fa-money-bill-alt"></i> {{ $premio->nombreTipoPremio }}</p>
                        {!! $premio->descripcion !!}
                    </ul>

                </div>
                @endforeach
--}}
            </div>

            <br>
        </div>
    @endif

    @if ($propiedad->urlGoogleMaps != null)
        <div style="display: none">
            <select name="idPais" id="paises" onchange="sacarRegionPorPais(this.value)" required class="form-control">
                <option value="">Seleccione un pa??s</option>
                @foreach ($paises as $pais)
                    @if ($pais->idPais == $propiedad->idPais)
                        <option value="{{ $pais->idPais }}" selected>{{ $pais->nombrePais }}</option>
                    @else
                        <option value="{{ $pais->idPais }}">{{ $pais->nombrePais }}</option>
                    @endif
                @endforeach
            </select>

            <select name="idRegion" id="select_regiones" class="form-control" required onchange="sacarProvinciaPorRegion(this.value)">
                <option value="">Seleccione una region</option>
                @foreach ($regiones as $region)
                    @if ($region->idRegion == $propiedad->idRegion)
                        <option value="{{ $region->idRegion }}" selected>{{ $region->nombreRegion }}</option>
                    @else
                        <option value="{{ $region->idRegion }}">{{ $region->nombreRegion }}</option>
                    @endif
                @endforeach
            </select>
            <select name="idProvincia" id="select_provincias" class="form-control" required onchange="sacarComunaPorProvincia(this.value)">
                <option value="">Seleccione provincia</option>
                @foreach ($provincias as $provincia)
                    @if ($provincia->idProvincia == $propiedad->idProvincia)
                        <option value="{{ $provincia->idProvincia }}" selected>{{ $provincia->nombreProvincia }}</option>
                    @else
                        <option value="{{ $provincia->idProvincia }}">{{ $provincia->nombreProvincia }}</option>
                    @endif
                @endforeach
            </select>

            <select name="idComuna" id="select_comunas" class="form-control" required >
                <option value="">Seleccione comuna</option>
                @foreach ($comunas as $comuna)
                    @if ($comuna->idComuna == $propiedad->idComuna)
                        <option value="{{ $comuna->idComuna }}" selected>{{ $comuna->nombreComuna }}</option>
                    @else
                        <option value="{{ $comuna->idComuna }}">{{ $comuna->nombreComuna }}</option>
                    @endif
                @endforeach
            </select>
            <input type="text" name="direccionPropiedad" class="form-control" placeholder="Ingrese la direcci??n" required id="txtDireccion" value="{{ $propiedad->direccionPropiedad }}">
            <input type="text" name="numeracionPropiedad" class="form-control" placeholder="Ingrese numeraci??n de su casa" required id="txtNumero" value="{{ $propiedad->numeracionPropiedad }}">
            <input type="text" name="latitud" class="form-control" required id="latitud" value="{{ $propiedad->latitud }}"> 
            <input type="text" name="longitud" id="longitud" class="form-control" required value="{{ $propiedad->longitud }}">
        </div>




        <div class="ubicacion">
            <br>
            <h2><strong>Ubicaci??n</strong></h2> 
            <h3 class="sub-direccion">{{ $propiedad->nombreComuna }},{{ $propiedad->nombreRegion }}</h3> <br>
            <div class="cont-mapa">
                <div id="map" style="width: 100%; height: 300px"></div>
            </div>
            <br>
        </div>
    @endif

</main>
<br>

@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9BKzI4HVxT1mjnxQIHx_8va7FBvROI6g&callback=initMap" async defer></script>
<script>
    $(document).ready(function(){
  var direccion = $("#txtDireccion").val();
  if(direccion != "")
  {
    var direccion = $("#txtDireccion").val();
    var numero = $("#txtNumero").val();
    var pais = $("#paises option:selected").html();
    var region = $("#select_regiones option:selected").html();
    var provincia = $("#select_provincias option:selected").html();
    var comuna = $("#select_comunas option:selected").html();
    var direccionEnviar = "" + direccion + " " + numero + " " + comuna + " " + provincia + " " + region + " " + pais + " ";
    if(direccion != ""){
        $.ajax({
          url: '/curls/' + direccionEnviar,
          method:'GET',
          dataType: 'json',
          success: function (respuesta) {
              //document.getElementById("latitud").value = respuesta['results']['0']['geometry']['location']['lat'];
              //document.getElementById("longitud").value = respuesta['results']['0']['geometry']['location']['lng'];
              var myLatlng = new google.maps.LatLng(respuesta['results']['0']['geometry']['location']['lat'], respuesta['results']['0']['geometry']['location']['lng']); 
              var map = new google.maps.Map(document.getElementById('map'), {
                      center: myLatlng,
                      zoom: 17
                  });
              var marker = new google.maps.Marker({
                title: "Hello Paulo",
                position: myLatlng
              });
              marker.setMap(map);
          },
          error: function(err) {
              console.log(err);
          }
      });
    }
  }
});

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: -33.4372, lng: -70.650633},
  zoom: 17,
});
}
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{--  <script src="{{ asset('js/scroll-btn.js') }}"></script>--}}
<script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('js/lightbox.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-number.js') }}"></script>
<script>
$( document ).ready(function() {
    if(screen.width >=1025 ){
        document.getElementById('contenido-cambio').style.color = "black";
        document.getElementById('contenido-cambio-1').style.color = "black";
        document.getElementById('contenido-cambio-2').style.color = "black";
        document.getElementById('contenido-cambio-3').style.color = "black";
        document.getElementById('contenido-cambio-4').style.color = "black";
        document.getElementById('contenido-cambio-5').style.color = "black";
    }
    if(screen.width < 1025){
        document.getElementById('colorNegro').style = 'filter: invert(0%);';
    }
    
});
</script>
<script>
    var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>


<script>
    $(function(){
        $('input[type="number"]').niceNumber({
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
    function agregarPropiedadCarrito(e){
        e.preventDefault();
        var cantidad = document.getElementById('numero').value;
        var idPropiedad = {{ $propiedad->idPropiedad }};
        $.get('{{ asset('carrito-de-compra-agregar-ticket') }}/'+cantidad+'/'+idPropiedad,function(data, status){
            if(data.estadoJson == true){
                var total = {{ $propiedad->valorRifa }};
                total = total.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                total = total.split('').reverse().join('').replace(/^[\.]/,'');
                document.getElementById('totalBoletos').innerHTML = 'TOTAL: $'+total+'.-';
                document.getElementById('numero').value = 1;
                if(document.getElementById('notificacion-span').style.display === 'block'){
                    document.getElementById('notificacion-span').innerHTML = data.cantidadCarrito;

                }else{
                    document.getElementById('notificacion-span').style.display = 'block';
                    document.getElementById('notificacion-span').innerHTML = data.cantidadCarrito;
                }
                
                $('body, html').animate({
                    scrollTop: '0px'
                }, 300);

                swal({
                    title: "??Agregado Correctamente!",
                    text: "El ticket ha sido agregado correctamente",
                    icon: "success",
                    button: "OK",
                });
            }else if(data.estadoJson == false){
                swal({
                    title: "??Oops! ha surgido un imprevisto",
                    text: "No se pueden agregar mas de 15 tickets",
                    icon: "error",
                    button: ":c",
                });
            }else{
                swal({
                    title: "??Oops! ha surgido un imprevisto",
                    text: "Esta propiedad no posee tickets asociados",
                    icon: "error",
                    button: ":c",
                });
            }
        });
    }
</script>
<script>
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml2');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({loop: false})
    .add({
      targets: '.ml2 .letter',
      scale: [4,1],
      opacity: [0,1],
      translateZ: 0,
      easing: "easeOutExpo",
      duration: 950,
      delay: (el, i) => 70*i
    });
    $(document).ready(function() {
        // Inicializando WOW
        new WOW().init();
    });
  </script> 
@endsection