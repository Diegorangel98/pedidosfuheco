<?php
function tienePermiso($x) {
	for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
		if ($_SESSION['permisos'][$i]['idprivilegio'] == $x) {
			return $_SESSION['permisos'][$i];
		}
	}

	return 0;
}
?>

<nav class="navbar navbar-dark navbar-expand-xl bg-red d-flex justify-content-beetwen">
  <div class="container-fluid">
    <a class="navbar-brand" onclick="validarSesion()">
        <i class="i-dice-d10-solid" width="30" height="24" class="d-inline-block align-text-top"></i>
      Solicitud de Herramientas
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex">
            <ul class="navbar-nav mr-auto btn-group">
            	<?php
            		if (tienePermiso(1)) {
            			print_r(tienePermiso(1)['sedes']);
            		 ?>
	                <li class="nav-item active nav_only" padre="divSolicitudes">
                    <a class="btn nav-link">
                      <i class="i-hand-holding-box-regular"></i>
                      SOLICITUDES
                    </a>
	                </li><?php
            		}

            		if (tienePermiso(2)) { ?>
	                <li class="nav-item nav_only" padre="divConfiguracion">
	                    <a class="btn nav-link">
	                        <i class="i-users-cog-regular"></i>
	                        CONFIGURACION
	                    </a>
	                </li><?php
            		}

            		if (tienePermiso(3)) { ?>
	                <li class="nav-item">
	                    <div class="dropdown">
	                        <a class="btn dropdown-toggle nav-link" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
	                            <i class="i-sack-dollar-regular"></i>
	                            COMPRAS
	                        </a>

	                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	                            <li class="nav_only" padre="divComprasProducto" ><a class="dropdown-item" id="item_compras_producto"><i class="i-address-book-solid"></i> Productos</a></li>
	                            <li class="nav_only"  padre="divComprasPendiente"><a class="dropdown-item"><i class="i-graph-search"></i> Pendientes</a></li>
	                        </ul>
	                    </div>
	                </li><?php
            		}
            	?>

                <li class="nav-item nav_only" padre="divSalidas">
                <a class="btn nav-link">
                    <i class="i-fast-truck"></i>
                    SALIDAS
                </a>
                </li>
                <li class="nav-item nav_only">
                <a class="btn nav-link">
                    <i class="i-file-signature-regular"></i>
                    FIRMA DIGITAL
                </a>
                </li>
                <li class="nav-item nav_only">
                <a class="btn nav-link">
                    <i class="i-box-open-regular"></i>
                    ALMACEN
                </a>
                </li>
            </ul>
        </div>
    </div>

  </div>
</nav>



