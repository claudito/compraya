@extends('layouts.app')

@section('content')
            <h1 class="mt-4">Ventas</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Ventas</a></li>
                <li class="breadcrumb-item active">Facturación</li>
            </ol>

            <button class="btn btn-primary btn-sm btn-sincronizar"><i class="fa fa-refresh"></i> Sincronizar Ventas</button>


            <hr>
            <div class="table-responsive">
                <table id="consulta" class="table">
                    <thead>
                        <tr>

                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Serie</th>
                            <th>Número</th>
                            <th>Ruc/Dni</th>
                            <th>Razón Social/Nombre</th>
                            <th>Moneda</th>
                            <th>Monto</th>
                            <th>Pagado</th>
                            <th>Enviado al Cliente?</th>
                            <th>Leído por el Cliente?</th>
                            <th>Pdf</th>
                            <th>Xml</th>
                            <th>Estado</th>
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
                {data:'fecha'},
                {data:'tipo'},
                {data:'serie'},
                {data:'numero'},
                {data:'ruc'},
                {data:'razon_social'},
                {data:'moneda'},
                {data:'monto'},
                {data:null,render:function(data){
                    if( data.pagado == 1){
                        return `<i class="fa fa-check fa-2x text-success"></i>`;
                    }else{
                        return `<i class="fa fa-remove"></i>`;
                    }
                },'className':'text-center'},
                {data:null,render:function(data){
                    if( data.enviado == 1){
                        return `<i class="fa fa-check fa-2x text-success"></i>`;
                    }else{
                        return `<i class="fa fa-remove fa-2x"></i>`;
                    }
                },'className':'text-center'},
                {data:null,render:function(data){
                    if( data.leido == 1){
                        return `<i class="fa fa-check fa-2x text-success"></i>`;
                    }else{
                        return `<i class="fa fa-remove fa-2x"></i>`;
                    }
                },'className':'text-center'},
                {data:null,render:function(data){
                    if( data.pdf == '' ){
                        return ``;
                    }else{
                        return `<a href="${data.pdf}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>`;
                    }
                },'className':'text-center'},
                {data:null,render:function(data){
                    if( data.xml == '' ){
                        return ``;
                    }else{
                         return `<a href="${data.xml}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>`;
                    }
                },'className':'text-center'},
                {data:null,render:function(data){
                    if( data.estado == 1){
                        return `<span class="btn btn-sm btn-warning">Pendiente</span>`;
                    }else if( data.estado == 2){
                        return `<span class="btn btn-sm btn-success">Enviado</span>`;
                    }else{
                        return ``;
                    }
                },'className':'text-center'}
            ]
        });

        $(document).on('click','.btn-sincronizar',function(e){

                Swal.fire({
                  title: 'Sincronizar Ventas',
                  text: "Está opción sincronizará las ventas realizadas",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Sincronizar',
                  cancelButtonText:'Cancelar',
                }).then((result) => {
                  if (result.isConfirmed) {
                    Swal.fire(
                      'Buen Trabajo',
                      'Información Sincronizada',
                      'success'
                    )
                  }
                })

            e.preventDefault();
        });

        $(document).on('click','.btn-reporte',function(e){

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
                    Swal.fire(
                      'Buen Trabajo',
                      'Información Generada.',
                      'success'
                    )
                  }
                })

            e.preventDefault();
        });


    </script>
@endsection
