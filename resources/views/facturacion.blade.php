@extends('layouts.app')

@section('content')
            <h1 class="mt-4">Ventas</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Ventas</a></li>
                <li class="breadcrumb-item active">Facturación</li>
            </ol>

            <div class="alert alert-success" role="alert">
             <i class="fa fa-clock" aria-hidden="true"></i> Los envíos Automáticos a Sunat se realizan cada 5 minutos. Última Actualización: <strong>{{ $actualizacion }}</strong>
            </div>

            <button class="btn btn-info btn-sm btn-sincronizar"><i class="fa fa-refresh"></i> Sincronizar Ventas</button>
            <button class="btn btn-primary btn-sm btn-envio"><i class="fa fa-paper-plane"></i> Envío Manual</button>
            <hr>
            <div class="table-responsive">
                <table id="consulta" class="table">
                    <thead>
                        <tr>
                            <th></th>
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
            order:[[3,'asc']],
            destroy:true,
            bAutoWidth: false,
            deferRender:true,
            iDisplayLength: 25,
            bProcessing: true,
            data:result,
            columns:[
                {data:'id'},
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
            ],
            columnDefs:[
                {
                    targets:0,
                    checkboxes:{
                        seletRow:true
                    }
                }
            ],
            initComplete: function(settings){
                var api = this.api();
                 api.cells(
                    api.rows(function(idx, data, node){
                       return (data.estado == 1 ) ? false : true;
                    }).indexes(),
                    0
                 ).checkboxes.disable();
            }

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

        $(document).on('click','.btn-envio',function(e){

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
                  title: 'Envío Manual',
                  text: "Está opción enviara los documentos en Estado Pendiente a Sunat.",
                  icon :'info',
                  //imageHeight: 200,
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Enviar',
                  cancelButtonText:'Cancelar',
                }).then((result) => {
                  if (result.isConfirmed) {
                    Swal.fire(
                      'Buen Trabajo',
                      'Documentos Enviados',
                      'success'
                    )
                  }
                })

            e.preventDefault();
        });


    </script>
@endsection