<input type="hidden" id="idusua" value="">
<div class="container">
    <div class="row">
        <div class="col-12" id="divComprasPendiente">
            <div class="row">
                <div class="col-12">
                    <div class="row m-1 mt-3 rounded-3 bg-white shadow-sm p-2 px-4">
                        <H5>COMPRAS PENDIENTES</H5>
                        <select name="" id="sedesCompras" class="form-select"></select>
                        <div class="p-2" id="listaSolicitudesCompras"></div>
                    </div>
                </div>
            </div>    
        </div>
        <div class="col-12" id="divSolicitudes">
            <div class="row">
                <div class="col-12">
                    <div class="">
                            <div class="row m-1 mt-3 rounded-3 bg-white shadow-sm p-2 px-4">
                                <div class="col-6 p-3">
                                    <div class="row">
                                        <div class="col-12"><span class="h6 fw-bold"><i class="i-user-plus-solid"></i> creado por: </span><span id="nombreQuienCreaSol"></span></div>
                                        <hr class="m-1">
                                        <div class="col-5"><span class="fw-bold">Fecha: </span><span id="fechaCreaSol">10-03-2022</span></div>
                                        <div class="col-7"><span class="fw-bold">Hora: </span><span id="horaCreaSol"></span>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-6 p-3">
                                    <div class="row">
                                        <div class="col-12"><span class="h6 fw-bold"><i class="i-user-check-solid"></i> autorizado por: </span><span id=""><span id="nombreQuienautoSol"></span></div>
                                        <hr class="m-1">
                                        <div class="col-5"><span class="fw-bold">Fecha: </span><span id="">10-03-2022</span></div>
                                        <div class="col-7"><span class="fw-bold">Hora: </span></div>
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="col-12">
                                <span class="h5 fw-bold"><i class="i-docs"></i> Observaciones: </span><span class="small">(Opcional)</span>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="m-1 mt-3 rounded-3 bg-white shadow-sm p-2 px-4">
                        <div class="d-grid">
                            <button class="btn btn-primary" id="btnModalNuevaSolicitud"><i class="i-file-plus-solid"></i> Nueva Solicitud</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="m-1 mt-3 rounded-3 bg-white shadow-sm p-2 px-4">
                        <div class="d-grid">
                            <button class="btn btn-primary" id="btnModalBuscarSolicitudN"><i class="i-search"></i> Buscar Solicitud</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12" id="divListadoSolicitudes">
                    <div class="m-1 mt-3 rounded-3 bg-white shadow-sm  table-responsive overflow-auto border border-dark" style="max-height: 400px;">
                        <table class="table table-sm table-striped table-hover">
                            <thead class="bg-blood text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sede</th>
                                    <th scope="col">Departamento</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listaSolicitudes">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>    
        </div>
        <div class="col-12" id="divSalidas">
            <div class="row bg-white shadow-sm p-3 m-2">
                    <span class="h5"><i class="i-fast-truck"></i> Salidas</span>
                    <select class="form-select" name="" id="sedeAlmacen"></select>
                <div class="col-12">
                    <div class="table-responsive p-3">
                        <table class="table table-sm table-striped table-hover">
                            <thead class="bg-blood text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sede</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Dependencia</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody id="listaAlmacen">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12" id="divConfiguracion">
            <div class="m-1 mt-3 rounded-3 bg-white shadow-sm border border-dark p-3" style="max-height: 800px;">
                <div class="row px-4">

                    <h5 class="text-center"><i class="i-users-cog-regular"></i> Configuracion</h5><hr>
                    <div class="col-12 col-md-4">
                        <label class="form-label " for="">Sede: </label>
                        <select class="form-select " name="" id="sedesC">
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label " for="">Area: </label>
                        <select class="form-select " name="" id="areasC">
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label " for="">Dependencia: </label>                     
                        <select class="form-select " name="" id="dependenciasC">
                        </select>
                    </div>
                    <div class="col-9 row">
                        <div class="col-12">
                            <span class=" p-2">
                                <input type="radio" name="buscarPorDependencia" id="breferenciaDependencia">
                                <label class="form-label " for="breferenciaDependencia">Referencia. </label>
                            </span><span class="text-gray-300 mx-2">|</span>
                            <span class="p-2">
                                <input type="radio" name="buscarPorDependencia" id="bdescripcionDependencia" checked>
                                <label class="form-label " for="bdescripcionDependencia">Descripción. </label>
                            </span>
                        </div>
                        <div class="input-group col-12">
                            <input type="hidden" id="idproductoC">
                            <input type="text" class="form-control" id="inputBuscarProductoDependencia" placeholder="Buscar Producto">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="btnBuscarProductoDependencia"><i class="i-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 d-grid">                 
                        <label class="form-label " for=""></label>    
                        <button class="btn btn-green btn-sm" type="button" id="btnAgregarProductoDependencia"><i class="i-plus-solid"></i> Agregar</button>
                    </div>
                    <div class="col-12" id="listarProductosConfig"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12" id="divComprasProducto">
            <div class="m-1 mt-3 rounded-3 bg-white shadow-sm border border-dark p-3" style="max-height: 800px;">
                <div class="row">
                        <div class="col-12 my-2">
                            <h5 class="text-center"><i class="i-box"></i> Productos</h5><hr>
                        </div>
                        <div class="col-6 col-md-2 my-2  d-flex justify-content-center">
                            <button type="button" class="btn btn-blood" id="btnModalAgregarProducto"><i class="i-box-check-regular"></i> Agregar</button>
                        </div>
                        <div class="col-12 col-md-8 my-2">
                            <div class="input-group" id="radiosConfiguracion">
                                <button class="btn btn-gray" type="button" id="btnBuscarReferenciaP">Buscar por referencia</button>
                                <input type="text" class="form-control" placeholder="Escriba el nombre del producto" aria-label="Recipient's username" id="inputBuscarProducto">
                                <button class="btn btn-gray" type="button" id="btnBuscarDescripcionP">Buscar por descripción</button>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 my-2  d-flex justify-content-center">
                            <button type="button" class="btn btn-blood" id="btnListarAll"><i class="i-clipboard-list-solid"></i> Ver todos</button>
                        </div>
                        <div class="col-12 my-2">
                            <div class="border table-responsive" style="max-height: 500px" id="listaProductos"></div>
                        </div>
                </div>
            </div>
        </div>
        
    </div>
        
