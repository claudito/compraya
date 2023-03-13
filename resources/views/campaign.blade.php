@extends('layouts.app')

@section('content')
            <h1 class="mt-4">Marketing</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Marketing</a></li>
                <li class="breadcrumb-item active">Campañas</li>
            </ol>

            <button class="btn btn-primary btn-sm btn-sincronizar"><i class="fa fa-refresh"></i> Sincronizar</button>

            <button class="btn btn-success btn-sm btn-reporte"><i class="fa fa-pie-chart"></i> Generar Reporte Estadístico</button>

            <hr>
            <div class="table-responsive">
                <table id="consulta" class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Campaña</th>
                            <th>Precio</th>
                            <th>Moneda</th>
                            <th>Nro de Ventas</th>
                            <th>Fecha de Inicio Campaña</th>
                            <th>Fecha de Fin Campaña</th>
                        </tr>
                    </thead>
                </table>
            </div>
@endsection
@section('scripts')
    <script>
        var result = @json($result);
        console.log(result);
        $('#consulta').DataTable({
            language:{
             url:"{{  asset('js/spanish.json') }}"
            },
            order:[[0,'asc']],
            destroy:true,
            bAutoWidth: false,
            deferRender:true,
            iDisplayLength: 25,
            bProcessing: true,
            data:result,
            columns:[
                {data:'id'},
                {data:'id'},
                {data:'codigo'},
                {data:'descripcion'},
                {data:'campaign'},
                {data:'precio'},
                {data:'moneda'},
                {data:'cantidad'},
                {data:'ini'},
                {data:'fin'}
            ],
            columnDefs:[
                {
                    targets:0,
                    checkboxes:{
                        seletRow:true
                    }
                }
            ]
        });

        $(document).on('click','.btn-sincronizar',function(e){

                Swal.fire({
                  title: 'Sincronizar',
                  text: "Está opción cargará la información de Productos y Campañas",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Confirmar',
                  cancelButtonText:'Cancelar',
                }).then((result) => {
                  if (result.isConfirmed) {
                    Swal.fire({
                        title:'Buen Trabajo',
                        text :'Información Sincronizada.',
                        icon :'success',
                        showConfirmButton:false
                    });
                  }
                })

            e.preventDefault();
        });

        $(document).on('click','.btn-reporte',function(e){

            var table= $('#consulta').DataTable();
            var rows = table.column(0).checkboxes.selected();
            var data = [];
            $.each(rows,function(index,rowId){
                data.push(rowId);
            });

            if( data == 0){
                Swal.fire({
                    title:'Lista Vacía',
                    text :'No ha seleccionado ningún elemento',
                    icon :'warning',
                    showConfirmButton:false
                });
                return false;
            }

            Swal.fire({
              title: 'Generar Reporte',
              text: "Está opción generará el Reporte Estadístico de acuerdo a las promociones de productos y Compras Realizadas",
              imageUrl:'https://cdn.icon-icons.com/icons2/883/PNG/512/6_icon-icons.com_68891.png',
              imageWidth: 200,
              //imageHeight: 200,
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Generar',
              cancelButtonText:'Cancelar',
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire({
                    title:'Buen Trabajo',
                    text :'Información Generada.',
                    icon :'success',
                    showConfirmButton:false,
                    footer:'El reporte de analísis Estadístico de Compra fue envíado a los correos:\n marketing@compraya.com, sistemas@compraya.com'
                });
              }
            })

            e.preventDefault();
        });


    </script>
@endsection
