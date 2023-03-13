<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('home',function(){
    return view('home');
})->name('home');


Route::get('campaign',function(){

    $result = [ 
        [
            'id'=>1,
            'codigo'=>'00001',
            'descripcion'=>'Cuadernos Loro',
            'campaign'=>'Campaña Escolar de Verano',
            'precio'=>'5.00',
            'moneda'=>'Sol',
            'cantidad'=>2000,
            'ini'=>'01/01/2023',
            'fin'=>'31/03/2023'
        ],
        [
            'id'=>2,
            'codigo'=>'00002',
            'descripcion'=>'Juego de Lapiceros(Rojo,Azul y Negro)',
            'campaign'=>'Campaña Escolar de Verano',
            'precio'=>'10.00',
            'moneda'=>'Sol',
            'cantidad'=>1560,
            'ini'=>'01/01/2023',
            'fin'=>'31/03/2023'
        ],
        [
            'id'=>3,
            'codigo'=>'00003',
            'descripcion'=>'Folder A4 Color Verde',
            'campaign'=>'Campaña Escolar de Verano',
            'precio'=>'7.00',
            'moneda'=>'Sol',
            'cantidad'=>2000,
            'ini'=>'01/01/2023',
            'fin'=>'31/03/2023'
        ],
        [
            'id'=>4,
            'codigo'=>'00004',
            'descripcion'=>'Regla de 30 Cm',
            'campaign'=>'Campaña Escolar de Verano',
            'precio'=>'4.00',
            'moneda'=>'Sol',
            'cantidad'=>679,
            'ini'=>'01/01/2023',
            'fin'=>'31/03/2023'
        ]

    ];

    return view('campaign',compact('result'));
})->name('campaign');


Route::get('facturacion',function(){

    $result = [ 
        [
            'fecha'=>'02/03/2023',
            'tipo'=>'Factura',
            'serie'=>'FFF1',
            'numero'=>'14',
            'ruc'=>'20338054115',
            'razon_social'=>'AUSTRAL GROUP S.A.A.',
            'moneda'=>'Sol',
            'monto'=>'1200.00',
            'pagado'=>1,
            'enviado'=>0,
            'leido'=>0,
            'pdf'=>'https://www.nubefact.com/see_invoice/c41cfe6a-6157-43cb-8fce-b3f018012949.pdf',
            'xml'=>'https://www.nubefact.com/see_invoice/b1d2aefe-658f-422d-9f18-951b8202945c.xml',
            'estado'=>2
        ],
        [
            'fecha'=>'06/03/2023',
            'tipo'=>'Boleta',
            'serie'=>'BBB1',
            'numero'=>'2',
            'ruc'=>'46794282',
            'razon_social'=>'Luis Augusto Claudio Ponce',
            'moneda'=>'Sol',
            'monto'=>'300.00',
            'pagado'=>1,
            'enviado'=>1,
            'leido'=>1,
            'pdf'=>'https://www.nubefact.com/see_invoice/c41cfe6a-6157-43cb-8fce-b3f018012949.pdf',
            'xml'=>'https://www.nubefact.com/see_invoice/b1d2aefe-658f-422d-9f18-951b8202945c.xml',
            'estado'=>2
        ],
        [
            'fecha'=>'04/03/2023',
            'tipo'=>'Factura',
            'serie'=>'FFF1',
            'numero'=>'16',
            'ruc'=>'20338054115',
            'razon_social'=>'AUSTRAL GROUP S.A.A.',
            'moneda'=>'Sol',
            'monto'=>'1500.00',
            'pagado'=>1,
            'enviado'=>0,
            'leido'=>0,
            'pdf'=>'',
            'xml'=>'',
            'estado'=>1
        ],
        [
            'fecha'=>'12/03/2023',
            'tipo'=>'Boleta',
            'serie'=>'BBB1',
            'numero'=>'6',
            'ruc'=>'49674578',
            'razon_social'=>'Maria Perez Tello Torres',
            'moneda'=>'Sol',
            'monto'=>'400.00',
            'pagado'=>1,
            'enviado'=>0,
            'leido'=>0,
            'pdf'=>'',
            'xml'=>'',
            'estado'=>1
        ]

    ];

    return view('facturacion',compact('result'));
})->name('facturacion');


Route::get('reservas',function(){

    $result = [ 
        [   
            'orden'=>'1806045',
            'fecha'=>'12/03/2023',
            'id'=>1,
            'item'=>1,
            'codigo'=>'00001',
            'descripcion'=>'Cuadernos Loro',
            'campaign'=>'Campaña Escolar de Verano',
            'precio'=>'5.00',
            'moneda'=>'Sol',
            'cantidad'=>10,
            'estado'=>2
        ],
        [   
            'orden'=>'1806045',
            'fecha'=>'12/03/2023',
            'id'=>2,
            'item'=>2,
            'codigo'=>'00002',
            'descripcion'=>'Juego de Lapiceros(Rojo,Azul y Negro)',
            'campaign'=>'Campaña Escolar de Verano',
            'precio'=>'10.00',
            'moneda'=>'Sol',
            'cantidad'=>20,
            'estado'=>1
        ],  
        [   
            'orden'=>'1806045',
            'fecha'=>'12/03/2023',
            'id'=>3,
            'item'=>3,
            'codigo'=>'00003',
            'descripcion'=>'Folder A4 Color Verde',
            'campaign'=>'Campaña Escolar de Verano',
            'precio'=>'7.00',
            'moneda'=>'Sol',
            'cantidad'=>18,
            'estado'=>2
        ],  
        [   
            'orden'=>'1805913',
            'fecha'=>'13/03/2023',
            'id'=>4,
            'item'=>1,
            'codigo'=>'00004',
            'descripcion'=>'Regla de 30 Cm',
            'campaign'=>'Campaña Escolar de Verano',
            'precio'=>'4.00',
            'moneda'=>'Sol',
            'cantidad'=>22,
            'estado'=>1
        ]
    ];

    return view('reservas',compact('result'));
})->name('reservas');