</div>
<!-- modales -->
<!-- Modal agregar producto -->
    <div class="modal fade" id="modalAgregarProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><i class="i-add-item"></i> Agregar producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="addReferencia">Referencia</label>
                        <input type="text" class="form-control" id="addReferencia" placeholder="Referencia" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="addDescripcion">Descripcion</label>
                        <input type="text" class="form-control" id="addDescripcion" placeholder="Descripcion">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="addEstado">
                        <label class="form-check-label" for="addEstado">
                            Estado
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnAgregarProducto"><i class="i-plus-circle-solid1"></i> Agregar</button>
        </div>
        </div>
    </div>
    </div>
<!-- fin modal agregar producto -->
<!-- Modal editar producto -->
    <div class="modal fade" id="modalEditarProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" ><i class="i-add-item"></i> Editar producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="addReferencia">Referencia</label>
                        <input type="text" class="form-control" id="editReferencia" placeholder="Referencia" autofocus>
                        <input type="hidden" class="form-control" id="editIdProducto">
                    </div>
                    <div class="form-group">
                        <label for="addDescripcion">Descripcion</label>
                        <input type="text" class="form-control" id="editDescripcion" placeholder="Descripcion">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="editEstado">
                        <label class="form-check-label" for="editEstado">
                            Estado
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnEditarProducto"><i class="i-plus-circle-solid1"></i> Guardar Cambios</button>
        </div>
        </div>
    </div>
    </div>
<!-- fin modal editar producto -->
<!-- Modal nueva solicitud-->
    <div class="modal fade" id="modalNuevaSolicitud" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header text-center">
            <h5 class="modal-title" ><i class="i-layer-plus-solid"></i> Nueva Solicitud</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label class="form-label " for="">Fecha: </label>
                    <input class="form-control" disabled type="date" value="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="col-12 col-md-6" >
                    <label class="form-label " for="">Sede: </label>
                    <select class="form-select " name="" id="sedesN">
                    </select>
                </div>
                <hr class="text-gray-800 my-3">
                <div class="col-12 col-md-6">
                    <label class="form-label " for="">Area: </label>
                    <select class="form-select " name="" id="areasN">
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label " for="">Dependencia: </label>                     
                    <select class="form-select " name="" id="dependenciasN">
                    </select>
                </div>
                <hr class="text-gray-800 my-3">
                <div class="col-12 col-md-6 row">
                    <div class="col-12">
                        <span class=" p-2">
                            <input type="radio" name="buscarPor" id="breferencia">
                            <label class="form-label " for="breferencia">Referencia. </label>
                        </span><span class="text-gray-300 mx-2">|</span>
                        <span class="p-2">
                            <input type="radio" name="buscarPor" id="bdescripcion" checked>
                            <label class="form-label " for="bdescripcion">Descripción. </label>
                        </span>
                    </div>
                    <div class="input-group col-12">
                        <input type="text" class="form-control" id="buscarProductoN" placeholder="Buscar Producto">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="btnBuscarProductoN"><i class="i-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label " for="">Cantidad: </label>
                    <input class="form-control" type="number" value="0" id="cantidadProductoN">
                    <input type="hidden" class="form-control" id="idproductoTempN" value="0">
                </div>
                <hr class="text-gray-800 my-3">
                <div class="col-12 col-md-4 d-flex align-items-end pb-1">
                    <button class="btn btn-sm btn-teal d-inline-flex justify-content-center align-items-center w-100" id="btnAddItemCarrito" type="button"><i class="i-plus-circle-regular me-2"></i> Agregar Producto</button>
                </div>
                <div class="col-12 col-md-4 d-flex align-items-end pb-1">
                    <button class="btn btn-sm btn-cyan d-inline-flex justify-content-center align-items-center w-100" id="btnConfirmarSolicitudN" type="button"><i class="i-check me-2"></i> Confirmar Solicitud</button>
                </div>
                <div class="col-12 col-md-4 d-flex align-items-end pb-1">
                    <button class="btn btn-sm btn-red d-inline-flex justify-content-center align-items-center w-100" type="button" id=""><i class="i-graph-search me-2" data-bs-dismiss="modal"></i> Cancelar Solicitud</button>
                </div>
                
            </div></form>
            <div class="" >
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive" id="carritoSolicitud">
                            <table class="table table-hover table-sm table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:65%">Descripcion</th>
                                        <th style="width:20%">Cantidad</th>
                                        <th style="width:15%;">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodySolicitudN">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
        </div>
        </div>
    </div>
    </div>
