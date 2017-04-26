<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/',[
   'uses' => 'loginController@index',
    'as' => 'inicio'
 ]);

// Authentication routes...
Route::get('auth/login',
    [
        'uses' => 'loginController@index',
        'as' => 'login'
    ]);

//Rutas para login
Route::post('auth/login', 'Auth\AuthController@autenticar');


Route::group(['prefix' => '/'], function (){

    Route::post('usuario/guardar',[
        'uses' => 'loginController@store',
        'as' => 'user-save'
    ]);

    Route::get('auth/logout', [
        'middelware' => 'auth',
        'uses' => 'Auth\AuthController@salir',
        'as' => 'salir'
    ]);

//Rutas para registro
    Route::get('auth/registro',[
       // 'middleware' => 'auth',
        'uses' => 'Auth\AuthController@registroIndex',
        'as' => 'registro'
    ]);
    Route::post('auth/registrar',[
        'uses' => 'Auth\AuthController@registrar',
        'as' => 'registrar'
    ]);

//Rutas para panel administrativo
    Route::get('admin/panel/index',
        [
            'uses' => 'PanelController@index',
            'as' => 'panel'
        ]
    );

    Route::get('admin/panel/ayudas_naturales',
        [
            function (){
                return view('ayudas.natural');
            }
            ,
            'as' => 'ayudas-naturales'
        ]
    );

    Route::post('cne/buscar',[
            'uses' => 'CneController@buscar_cne',
            'as' => 'cne-buscar'
        ]
    );

});


