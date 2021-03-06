@extends('layouts.public.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.nice-number.css') }}">
@endsection
@section('imagen-inicio')
<a href="{{ asset('/') }}"><img src="{{ asset('images/logo rifopoly_Mesa de trabajo 1.png') }}" alt=""></a>
@endsection
@section('content')
<main class="cont-body int-mobile">
  <h1 class="ml2">Cada vez más cerca de ganar</h1>
  <br>
  
  <div class="cont-infoCarrito">
    <div class="resumenPropiedades">
      @if (Session::has('carritoCompra'))
        @foreach (Session::get('carritoCompra') as $key => $propiedadTicket)
          <div class="desglose">
            <div class="img-thumnail">
              @if ($propiedadTicket['imagenPropiedad'])
                <img src="{{ asset($propiedadTicket['imagenPropiedad']) }}" alt="">
              @else
              @endif
            </div>
            <div class="cont-resumen-compra">
              <div class="resumen-compra">
                <h5>{{ $propiedadTicket['nombrePropiedad'] }}</h5>
                {{-- <p>Departamentodelujo</p> --}}
              </div>
              <div class="resumen-compra">
                <h5>Precio Ticket</h5>
                <p>${{ number_format($propiedadTicket['valorRifa'],0,',','.') }}.-</p>
              </div>
              <div class="resumen-compra1">
                <form action="">
                  <label for="numero" class="tamanoLetra"></label> <br> <br>
                  <input type="number" id="{{ $propiedadTicket['idPropiedad'] }}" class="" placeholder="" value="{{ $propiedadTicket['cantidad'] }}" min="1">
                </form>
              </div>
              <div class="resumen-compra2">
                <a class="btnTrash" href="{{ asset('eliminar-ticket-carrito') }}/{{ $propiedadTicket['idPropiedad'] }}" ><i class="fas fa-trash-alt"></i></a>
              </div>
            </div>
          </div>
          <br>
<br>
        @endforeach
      @else
          <div class="desglose">
            <h1>No hay tickets comprados</h1>
          </div>
<br>
<br>
<br>
<br>

      @endif 
        
        
      <br>
    </div>
  
    <div class="total">
      @if (Session::has('total'))
        <form action="{{ asset('paso-final-compra-ticket') }}" method="get">
          <h5>Resumen de la compra</h5>
          <p id="totalFInal">TOTAL: ${{ number_format(Session::get('total'),0,',','.') }}.-</p>
          {{-- 
          <button class="btnCompraCarrito" type="submit">Continuar compra</button> --}}
        </form>
      @else
        <h5>Resumen de la compra</h5>
        <p>TOTAL: $00.000.-</p>
      @endif
      
    </div>
  
  </div>
  <br> <br>
  
    <br> <br>
  
  
  
  <br>
  
  
  
  
</main>
@endsection
@section('scripts')
<script>
  $( document ).ready(function() {
      /*
        document.getElementById('contenido-cambio').classList.remove('cont-nav');
        document.getElementById('contenido-cambio').classList.add('cont-nav-int');*/
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

<script src="js/jquery.nice-number.js"></script>
<script>
  $(function(){
    
    $('input[type="number"]').niceNumber({
        onIncrement: function ($currentInput, amount, settings) {
          $.get("{{ asset('obetener-valor-tickets') }}/"+$currentInput[0]['id']+"/"+amount,function(data, status){
            var total = data['nuevoValor'];
            total = total.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            total = total.split('').reverse().join('').replace(/^[\.]/,'');
            document.getElementById('totalFInal').innerHTML = 'TOTAL: $'+total+'.-';;
          });
        },
        onDecrement: function ($currentInput, amount, settings) {
          $.get("{{ asset('restar-valor-tickets') }}/"+$currentInput[0]['id']+"/"+amount,function(data, status){
            var total = data['nuevoValor'];
            total = total.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            total = total.split('').reverse().join('').replace(/^[\.]/,'');
            document.getElementById('totalFInal').innerHTML = 'TOTAL: $'+total+'.-';;
          });
        },
    });
    
  });
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