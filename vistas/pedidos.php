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
                <li class="nav-item active nav_only" padre="divSolicitudes">
                    <a class="nav-link">
                        <i class="i-hand-holding-box-regular"></i>
                        SOLICITUDES
                    </a>
                </li>
                <li class="nav-item nav_only" padre="divConfiguracion">
                    <a class="nav-link" href="#">
                        <i class="i-users-cog-regular"></i>
                        CONFIGURACION
                    </a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="i-sack-dollar-regular"></i>
                            COMPRAS
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li class="nav_only" padre="divComprasProducto" ><a class="dropdown-item" id="item_compras_producto"><i class="i-address-book-solid"></i> Productos</a></li>
                            <li class="nav_only"  padre="divComprasPendientes"><a class="dropdown-item"><i class="i-graph-search"></i> Pendientes</a></li>
                        </ul>
                    </div>
                </a>
                </li>
                <li class="nav-item nav_only">
                <a class="nav-link" href="#">
                    <i class="i-box-open-regular"></i>
                    ALMACEN
                </a>
                </li>
                <li class="nav-item nav_only">
                <a class="nav-link" href="#">
                    <i class="i-file-signature-regular"></i>
                    FIRMA DIGITAL
                </a>
                </li>
                <li class="nav-item nav_only">
                <a class="nav-link" href="#">
                    <i class="i-fast-truck"></i>
                    SALIDAS
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
        <div class="col-12 row" id="divSolicitudes">
            <div class="col-12 col-md-6">
                <div class="m-1 mt-3 rounded-3 bg-white shadow-sm p-2 px-4">
                    <span class="h5 fw-bold"><i class="i-user-plus-solid"></i> Quien los crea: </span><br>
                    <span class="fw-bold">Nombre: </span><span id=""><span id="">JOSE DE LOS SANTOS AMARILLO</span><br>
                    <span class="fw-bold">Fecha: </span><span id="">10-03-2022</span><br>
                    <span class="fw-bold">Hora: </span><span id=""></span><br>
                </div>
            </div>                             
            <div class="col-12 col-md-6">
                <div class="m-1 mt-3 rounded-3 bg-white shadow-sm p-2 px-4">
                    <span class="h5 fw-bold"><i class="i-user-check-solid"></i> Quien los autoriza: </span><br>
                    <span class="fw-bold">Nombre: </span><span id="">CARLOS RANGEL</span><br>
                    <span class="fw-bold">Fecha: </span><span id="">10-03-2022</span><br>
                    <span class="fw-bold">Hora: </span><span id=""></span><br>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="m-1 mt-3 rounded-3 bg-white shadow-sm px-4 py-2">
                    <span class="h5 fw-bold"><i class="i-docs"></i> Observaciones: </span><span class="small">
                    <pre class="hidden">
                        <?php print_r($_SESSION) ?>
                    </pre>    
                </span>
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
                        <button class="btn btn-primary"><i class="i-search"></i> Buscar Solicitud</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12" >
                <div class="m-1 mt-3 rounded-3 bg-white shadow-sm border border-dark p-3" style="max-height: 800px;">
                    <form>
                        <div class="row px-5">
                            <div class="col-12">
                                <h5 class="text-center"><i class="i-graph-search"></i> Buscar solicitud</h5><hr>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label " for="">Numero: </label>
                                <input class="form-control " type="number">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label " for="">Sede: </label>
                                <select class="form-select " name="" id="">
                                    <option value="0" selected disabled>Seleccione una sede</option>
                                    <option value="1">BOGOTA</option>
                                    <option value="2">IBAGUE</option>
                                    <option value="3">BARRANQUILLA</option>
                                    <option value="4">PORTOS</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label " for="">departamento: </label>
                                <select class="form-select " name="" id="">
                                    <option value="0" selected disabled>Seleccione un departamento</option>
                                    <option value="1">OPERATIVA</option>
                                    <option value="2">ADMINISTRATIVA</option>
                                    <option value="3">FINANCIERA</option>
                                    <option value="4">COMERCIAL</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label " for="">Area: </label>                     
                                <select class="form-select " name="" id="">
                                    <option value="0" selected disabled>Seleccione un area</option>
                                    <option value="1">ALMACEN TEMPORAL CAMPAÑAS</option>
                                    <option value="2">ALMACEN TEMPORAL CAMPAÑAS</option>
                                    <option value="3">ALMACEN TEMPORAL CAMPAÑAS</option>
                                    <option value="4">ALMACEN TEMPORAL CAMPAÑAS</option>
                                </select>
                            </div>
                            <hr class="my-2 text-gray-100">
                            <div class="col-12 col-md-3">
                                <label class="form-label " for="">desde: </label>
                                <input class="form-control " type="date">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label " for="">hasta: </label>
                                <input class="form-control " type="date">
                            </div>
                            <div class="col-12 col-md-3 d-flex align-items-end pb-1">
                                <button class="btn  btn-outline-secondary d-inline-flex justify-content-center align-items-center w-100" type="reset"><i class="i-brush-solid me-2"></i> Limpiar Busqueda</button>
                            </div>
                            <div class="col-12 col-md-3 d-flex align-items-end pb-1">
                                <button class="btn  btn-outline-green d-inline-flex justify-content-center align-items-center w-100" type="button"><i class="i-graph-search me-2"></i> Buscar</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="m-1 mt-3 rounded-3 bg-white shadow-sm border border-dark p-3" style="max-height: 800px;">
                    
                </div>
            </div>
            <div class="col-12 col-md-12" id="divListadoSolicitudes">
                <div class="m-1 mt-3 rounded-3 bg-white shadow-sm  table-responsive overflow-auto border border-dark" style="max-height: 400px;">
                    <table class="table table-sm table-striped">
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
                        <tbody>
                            <tr>
                                <th scope="row">137719</th>
                                <td>BARRANQUILLA</td>
                                <td>OPERATIVA</td>
                                <td>ALMACEN TEMPORAL CAMPAÑAS</td>
                                <td>PENDIENTES</td>
                                <td>10-03-2022</td>
                                <td><button class="btn btn-sm btn-teal" type="button">Autorizar</button> | <button class="btn btn-sm btn-blood" type="button">Anular</button></td>
                            </tr>
                        </tbody>
                    </table>
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
                            <div class="input-group">
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
                    <button class="btn btn-sm btn-red d-inline-flex justify-content-center align-items-center w-100" type="button"><i class="i-graph-search me-2" data-bs-dismiss="modal"></i> Cancelar Solicitud</button>
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
<!-- Modal buscar solicitud producto-->
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
<!-- fin modal buscar solicitud producto-->
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

<!-- sedes /
areas /
departamentos /
usuario x -->

<!--  -->
<!-- faltantes_borrar
usuarios_departamentos_borrar
departamentos_areas_borrar
usda
vencimientos productos
informes -->
<!--  -->

<!-- producto
inventarios
area_prod
solicitudes -
detalles
consecutivos
ordenes -->