<!-- fin modal nueva solicitud-->
<!-- Modal buscar producto producto-->
    <div class="modal fade" id="modalBuscarProductoN" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" ><i class="i-add-item"></i> Seleccionar producto</h5>
                <button class="ms-5 btn btn-gray" id="btnVolverSelectSolicitud"><i class="i-angle-double-left-solid"></i> Volver</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Referencia</th>
                                        <th>Descripcion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyBuscarProductoN">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- fin modal buscar producto producto-->
<!-- Modal buscar producto configuracion-->
<div class="modal fade" id="modalBuscarProductoC" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" ><i class="i-add-item"></i> Seleccionar producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Referencia</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyBuscarProductoC">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
<!-- fin modal buscar producto configuracion-->
<!-- Modal buscar solicitud-->
    <div class="modal fade" id="modalBuscarSolicitudN" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" ><i class="i-search-plus-solid"></i> Buscar Solicitud</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!--  -->
                <form>
                        <div class="row px-5">
                            <div class="col-12 col-md-4">
                                <label class="form-label " for="">Numero: </label>
                                <input class="form-control" type="number" id="numeroSolicitudB">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label " for="">Sede: </label>
                                <select class="form-select" name="" id="sedesB"></select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label " for="">dependencia: </label>
                                <select class="form-select" name="" id="dependenciasB"></select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label " for="">Area: </label>                     
                                <select class="form-select" name="" id="areasB"></select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label " for="">desde: </label>
                                <input class="form-control" type="date" id="desdeBuscar">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label " for="">hasta: </label>
                                <input class="form-control" type="date" id="hastaBuscar">
                            </div>
                            <hr class="my-2">
                            <div class="col-12 col-md-6 d-flex align-items-end pb-1">
                                <button class="btn  btn-outline-secondary d-inline-flex justify-content-center align-items-center w-100" type="reset"><i class="i-brush-solid me-2"></i> Limpiar Busqueda</button>
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-end pb-1">
                                <button class="btn  btn-outline-green d-inline-flex justify-content-center align-items-center w-100" type="button" id="btnBuscarSolicitud"><i class="i-graph-search me-2"></i> Buscar</button>
                            </div>
                            
                        </div>
                </form>
            <!--  -->
        </div>
        </div>
    </div>
    </div>


