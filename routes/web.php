<?php

Auth::routes();
Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index'])->middleware('auth');
//Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index'])->middleware('auth');
Route::post('/convertir_moneda', ['as' => 'convertir_moneda', 'uses' => 'HomeController@currency'])->middleware('auth');

Route::get('/perfil', ['as' => 'perfil', 'uses' => 'UsersController@perfil'])->middleware('auth');
Route::post('/editarPerfil/', ['as' => 'perfil.update', 'uses' => 'UsersController@editarPerfil'])->middleware('auth');

Route::group(['middleware' => 'admin'], function () {
    //GENERAL
    Route::get('/general', ['as' => 'general.edit', 'uses' => 'GeneralController@edit']);
    Route::post('/general', ['as' => 'general.update', 'uses' => 'GeneralController@update']);

    //USUARIOS
    Route::get('/usuarios', ['as' => 'users.index', 'uses' => 'UsersController@index']);
    Route::get('/usuarios/{id}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
    Route::get('/usuarios/{id}/destroy', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);
    Route::put('/usuarios/{id}/update', ['as' => 'users.update', 'uses' => 'UsersController@update']);

    //PRODUCTOS
    Route::get('/productos', ['as' => 'productos.index', 'uses' => 'ProductController@index'])->middleware('auth');
    Route::get('/productos/create', ['as' => 'productos.create', 'uses' => 'ProductController@create'])->middleware('auth');
    Route::post('/productos/', ['as' => 'productos.store', 'uses' => 'ProductController@store'])->middleware('auth');
    Route::get('/productos/{id}/destroy', ['as' => 'productos.destroy', 'uses' => 'ProductController@destroy'])->middleware('auth');
    Route::get('/productos/{id}/edit', ['as' => 'productos.edit', 'uses' => 'ProductController@edit'])->middleware('auth');
    Route::post('/productos/{id}/update', ['as' => 'update', 'uses' => 'ProductController@update'])->middleware('auth');
    Route::get('/productos/{id}/changeStatus', ['as' => 'productos.changeStatus', 'uses' => 'ProductController@changeStatus'])->middleware('auth');
    Route::get('/productos/{id}/traslado', ['as' => 'productos.traslado', 'uses' => 'ProductController@traslado'])->middleware('auth');
    Route::post('/productos/{id}/trasladar', ['as' => 'productos.trasladar', 'uses' => 'ProductController@guardarTraslado'])->middleware('auth');

    //UNIDADES DE MEDIDA
    Route::get('/unidades_medida', ['as' => 'unidades.index', 'uses' => 'UnidadMedidaController@index'])->middleware('auth');
    Route::get('/unidades_medida/{id}/destroy', ['as' => 'unidades.destroy', 'uses' => 'UnidadMedidaController@destroy'])->middleware('auth');
    Route::put('/unidades_medida/{id}/update', ['as' => 'unidades.update', 'uses' => 'UnidadMedidaController@update'])->middleware('auth');
    Route::post('/unidades_medida/', 'UnidadMedidaController@store');

    //CATEGORIAS
    Route::get('/categorias', ['as' => 'categorias.index', 'uses' => 'CategoriaController@index'])->middleware('auth');
    Route::get('/categorias/{id}/destroy', ['as' => 'categorias.destroy', 'uses' => 'CategoriaController@destroy'])->middleware('auth');
    Route::put('/categorias/{id}/update', ['as' => 'update', 'uses' => 'CategoriaController@update'])->middleware('auth');
    Route::post('/categorias/', 'CategoriaController@store')->middleware('auth');

    //PROVEEDORES
    Route::get('/proveedores', ['as' => 'proveedores.index', 'uses' => 'ProveedorController@index'])->middleware('auth');
    Route::get('/proveedores/{id}/destroy', ['as' => 'proveedores.destroy', 'uses' => 'ProveedorController@destroy'])->middleware('auth');
    Route::get('/proveedores/{id}/edit', ['as' => 'proveedores.edit', 'uses' => 'ProveedorController@edit'])->middleware('auth');
    Route::post('/proveedores', ['as' => 'proveedor.create', 'uses' => 'ProveedorController@store'])->middleware('auth');
    Route::put('/proveedores/{id}/update', ['as' => 'proveedor.update', 'uses' => 'ProveedorController@update'])->middleware('auth');
    Route::post('/pedidos/proveedores', ['as' => 'ventas.proveedor.create', 'uses' => 'ProveedorController@store'])->middleware('auth');
    Route::post('/pedidos/getDataProveedor', ['as' => 'pedidos.proveedor.search', 'uses' => 'ProveedorController@getDataProveedor'])->middleware('auth');

     //PEDIDOS
    Route::get('/pedidos', ['as' => 'pedidos.index', 'uses' => 'PedidoController@index'])->middleware('auth');
    Route::get('/pedidos/create', ['as' => 'pedidos.create', 'uses' => 'PedidoController@create'])->middleware('auth');
    Route::get('/pedidos/{id}/', ['as' => 'pedidos.detalles', 'uses' => 'PedidoController@show'])->middleware('auth');
    Route::get('/pedidos/{id}/destroy', ['as' => 'pedidos.destroy', 'uses' => 'PedidoController@destroy'])->middleware('auth');
    Route::post('/pedidos/store', ['as' => 'pedidos.store', 'uses' => 'PedidoController@store'])->middleware('auth');
    Route::post('/pedidos/storeCreditPedido', ['as' => 'credito_pedido.store', 'uses' => 'PedidoCreditoController@store'])->middleware('auth');

    //productos pedidos
    Route::post('/pedidos/queryProducts/', ['uses' => 'TmpProductosPedidoController@queryProducts'])->middleware('auth');
    Route::post('/pedidos/addProduct', ['as' => 'pedidos.addProduct', 'uses' => 'TmpProductosPedidoController@addProduct'])->middleware('auth');
    Route::post('/pedidos/editProduct/', ['uses' => 'TmpProductosPedidoController@editProductTmp'])->middleware('auth');
    Route::post('/pedidos/removeAll', ['as' => 'pedidos.removeAll', 'uses' => 'TmpProductosPedidoController@removeAll'])->middleware('auth');
    Route::post('/pedidos/removeProduct', ['as' => 'pedidos.removeProduct', 'uses' => 'TmpProductosPedidoController@removeProduct'])->middleware('auth');

    //PEDIDOS A CREDITO
    Route::get('/pedidos_credito', ['as' => 'pedidos_credito.index', 'uses' => 'PedidoCreditoController@index'])->middleware('auth');
    Route::get('/pedidos_credito/{id}/destroy', ['as' => 'pedidos_credito.destroy', 'uses' => 'PedidoCreditoController@destroy'])->middleware('auth');
    Route::get('/pedidos_credito/{id}/', ['as' => 'pedidos_credito.detalles', 'uses' => 'PedidoCreditoController@show'])->middleware('auth');
    Route::get('/pedidos_credito/{id}/abonos/create', ['as' => 'pedidos_credito.abono', 'uses' => 'AbonoPedidoController@create'])->middleware('auth');
    Route::post('/pedidos_credito/{id}/abonos/store', ['as' => 'pedidos_credito.store', 'uses' => 'AbonoPedidoController@store'])->middleware('auth');

    Route::get('/pedidos/generar/{id}/{tipo}', ['as' => 'pedidos.generar', 'uses' => 'PedidoController@generarPedido'])->middleware('auth');
    Route::post('/pedidos/generar/{id}/realizar', ['as' => 'pedidos.realizar', 'uses' => 'PedidoController@realizarPedido'])->middleware('auth');

    Route::get('/pedidos/verPedido/{id}', ['as' => 'pedidos.view', 'uses' => 'PdfController@verPedido'])->middleware('auth');

    //REPORTES
    Route::get('/reportes/productos_mas_vendidos', ['as' => 'reportes.r1', 'uses' => 'ChartController@productos_mas_vendidos'])->middleware('auth');
    Route::get('/reportes/ventas_creditos', ['as' => 'reportes.r2', 'uses' => 'ChartController@ventas_creditos'])->middleware('auth');
    Route::get('/reportes/cajas', ['as' => 'reportes.r3', 'uses' => 'ChartController@cajas'])->middleware('auth');
    Route::get('/reportes/filtrarProductos', ['as' => 'reportes.4', 'uses' => 'ChartController@filtrar_productos'])->middleware('auth');

});

Route::group(['middleware' => 'vend'], function () {
});


Route::group(['middleware' => 'admvend'], function () {
    //CLIENTES
    Route::get('/clientes', ['as' => 'users.index', 'uses' => 'ClienteController@index'])->middleware('auth');
    Route::get('/clientes/{id}/destroy', ['as' => 'clientes.destroy', 'uses' => 'ClienteController@destroy'])->middleware('auth');
    Route::get('/clientes/{id}/edit', ['as' => 'clientes.edit', 'uses' => 'ClienteController@edit'])->middleware('auth');
    Route::put('/clientes/{id}/update', ['as' => 'clientes.update', 'uses' => 'ClienteController@update'])->middleware('auth');
    Route::post('/ventas/clientes', ['as' => 'ventas.cliente.create', 'uses' => 'ClienteController@store'])->middleware('auth');
    Route::post('/clientes', ['as' => 'cliente.create', 'uses' => 'ClienteController@store'])->middleware('auth');
    Route::post('/ventas/getDataClient', ['as' => 'ventas.cliente.search', 'uses' => 'ClienteController@getDataClient'])->middleware('auth');

    //CAJAS
    Route::get('/cajas', ['as' => 'cajas.index', 'uses' => 'CajaController@index'])->middleware('auth');
    Route::post('/cajas', ['as' => 'cajas.create', 'uses' => 'CajaController@store'])->middleware('auth');
    Route::post('/cajas/{id}/close', ['as' => 'cajas.close', 'uses' => 'CajaController@close'])->middleware('auth');

    //VENTAS
    Route::get('/ventas', ['as' => 'ventas.index', 'uses' => 'FacturaController@index'])->middleware('auth');
    Route::get('/ventas/create', ['as' => 'ventas.create', 'uses' => 'FacturaController@create'])->middleware('auth');
    Route::get('/ventas/{id}/', ['as' => 'factura.detalles', 'uses' => 'FacturaController@show'])->middleware('auth');
    Route::post('/ventas/store', ['as' => 'ventas.store', 'uses' => 'FacturaController@store'])->middleware('auth');
    Route::post('/ventas/storeCredit', ['as' => 'ventas.store', 'uses' => 'CreditoController@store'])->middleware('auth');
    Route::get('/ventas/{id}/destroy', ['as' => 'ventas.destroy', 'uses' => 'FacturaController@destroy'])->middleware('auth');
    Route::post('/ventas/addProduct', ['as' => 'ventas.addProduct', 'uses' => 'TempProductsController@addProduct'])->middleware('auth');
    Route::post('/ventas/removeAll', ['as' => 'ventas.removeAll', 'uses' => 'TempProductsController@removeAll'])->middleware('auth');
    Route::post('/ventas/removeProduct', ['as' => 'ventas.removeProduct', 'uses' => 'TempProductsController@removeProduct'])->middleware('auth');
    Route::post('/ventas/editProduct/', ['uses' => 'TempProductsController@editProductTmp'])->middleware('auth');
    Route::post('/ventas/queryProducts/', ['uses' => 'TempProductsController@queryProducts'])->middleware('auth');
    Route::get('/ventas/verFactura/{id}', ['as' => 'factura.view', 'uses' => 'PdfController@verFactura'])->middleware('auth');

    //CREDITOS VENTAS
    Route::get('/creditos', ['as' => 'creditos.index', 'uses' => 'CreditoController@index'])->middleware('auth');
    Route::get('/creditos/{id}/destroy', ['as' => 'creditos.destroy', 'uses' => 'CreditoController@destroy'])->middleware('auth');
    Route::get('/creditos/{id}/', ['as' => 'creditos.detalles', 'uses' => 'CreditoController@show'])->middleware('auth');
    Route::get('/creditos/{id}/abonos/create', ['as' => 'creditos.abono', 'uses' => 'AbonoController@create'])->middleware('auth');
    Route::post('/creditos/{id}/abonos/store', ['as' => 'abono.store', 'uses' => 'AbonoController@store'])->middleware('auth');
});


Route::get('/denied', ['as' => 'denied', function() {
    return view('403');
}]);





























//rutas
    /*
    //USUARIOS
    Route::get('/usuarios', ['as' => 'users.index', 'uses' => 'UsersController@index'])->middleware('auth');
    Route::get('/usuarios/{id}/destroy', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy'])->middleware('auth');

//CLIENTES
Route::get('/clientes', ['as' => 'users.index', 'uses' => 'ClienteController@index'])->middleware('auth');
Route::get('/clientes/{id}/destroy', ['as' => 'clientes.destroy', 'uses' => 'ClienteController@destroy'])->middleware('auth');

//PRODUCTOS
    Route::get('/productos', ['as' => 'productos.index', 'uses' => 'ProductController@index'])->middleware('auth');
    Route::get('/productos/create', ['as' => 'productos.create', 'uses' => 'ProductController@create'])->middleware('auth');
    Route::post('/productos/', ['as' => 'productos.store', 'uses' => 'ProductController@store'])->middleware('auth');
    Route::get('/productos/{id}/destroy', ['as' => 'productos.destroy', 'uses' => 'ProductController@destroy'])->middleware('auth');
    Route::get('/productos/{id}/edit', ['as' => 'productos.edit', 'uses' => 'ProductController@edit'])->middleware('auth');
    Route::post('/productos/{id}/update', ['as' => 'update', 'uses' => 'ProductController@update'])->middleware('auth');
    Route::get('/productos/{id}/changeStatus', ['as' => 'productos.changeStatus', 'uses' => 'ProductController@changeStatus'])->middleware('auth');

//UNIDADES DE MEDIDA
    Route::get('/unidades_medida', ['as' => 'unidades.index', 'uses' => 'UnidadMedidaController@index'])->middleware('auth');
    Route::get('/unidades_medida/{id}/destroy', ['as' => 'unidades.destroy', 'uses' => 'UnidadMedidaController@destroy'])->middleware('auth');
    Route::put('/unidades_medida/{id}/update', ['as' => 'unidades.update', 'uses' => 'UnidadMedidaController@update'])->middleware('auth');
    Route::post('/unidades_medida/', 'UnidadMedidaController@store');

//CATEGORIAS
    Route::get('/categorias', ['as' => 'categorias.index', 'uses' => 'CategoriaController@index'])->middleware('auth');
    Route::get('/categorias/{id}/destroy', ['as' => 'categorias.destroy', 'uses' => 'CategoriaController@destroy'])->middleware('auth');
    Route::put('/categorias/{id}/update', ['as' => 'update', 'uses' => 'CategoriaController@update'])->middleware('auth');
    Route::post('/categorias/', 'CategoriaController@store')->middleware('auth');

//CAJAS
    Route::get('/cajas', ['as' => 'cajas.index', 'uses' => 'CajaController@index'])->middleware('auth');
    Route::post('/cajas', ['as' => 'cajas.create', 'uses' => 'CajaController@store'])->middleware('auth');
    Route::post('/cajas/{id}/close', ['as' => 'cajas.close', 'uses' => 'CajaController@close'])->middleware('auth');

//VENTAS
    Route::get('/ventas', ['as' => 'ventas.index', 'uses' => 'FacturaController@index'])->middleware('auth');
    Route::get('/ventas/create', ['as' => 'ventas.create', 'uses' => 'FacturaController@create'])->middleware('auth');
    Route::get('/ventas/{id}/', ['as' => 'factura.detalles', 'uses' => 'FacturaController@show'])->middleware('auth');
    Route::post('/ventas/store', ['as' => 'ventas.store', 'uses' => 'FacturaController@store'])->middleware('auth');
    Route::post('/ventas/storeCredit', ['as' => 'ventas.store', 'uses' => 'CreditoController@store'])->middleware('auth');
    Route::get('/ventas/{id}/destroy', ['as' => 'ventas.destroy', 'uses' => 'FacturaController@destroy'])->middleware('auth');
    Route::post('/ventas/clientes', ['as' => 'ventas.cliente.create', 'uses' => 'ClienteController@store'])->middleware('auth');
    Route::post('/ventas/getDataClient', ['as' => 'ventas.cliente.search', 'uses' => 'ClienteController@getDataClient'])->middleware('auth');
    Route::post('/ventas/addProduct', ['as' => 'ventas.addProduct', 'uses' => 'TempProductsController@addProduct'])->middleware('auth');
    Route::post('/ventas/removeAll', ['as' => 'ventas.removeAll', 'uses' => 'TempProductsController@removeAll'])->middleware('auth');
    Route::post('/ventas/removeProduct', ['as' => 'ventas.removeProduct', 'uses' => 'TempProductsController@removeProduct'])->middleware('auth');
    Route::post('/ventas/editProduct/', ['uses' => 'TempProductsController@editProductTmp'])->middleware('auth');
    Route::post('/ventas/queryProducts/', ['uses' => 'TempProductsController@queryProducts'])->middleware('auth');

    Route::get('/ventas/verFactura/{id}', ['as' => 'factura.view', 'uses' => 'PdfController@verFactura'])->middleware('auth');


//CREDITOS
    Route::get('/creditos', ['as' => 'creditos.index', 'uses' => 'CreditoController@index'])->middleware('auth');
    Route::get('/creditos/{id}/destroy', ['as' => 'creditos.destroy', 'uses' => 'CreditoController@destroy'])->middleware('auth');
    Route::get('/creditos/{id}/', ['as' => 'creditos.detalles', 'uses' => 'CreditoController@show'])->middleware('auth');
    Route::get('/creditos/{id}/abonos/create', ['as' => 'creditos.abono', 'uses' => 'AbonoController@create'])->middleware('auth');
    Route::post('/creditos/{id}/abonos/store', ['as' => 'abono.store', 'uses' => 'AbonoController@store'])->middleware('auth');
*/