//busqueda en sisdata
Route::post('sisdata/buscar',[
        'uses' => 'solicitanteinscrito@buscar_solicitante',
        'as' => 'sisdata-buscar'
    ]
);
Route::group(['prefix'=>'admin/panel','middleware'=>'auth'], function (){

    //Ayudas persona natural inscritos y no inscritos
    Route::post('guardar-ayuda',[
            'uses' => 'SolicitanteInscrito@guardar_ayuda',
            'as' => 'guardar-ayuda'
        ]
    );

    Route::post('guardar-ayuda-nocne',[
            'uses' => 'SolicitanteNoInscrito@guardar_ayuda',
            'as' => 'guardar-ayuda-nocne'
        ]
    );


//Ayudas instituciones
    Route::get('ayudas_instituciones',
        [
            'uses' => 'SolicitanteInstitucion@index'
            ,
            'as' => 'ayudas-instituciones'
        ]
    );
    Route::post('guardar-ayuda-inst',[
            'uses' => 'SolicitanteInstitucion@guardar_ayuda',
            'as' => 'guardar-ayuda-inst'
        ]
    );
//Fin Ayudas instituciones

//clave de desbloqueo de campos
    Route::get('crear-clave-desbloqueo',[
            'uses' => 'ClavesDesbloqueo@nueva_clave',
            'as' => 'nueva-clave-desb'
        ]
    );
    Route::post('desbloq',[
            'uses' => 'ClavesDesbloqueo@obtener_clave',
            'as' => 'desbloq-campos'
        ]
    );
    Route::post('guardar_clave',[
            'uses' => 'ClavesDesbloqueo@guardar_clave',
            'as' => 'guardar-clave'
        ]
    );
//Fin clave de desbloqueo de campos

//tipos de solicitudes
Route::group(['prefix' => 'solicitudes'],function (){

    Route::get('listar',[
            'uses' => 'TiposSolicitud@index',
            'as' => 'listar-solicitudes'
        ]
    );

    Route::get('listar',[
            'uses' => 'TiposSolicitud@index',
            'as' => 'listar-solicitudes'
        ]
    );

    Route::get('nueva',[
            'uses' => 'TiposSolicitud@nueva',
            'as' => 'nueva-solicitudes'
        ]
    );

    Route::post('guardar',[
            'uses' => 'TiposSolicitud@guardar',
            'as' => 'guardar-solicitudes'
        ]
    );

    Route::get('editar/{id}',[
            'uses' => 'TiposSolicitud@editar',
            'as' => 'editar-solicitudes'
        ]
    );

    Route::post('editado',[
            'uses' => 'TiposSolicitud@editado',
            'as' => 'editado-solicitudes'
        ]
    );

    Route::get('eliminar/{id}',[
            'uses' => 'TiposSolicitud@eliminar',
            'as' => 'eliminar-solicitudes'
        ]
    );
});

//Fin tipos de solicitudes

//Listado de Solicitantes registrados
    Route::get('solicitantes/listar',[
            'uses' => 'ListarSolicitantes@index',
            'as' => 'listar-solicitantes'
        ]
    );


    Route::post('solicitantes/filtros',[
            'uses' => 'ListarSolicitantes@filtro',
            'as' => 'listar-filtros'
        ]
    );

    Route::post('solicitantes/buscarTodos',[
            'uses' => 'ListarSolicitantes@buscarTodos',
            'as' => 'solicitantes-todos'
        ]
    );

    Route::post('solicitantes/buscarPorCedula',[
            'uses' => 'ListarSolicitantes@buscarPorCedula',
            'as' => 'solicitantes-cedula'
        ]
    );
    Route::post('solicitantes/buscarPorParroquia',[
            'uses' => 'ListarSolicitantes@buscarPorParroquia',
            'as' => 'solicitantes-parroquia'
        ]
    );

    Route::post('solicitantes/buscarPorMunicipio',[
            'uses' => 'ListarSolicitantes@buscarPorMunicipio',
            'as' => 'solicitantes-municipio'
        ]
    );

    Route::post('solicitantes/buscarPorTipoSolicitud',[
            'uses' => 'ListarSolicitantes@buscarPorTipoSolicitud',
            'as' => 'solicitantes-solicitud'
        ]
    );

    Route::post('solicitantes/buscarPorCentro',[
            'uses' => 'ListarSolicitantes@buscarPorCentro',
            'as' => 'solicitantes-centro'
        ]
    );
//Fin Listado de Solicitantes registrados

//Detalle de solicitante
    Route::get('solicitantes/{id}',[
            'uses' => 'SolicitanteInscrito@solicitanteDetalle',
            'as' => 'solicitantes-detalle'
        ]
    );

    Route::get('solicitantesNoCne/{id}',[
            'uses' => 'SolicitanteNoInscrito@solicitanteDetalle',
            'as' => 'solicitantesNoCne-detalle'
        ]
    );

    Route::get('solicitantesInst/{id}',[
            'uses' => 'SolicitanteInstitucion@solicitanteDetalle',
            'as' => 'solicitantesInst-detalle'
        ]
    );

//ayudas
    Route::get('ayuda/{id}',[
            'uses' => 'Ayudas@verAyuda',
            'as' => 'ver-ayuda'
        ]
    );
    Route::get('ayudaNoCne/{id}',[
            'uses' => 'Ayudas@verAyudaNoCne',
            'as' => 'ver-ayuda-nocne'
        ]
    );
    Route::get('ayudaInst/{id}',[
            'uses' => 'Ayudas@verAyudaInst',
            'as' => 'ver-ayuda-inst'
        ]
    );
    Route::get('ayuda/editar/{id}/{tipo?}', [
            'uses' => 'Ayudas@editar',
            'as' => ('editar-ayuda')
        ]
    );
    Route::post('ayuda/editado',[
            'uses' => 'Ayudas@editado',
            'as' => 'editado-ayuda'
        ]
    );

    Route::get('ayuda/eliminar/{id}',[
            'uses' => 'Ayudas@eliminarAyuda',
            'as' => 'eliminar-ayuda'
        ]
    );

    Route::post('solicitantes/ayudaNumero',[
            'uses' => 'Ayudas@buscarAyuda',
            'as' => 'buscarAyuda-numero'
        ]
    );
    Route::post('solicitantes/buscarTodasAyudas',[
            'uses' => 'Ayudas@todasAyudas',
            'as' => 'buscarAyuda-todas'
        ]
    );
    Route::post('solicitantes/porTipoSolicitud',[
            'uses' => 'Ayudas@buscarPorTipoSolicitud',
            'as' => 'buscarAyuda-tipoSolicitud'
        ]
    );

    //eventos
    Route::group(['prefix' => 'eventos'],function (){

        Route::get('listar',[
                'uses' => 'Eventos@index',
                'as' => 'listar-eventos'
            ]
        );

        Route::get('nuevo',[
                'uses' => 'Eventos@nuevo',
                'as' => 'nuevo-eventos'
            ]
        );

        Route::post('guardar',[
                'uses' => 'Eventos@guardar',
                'as' => 'guardar-eventos'
            ]
        );

        Route::get('editar/{id}',[
                'uses' => 'Eventos@editar',
                'as' => 'editar-eventos'
            ]
        );

        Route::post('editado',[
                'uses' => 'Eventos@editado',
                'as' => 'editado-eventos'
            ]
        );

        Route::get('eliminar/{id}',[
                'uses' => 'Eventos@eliminar',
                'as' => 'eliminar-eventos'
            ]
        );
    });
});