<!-- fin modal buscarproducto-->
<!-- Modal buscar solicitud-->
    <div class="modal fade" id="modalEditarProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" ><i class="i-add-item"></i> Editar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="addReferencia">Referencia</label>
                            <input type="text" class="form-control" id="editReferencia" placeholder="Referencia" autofocus>
                            <input type="text" class="form-control" id="editIdProducto">
                        </div>
                        <div class="form-group">
                            <label for="addDescripcion">Descripcion</label>
                            <input type="text" class="form-control" id="editDescripcion" placeholder="Descripcion">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="editEstado">
                            <label class="form-check-label" for="editEstado">
                                Estado
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnEditarProducto"><i class="i-plus-circle-solid1"></i> Guardar Cambios</button>
            </div>
            </div>
        </div>
    </div>
<!-- fin modal buscar solicitud-->
<!-- Modal detalle solicitud Almacen-->
    <div class="modal fade" id="modalDetalleSolicitudAlmacen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" ><i class="i-add-item"></i> Detalles solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="bodyModalDetalleSolAlmacen">
                    <div class="col-12">
                       <h3>Detalles</h3>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnHacerSalida"><i class="i-plus-circle-solid1"></i> Hacer Salida</button>
            </div>
            </div>
        </div>
    </div>
<!-- fin Modal detalle solicitud Almacen-->
<!-- Modal detalle solicitud Almacen-->
    <div class="modal fade" id="modalDetalleSolicitudAlmacen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" ><i class="i-add-item"></i> Detalles solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="bodyModalDetalleSolAlmacen">
                    <div class="col-12">
                       <h3>Detalles</h3>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnHacerSalida"><i class="i-plus-circle-solid1"></i> Hacer Salida</button>
            </div>
            </div>
        </div>
0    </div>
<!-- fin Modal detalle solicitud Almacen-->
<!-- Modal ajustar cantidad -->
    <div class="modal fade" id="modalAjustarCantidad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" ><i class="i-add-item"></i> Ajustar cantidad</h5>
                <button type="button" class="btn-close btnCerrarMCntidad" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="bodyAjustarCantidad">
                    <div class="col-12">
                        <span class="h4">¿Desea modificar la cantidad a entregar?.<br> La cantidad actual es: <span id="cantidadActual"></span> </span>
                        <input type="number" class="form-control" id="nuevaCantidad" onkeypress="return isNumber(event)">
                        <input type="hidden" class="form-control" id="idProdNewCant">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btnCerrarMCntidad" >Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnActualizarCantidad"><i class="i-save"></i> Actualizar cantidad</button>
            </div>
            </div>
        </div>
    </div>
<!-- fin Modal ajustar cantidad -->
<!-- Modal solicitud atendida -->
    <div class="modal fade" id="modalSolicitudAtendida" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" ><i class="i-add-item"></i> Atender Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="bodyAtenderSolicitud">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnAtenderSolicitud"><i class="i-save"></i> Atender Solicitud</button>
            </div>
            </div>
        </div>
    </div>
<!-- fin Modal solicitud atendida -->
<!-- Modal autorizar solicitud -->
    <div class="modal fade" id="modalAutorizarSolicitud" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" ><i class="i-add-item"></i> Autorizar Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="bodyAutorizarSolicitud">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnAtutorizarSolicitud"><i class="i-save"></i> Autorizar Solicitud</button>
            </div>
            </div>
        </div>
    </div>
<!-- fin Modal autorizar solicitud -->
<!-- Modal ajustar cantidad autorizar -->
    <div class="modal fade" id="modalAjustarcantidadAutorizar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" ><i class="i-add-item"></i> Autorizar Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="">
                    <div class="col-12">
                        <span class="h4">¿Desea modificar la cantidad solicitada?.<br> La cantidad actual es: <span id="cantidadActualSolicitada"></span> </span>
                        <input type="number" class="form-control" id="nuevaCantidadSolicitada" onkeypress="return isNumber(event)">
                        <input type="hidden" class="form-control" id="iddetalleajustar">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnAjustarCantAutorizar"><i class="i-save"></i> Ajustar Cantidad</button>
            </div>
            </div>
        </div>
    </div>
<!-- fin Modal ajustar cantidad autorizar -->
<script>
	var obj = <?php echo json_encode($_SESSION['permisos']); ?>;
</script>

