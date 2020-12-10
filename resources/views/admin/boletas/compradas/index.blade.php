
@extends('layouts.admin.app')
@section('title')
Rifo Mi Propiedad - Administrador
@endsection
@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-lg-12" align="center">
                <h3>Boletas Compradas</h3> 
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="datos" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                              <thead>
                                <tr>
                                  <th>Folio Boleta</th>
                                  <th>Total</th>
                                  <th>Nombre Comprador</th>
                                  <th>Rut</th>
                                  <th>Correo</th>
                                  <th>Teléfono</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#datos').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                "url": "{{ asset('datatable-boletas-compradas') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
                "columns": [
                    { "data": "idBoleta" },
                    { "data": "totalBoleta" },
                    { "data": "nombreUsuario" },
                    { "data": "rutUsuario" },
                    { "data": "correoUsuario" },
                    { "data": "telefonoUsuario" },
                    { "data": "options" }
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "No existen registros",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            });
        });
    </script>
@endsection