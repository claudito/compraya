@extends('layouts.app')

@section('content')
            <h1 class="mt-4">Almacén</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Almacén</a></li>
                <li class="breadcrumb-item active">Reservas</li>
            </ol>

            <button class="btn btn-info btn-sm btn-sincronizar"><i class="fa fa-refresh"></i> Sincronizar Ordenes de Compra</button>

            <button class="btn btn-primary btn-sm btn-reserva"><i class="fa fa-add"></i> Crear Reserva</button>
            <hr>
            <div class="table-responsive">
                <table id="consulta" class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Orden</th>
                            <th>Fecha de Ingreso</th>
                            <th>Item</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Moneda</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-reserva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="table-responsive">
                        <table id="consulta_reserva" class="table" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Item</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Moneda</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-submit">Reservar</button>
                  </div>
                </div>
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
                {data:'orden'},
                {data:'fecha'},
                {data:'item'},
                {data:'codigo'},
                {data:'descripcion'},
                {data:'precio'},
                {data:'moneda'},
                {data:'cantidad'},
                {data:null,render:function(data){
                    if( data.estado == 1){
                        return `<span class="btn btn-sm btn-block btn-info">Libre</span>`;
                    }else if( data.estado == 2){
                        return `<span class="btn btn-sm btn-block btn-success">Reservado</span>`;
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
                  title: 'Sincronizar Ordenes de Compra',
                  text: "Está opción sincronizará las ordenes de compra ingresadas",
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
                    );
                  }
                })

            e.preventDefault();
        });

        $(document).on('click','.btn-reserva',function(e){
            var table= $('#consulta').DataTable();
            var rows = table.column(0).checkboxes.selected();
            var data = [];
            $.each(rows,function(index,rowId){
                data.push(rowId);
            });

            if( data.length > 0 ){
                var items   =  table.rows().data().toArray();
                var element =  [];
                items.forEach(function(row){
                    if( data.includes(row.id) ){
                        element.push(row);
                    }
                });

                $('#consulta_reserva').DataTable({
                    language:{
                     url:"{{  asset('js/spanish.json') }}"
                    },
                    order:[[0,'asc']],
                    destroy:true,
                    bAutoWidth: false,
                    deferRender:true,
                    iDisplayLength: 25,
                    bProcessing: true,
                    paging:   false,
                    ordering: false,
                    info:     false,
                    searching:false,
                    data:element,
                    columns:[
                        {data:'orden'},
                        {data:'fecha'},
                        {data:'item'},
                        {data:'codigo'},
                        {data:'descripcion'},
                        {data:'precio'},
                        {data:'moneda'},
                        {data:'cantidad'}
                    ]
                });

                $('#modal-reserva').modal('show');
            }else{
                Swal.fire({
                    title:'Lista Vacía',
                    text :'No ha seleccionado ningún elemento',
                    icon :'warning',
                    showConfirmButton:false
                });
            }

            e.preventDefault();
        });

        $(document).on('click','.btn-submit',function(e){

                Swal.fire({
                  title: 'Reservar',
                  text: "Está opción reservará los elementos seleccionados",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Reservar',
                  cancelButtonText:'Cancelar',
                }).then((result) => {
                  if (result.isConfirmed) {
                    Swal.fire(
                      'Buen Trabajo',
                      'Productos Reservados',
                      'success'
                    );
                  }
                })

            e.preventDefault();
        });


    </script>
@endsection
