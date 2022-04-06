<?php
require_once "../../../base/clase_bases.php";


function tienePermiso($x) {
	for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
		if ($_SESSION['permisos'][$i]['idprivilegio'] == $x) {
			return $_SESSION['permisos'][$i];
		}
	}

	return 0;
}


switch ($_POST["op"])
{
	case "inicio":
	{
		inicio();
		break;
	}
	case "agregarProducto":
	{
		agregarProducto($_POST["referencia"], $_POST["descripcion"], $_POST["estado"]);
		break;
	}
	case "listarProductos":
	{
		listarProductos();
		break;
	}
	case "validarSesion":
	{
		validarSesion();
		break;
	}
	case "sesion":
	{
		sesion($_POST["login"],$_POST["password"]);
		break;
	}
	case "buscarProducto":
	{
		buscarProducto($_POST["item"], $_POST["tipo"]);
		break;
	}
	case "buscarProductoConfiguracion":
	{
		buscarProductoConfiguracion($_POST["item"], $_POST["tipo"]);
		break;
	}
	case "buscarProductoNuevaSol":
	{
		buscarProductoNuevaSol($_POST["tipo"], $_POST["item"], $_POST["dependencia"]);
		break;
	}
	case "datosProducto":
	{
		datosProducto($_POST["idProducto"]);
		break;
	}
	case "editarProducto":
	{
		editarProducto($_POST["idProducto"], $_POST["referencia"], $_POST["producto"], $_POST["estado"]);
		break;
	}
	case "validarPendiente":
	{
		validarPendiente($_POST["idsede"], $_POST["idarea"], $_POST["iddependencia"], $_POST["idproducto"]);
		break;
	}
	case "ingresoDetalle":
	{
		ingresoDetalle($_POST["idprod"], $_POST["cantidad"], $_POST["fin"], $_POST["idsede"], $_POST["idarea"]);
		break;
	}
	case "ingresosoli":
	{
		ingresosoli($_POST["idsede"],$_POST["sede"], $_POST["iddependencia"],$_POST["dependencia"], $_POST["idarea"],$_POST["area"], $_POST["obs"]);
		break;
	}
	case "buscarPermisos":
	{
		buscarPermisos($_POST["permiso"]);
		break;
	}
	case "listarsolicitudes":
	{
		listarsolicitudes($_POST["idsede"], $_POST["idarea"], $_POST["iddependencia"]);
		break;
	}
	case "areas":
	{
		areas($_POST["idsede"]);
		break;
	}
	case "dependencias":
	{
		dependencias($_POST["idsede"], $_POST["idarea"]);
		break;
	}
	case "autorizar":
	{
		autorizar($_POST["idsolicitud"]);
		break;
	}
	case "almacen":
	{
		almacen();
		break;
	}
	case "solicitudesAlmacen":
	{
		solicitudesAlmacen($_POST["sede"]);
		break;
	}
	case "detallesSolicitudAlmacen":
	{
		detallesSolicitudAlmacen($_POST["idsolicitud"]);
		break;
	}
	case "actualizarCantidadEntregada":
		{
			actualizarCantidadEntregada($_POST["idproducto"],$_POST["cantidad"]);
			break;
		}
	case "detallesSolicitud":
	{
		detallesSolicitud($_POST["idsolicitud"]);
		break;
	}
	case "hacerSalida":
	{
		hacerSalida($_POST["idsolicitud"]);
		break;
	}
	case "listarSolicitudesCompras":
		{
			listarSolicitudesCompras($_POST["sede"]);
			break;
		}
	case "finalizarCompra":
	{
		finalizarCompra($_POST["idsolicitud"]);
		break;
	}
	case "atenderSolicitud":
	{
		atenderSolicitud($_POST["idsolicitud"], $_POST["numhelisa"]);
		break;
	}
	case "agregarProductoDependencia":
	{
		agregarProductoDependencia($_POST["iddependencia"], $_POST["idproducto"]);
		break;
	}
	case "listarProductosConfig":
	{
		listarProductosConfig($_POST["iddependencia"]);
		break;
	}
	case "anularProductoConfig":
	{
		anularProductoConfig($_POST["iddepprod"]);
		break;
	}
	case "anularSolicitud":
	{
		anularSolicitud($_POST["idsolicitud"]);
		break;
	}
	case "detallesAutorizar":
	{
		detallesAutorizar($_POST["idsolicitud"]);
		break;
	}
	case "actualizarCantidadAutorizar":
	{
		actualizarCantidadAutorizar($_POST["idproducto"],$_POST["cantidad"]);
		break;
	}
}
function actualizarCantidadAutorizar($idproducto, $cantidad)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$ajustarCantidad = $obj->ajustarCantidadSolicitada($idproducto, $cantidad)[0]['idsolicitud'];
	if($ajustarCantidad)
	{
		echo $ajustarCantidad;
	}else{
		echo "error";
	}
}
function detallesAutorizar($idsolicitud)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$detallesSoli = $obj->detallesSolicitudAlmacen($idsolicitud);
	if(!$detallesSoli)
	{
		echo "No se encontraron datos";
	}
	else
	{
		echo "<div class='table-responsive'>
				<table class='table table-bordered table-hover table-striped'>
					<thead>
						<tr>
							<th>Producto</th>
							<th>Cantidad</th>
						</tr>
					</thead>
					<tbody><input type='hidden' id='idsolicitudAutorizar' value='".$idsolicitud."'>";
						for ($i=0; $i < count($detallesSoli) ; $i++) {
							echo "<tr ondblclick='ajustarCantidadAutorizar(".$detallesSoli[$i]['iddetalle'].", ".$detallesSoli[$i]["cantidad_solicitada"].")'>
								<td>".$detallesSoli[$i]["producto"]."</td>
								<td>".$detallesSoli[$i]["cantidad_solicitada"]."</td>
							</tr>";
						}
					echo "</tbody>
				</table>
			</div>";
	}

}
function anularSolicitud($idsolicitud)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$anularSol = $obj->anularSolicitud($idsolicitud)[0]['idsolicitud'];
	if($anularSol == $idsolicitud)
	{
		echo "ok";
	}

}
function anularProductoConfig($iddepprod)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$anular = $obj->anularProductoConfig($iddepprod);
	if(is_numeric($anular[0]['iddepprod']))
	{
		echo "1";
		echo $anular[0]['iddepprod'];
	}
	else
	{
		echo $anular[0]['iddepprod'];
		echo "error";
	}
		
}
function listarProductosConfig($iddependencia)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$listarConf = $obj->listarProductosConfig($iddependencia);
	if($listarConf)
	{
		echo "<div class='table-responsive'>
		<table class='table table-sm table-striped table-hover'>
		<thead>
		<tr>
		<th>Referencia</th>
		<th>Descripción</th>
						<th>Estado</th>
						<th>Acciones</th>
						</tr>
						</thead>
				<tbody>";
		for ($i=0; $i < count($listarConf) ; $i++) { 
		echo "<tr>
		<td>".$listarConf[$i]["referencia"]."</td>
		<td>".$listarConf[$i]["producto"]."</td>
		<td>".$listarConf[$i]["estado"]."</td>
		<td>
		<button class='btn btn-danger' onclick='anularProductoConfig(".$listarConf[$i]["iddepprod"].")'>Eliminar</button>
		</td>
		</tr>";
		}
		echo "</tbody>
		</table>
		</div>";
	}else{
		echo "No se encontraron productos configurados";
	}
}
function agregarProductoDependencia($iddependencia, $idproducto)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$dependenciaProd = $obj->agregarProductoDependencia($iddependencia, $idproducto);
	if(!$dependenciaProd)
	{
		echo "Producto agregado a la dependencia";
	}
	else
	{
		print_r($dependenciaProd);
	}
}
function atenderSolicitud($idsolicitud,$numhelisa)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$atender = $obj->atenderSolicitud($idsolicitud,$numhelisa)[0]['idsolicitud'];
	if(!is_numeric($atender))
	{
		echo "error";
	}else{
		echo $atender;
	}
}
function finalizarCompra($idsolicitud)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$listar = $obj->detalladoSolicitud($idsolicitud);
	if(!$listar)
	{
		echo "Error al listar";
	}
	else
	{
		echo "<div class='p-2'>
				<label for='numhelisa'>Inserte el codigo generado por helisa.</label>
				<input class='form-control form-control-sm' type='text' id='numhelisa' placeholder='Numero helisa'><br>
			</div>";
		echo "<div>
				<table class='table table-sm table-striped table-bordered table-hover'>
				<thead>
					<tr>
						<th>Referencia</th>
						<th>Descripcion</th>
						<th>Solicitado</th>
						<th>Entregado</th>
					</tr>
					<input type='hidden' id='idSolicitudAtender' value='{$idsolicitud}'>
				</thead>
				<tbody>";
		for ($i=0; $i < count($listar) ; $i++) { 
			echo "<tr>
					<td>".$listar[$i]["referencia"]."</td>
					<td>".$listar[$i]["producto"]."</td>
					<td>".$listar[$i]["cantidad_solicitada"]."</td>
					<td>".$listar[$i]["cantidad_entregada"]."</td>
				</tr>";
		}
		echo "</tbody>
			</table>
			</div>";
	}
}
function listarSolicitudesCompras($sede)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	if($sede == 0)
	{
		$solicitudesCompras = $obj->getSolicitudesComprasAll();
	}else{
		$solicitudesCompras = $obj->getSolicitudesCompras($sede);
	}

	if(!$solicitudesCompras)
	{
		echo "No hay solicitudes de compras.";
	}else{
	echo "<table class='table table-bordered table-hover'>
	<thead class='bg-blood text-white'>
	<tr>
	<th>#</th>
	<th>Sede</th>
	<th>Dependencia</th>
	<th>Area</th>
	<th>Fecha</th>
	<th>Acciones</th>
	</tr>
	</thead>
	<tbody>";

	for ($i=0; $i < count($solicitudesCompras); $i++) { 
		echo "<tr>
		<td>".$solicitudesCompras[$i]['idsolicitud']."</td>
		<td>".$solicitudesCompras[$i]['sede']."</td>
		<td>".$solicitudesCompras[$i]['dependencia']."</td>
		<td>".$solicitudesCompras[$i]['area']."</td>
		<td>".$solicitudesCompras[$i]['fecha']."</td>
		<td>
		<button class='btn btn-success' onclick='FinalizarCompra(".$solicitudesCompras[$i]['idsolicitud'].")'><i class='i-check'></i> Atendida</button>
		</td>
		";
	}
}
}
function hacerSalida($idsolicitud)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$salida = $obj->hacerSalida($idsolicitud)[0];
	if (is_numeric($salida["idsolicitud"])) {
		echo $salida["idsolicitud"];
	} else {
		echo "error";
	}
}
function detallesSolicitud($idsolicitud)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$detalles = $obj->detallesSolicitud($idsolicitud)[0];
	if(!$detalles)
	{
		echo "Error al listar";
	}
	else
	{
		//print_r($detalles);
		$datosN = $obj->getNombres($detalles["quien_crea"],$detalles["quien_auto"]);
		//print_r($datosN);
		$detalles ["crea"] = $datosN[0];
		$detalles ["auto"] = $datosN[1];
		echo json_encode($detalles);
	}
}
function actualizarCantidadEntregada($idproducto,$cantidad)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$actualizar = $obj->actualizarCantidadEntregada($idproducto,$cantidad)[0]['idsolicitud'];
	print_r($actualizar);
}
function detallesSolicitudAlmacen($idsolicitud)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$detallesSol = $obj->detallesSolicitudAlmacen($idsolicitud);
	if(!$detallesSol)
	{
		echo "No se encontraron detalles de la solicitud";
	}
	else
	{
		echo "<table class='table table-sm table-striped table-hover'>
				<thead class='bg-blood table-dark'>
					<tr>
						<th>Referencia</th>
						<th>Descripción</th>
						<th>Solicitado</th>
						<th>Entregado</th>
					</tr>
				</thead>
				<tbody>";
		for($i=0;$i<count($detallesSol);$i++)
	
			echo "<tr ondblclick='ajustarCantidad(".$detallesSol[$i]['iddetalle']." , ".$detallesSol[$i]['cantidad_solicitada'].")'>
					<td><input id='inpidsolicitudSalida' type='hidden' value=".$detallesSol[$i]["idsolicitud"].">".$detallesSol[$i]["referencia"]."</td>
					<td>".$detallesSol[$i]["producto"]."</td>
					<td>".$detallesSol[$i]["cantidad_solicitada"]."</td>
					<td>".$detallesSol[$i]["cantidad_entregada"]."</td>
				</tr>";
		}
		echo "</tbody></table>";
	}
	

function solicitudesAlmacen($sede)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$solicitudSede = $obj->solicitudesAlmacen($sede);
	if(!$solicitudSede)
	{
		echo "No hay solicitudes";
	}else{
		for($i=0;$i<count($solicitudSede);$i++)
		{
			echo "<tr ondblclick='detallesSolicitudAlmacen(".$solicitudSede[$i]["idsolicitud"].")'>
					<td>".$solicitudSede[$i]["idsolicitud"]."</td>
					<td>".$solicitudSede[$i]["sede"]."</td>
					<td>".$solicitudSede[$i]["area"]."</td>
					<td>".$solicitudSede[$i]["dependencia"]."</td>";
					if($solicitudSede[$i]["autorizado"] > 0)
					{
					echo "<td><span class=''>Pendiente</span></td>";
					}
			echo	"<td>".$solicitudSede[$i]["fecha"]."</td>
				</tr>";
		}
	}
	
}
function almacen()
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$sedesalmacen = $obj->getSedesAlmacen();
	echo "<option value='0' selected disabled>Seleccione una sede</option>";
	for ($i = 0; $i < count($sedesalmacen); $i++) {
		echo "<option value='" . $sedesalmacen[$i]["idsede"] . "'>" . $sedesalmacen[$i]["sede"] . "</option>";
	}

}
function autorizar($idsolicitud)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$autorizar = $obj->autorizarSolicitud($idsolicitud);
	if($autorizar)
	{
		echo "ok";
	}
	else
	{
		echo "error";
	}
}
function dependencias($idsede, $idarea)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$dependencias = $obj->getDependencias($idsede, $idarea);
	echo "<option value='0'>Seleccione una dependencia</option>";
	for ($d=0; $d < count($dependencias) ; $d++) { 
		echo "<option value='".$dependencias[$d]["iddependencia"]."'>".$dependencias[$d]["dependencia"]."</option>";
	}
}
function areas($idsede)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$areas = $obj->getAreas($idsede);
	echo "<option value='0'>Seleccione un area</option>";
	for ($i=0; $i < count($areas) ; $i++) { 
		echo "<option value='".$areas[$i]["idarea"]."'>".$areas[$i]["area"]."</option>";
	}
}
function listarsolicitudes()
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$areas_dependencias = $obj->getSedesAreasDependenciasAll();
	// print_r($areas_dependencias);
	for ($i=0; $i < count($areas_dependencias['areas']) ; $i++) { 
		$areas[$areas_dependencias['areas'][$i]['idarea']] = $areas_dependencias['areas'][$i]['area'];
	}
	for ($i=0; $i < count($areas_dependencias['dependencias']) ; $i++) { 
		$dependencias[$areas_dependencias['dependencias'][$i]['iddependencia']] = $areas_dependencias['dependencias'][$i]['dependencia'];
	}

	if(tienePermiso(6) )
	{
		//si tiene permiso 6 podra listar todas las solicitudes
		$listar = $obj->listarSolicitudesAll();

		if(tienePermiso(1) )
		{
			//si tiene permiso 1 podra autorizar las solicitudes
			for($i=0;$i<count($listar);$i++)
			{
				if($listar[$i]['autorizado']==0)
				{
					$estado= "<td class=''>
						<div class='d-flex align-items-center'>
							<div class='me-2 bg-blue-400 ' style='width:20px; height:20px; border-radius:50%;'></div>
							<div> Por autorizar</div>
						</div>
					</td>";
					$autorizar="<button class='btn btn-sm btn-teal' onclick='autorizar({$listar[$i]['idsolicitud']})'>Autorizar</button> | ";
				}
				else
				{
					$estado= "<td class=''>
						<div class='d-flex align-items-center'>
							<div class='me-2 bg-orange-600 ' style='width:20px; height:20px; border-radius:50%;'></div>
							<div> Pendiente</div>
						</div>
					</td>";
					$autorizar="<button class='btn btn-sm btn-teal opacity-25 disabled' >Autorizar</button> | ";
				}

				echo "<tr id='tr-item-{$listar[$i]['idsolicitud']}' class='tr-item' onclick='clickSolicitud({$listar[$i]['idsolicitud']})'>
				<td>{$listar[$i]['idsolicitud']}</td>
				<td>{$listar[$i]['sede']}</td>
				<td>{$dependencias[$listar[$i]['iddependencia']]}</td>
				<td>{$areas[$listar[$i]['idarea']]}</td>
				{$estado}
				<td>{$listar[$i]['fecha']}</td>
				<td>{$autorizar}<button class='btn btn-sm btn-blood' onclick='anular({$listar[$i]['idsolicitud']})'>Anular</button></td>
				</tr> 
				";
			}
		}
		//echo json_encode($listar);
	}else if(tienePermiso(5))
	{
		//si tiene permiso 5 podra listar las solicitudes de su sede
		$listar = $obj->listarSolicitudesSede($_POST["idsede"]);
	}else{
		//si no tiene permiso 5 ni 6 listara solamente creadas por el usuario
		$listaruser = $obj->listarSolicitudesUser();
		if(!$listaruser){
			echo "No tiene solicitudes";
		}else{
			for($i=0;$i<count($listaruser);$i++)
			{
				if($listaruser[$i]['autorizado']==0)
				{
					$estado= "<td class=''>
						<div class='d-flex align-items-center'>
							<div class='me-2 bg-blue-400 ' style='width:20px; height:20px; border-radius:50%;'></div>
							<div> Por autorizar</div>
						</div>
					</td>";
				}
				else
				{
					$estado= "<td class=''>
						<div class='d-flex align-items-center'>
							<div class='me-2 bg-orange-600 ' style='width:20px; height:20px; border-radius:50%;'></div>
							<div> Pendiente</div>
						</div>
					</td>";
				}

				echo "<tr class='{$clase}' onclick='clickSolicitud({$listaruser[$i]['idsolicitud']},{$listaruser[$i]['autorizado']})'>
				<td>{$listaruser[$i]['idsolicitud']}</td>
				<td>{$listaruser[$i]['sede']}</td>
				<td>{$dependencias[$listaruser[$i]['iddependencia']]}</td>
				<td>{$areas[$listaruser[$i]['idarea']]}</td>
				{$estado}
				<td>{$listaruser[$i]['fecha']}</td>
				<td><button class='btn btn-sm btn-blood' onclick='anular({$listaruser[$i]['idsolicitud']})'>Anular</button></td>
				</td>
				";
			}
			
		}
	}
}
function ingresosoli($idsede,$sede,$iddependencia,$dependencia,$idarea,$area,$obs)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	if($_SESSION["conse"]>0)
	{
		if(tienePermiso(4))
		{
			$autoriza = $_SESSION["idusuweb"];
		}
		else
		{
			$autoriza = "0";
		}

		$solicitud = $obj->ingresosoli($_SESSION["conse"],$idsede,$sede,$iddependencia,$dependencia,$idarea,$area,$obs,$autoriza);
		$_SESSION["conse"]=0;
		echo json_encode($solicitud);
		
	}
	else
	{
		echo "No hay consecutivo";
		echo "NO SE ENVIO LA SOLICITUD!!!";		
	}
}
function consecutivo()
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	//srand (time());
	//$ale = rand(1,100); 
	$result= $obj->getNumConsecutivos()[0]["num"];
	$ale=$result;
	$result1= $obj->updateConsecutivo($ale)[0]["idconsecutivo"];
	return $result1;
}
function detalles($idprod,$cantidad,$entrega,$orden)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();

	if(!$_SESSION["conse"])
	{
		$_SESSION["conse"]=0;
	}
	if ($_SESSION["conse"]==0)
	{
		$_SESSION["conse"]=consecutivo();
	}
	
	$result= $obj->insertDetalle($idprod,$cantidad,$entrega);
	
	return $result;
}
function ingresoDetalle($idproducto, $cantidad, $fin, $idsede, $idarea)
{
	print_r($_POST);
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	echo $idproducto, $cantidad, $fin, $idsede, $idarea;
	//$inv = $obj->getInventario($idproducto, $idsede)[0];
	//print_r($inv);

	$resp=detalles($idproducto,$cantidad,$cantidad,0);
	echo '{"operacion":"ok","resultado":"'.$resp.'","fin":"'.$fin.'"}';
}
function validarPendiente($idsede, $idarea, $iddependencia, $idproducto)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$boj1 = $obj->getPendientes($idsede, $idarea, $iddependencia, $idproducto);
	// $boj1 = ["idsolicitud"=>1, "fecha"=>"2019-01-01", "pendiente"=>"1"];
	$pendientes=0;
	$salida="";
	while($boj1)
	{
		$salida=$salida."solicitud: ".$boj1["idsolicitud"]."fecha: ".$boj1["fecha"]."cantidad: ".$boj1["pendiente"]."\n";
	}
	echo $pendientes."-*-".$$salida;
}
function editarProducto($idProducto, $referencia, $descripcion, $estado)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$referencia = strtoupper($referencia);
	$descripcion = strtoupper($descripcion);
	$update = $obj->updateProducto($idProducto, $referencia, $descripcion, $estado);
	if($update == "existe")
	{
		echo "existe";
	}
	else
	{
		echo "ok";
	}
}
function datosProducto($id)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$datosProducto = $obj->getDatosProducto($id)[0];
	if($datosProducto)
	{
		echo json_encode($datosProducto);
	}
	else
	{
		echo "error";
	}
}
function buscarProductoConfiguracion($item, $tipo)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$item = strtoupper($item);
	$buscarP = $obj->getBuscarProductos($item, $tipo);
	if($buscarP)
	{
		foreach ($buscarP as $key => $value)
		{
			echo "<tr>";
			echo "<td>".$value["referencia"]."</td>";
			echo "<td>".$value["producto"]."</td>";
			echo "<td>".$value["estado"]."</td>";
			echo "<td><button class='btn btn-success' onclick='addItemCarritoC(".$value["idproducto"].")'>Agregar</button></td>";
			echo "</tr>";
		}
	}
	else
	{
		echo "<tr> <td colspan='4'>
		<div class='w-100 alert alert-danger alert-dismissible fade show' role='alert'>No se encontraron resultados
		<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></td> </tr>";
	}
}
function buscarProductoNuevaSol($tipo, $item, $dependencia)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$item = strtoupper($item);
	$buscarP = $obj->getBuscarProductosN($item, $tipo, $dependencia);
	if($buscarP)
	{
		foreach ($buscarP as $key => $value)
		{
			echo "<tr>";
			echo "<td>".$value["referencia"]."</td>";
			echo "<td>".$value["producto"]."</td>";
			echo "<td>".$value["estado"]."</td>";
			echo "<td><button class='btn btn-success' onclick='addItemCarritoN(".$value["idproducto"].")'>Agregar</button></td>";
			echo "</tr>";
		}
	}
	else
	{
		echo "<tr> <td colspan='4'>
		<div class='w-100 alert alert-danger alert-dismissible fade show' role='alert'>no hay productos habilitados para esta dependencia
		</div></td> </tr>";
	}
}
function buscarProducto($item, $tipo)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$item = strtoupper($item);
	$buscarP = $obj->getBuscarProductos($item, $tipo);
	// echo json_encode($buscarP);
	echo '<table class="table table-sm table-striped table-hover">
	<thead>
		<tr>
			<th scope="col" style="width: 20%;">Referencia</th>
			<th scope="col" >Descripción</th>
			<th scope="col" style="width: 15%;">Estado</th>
			<th scope="col" style="width: 10%;">Acciones</th>
		</tr>
	</thead>
	<tbody>';
	for ($i=0; $i < count($buscarP); $i++) { 
		echo "<tr id=item_".$buscarP[$i]['idproducto'].">
            <td>".$buscarP[$i]['referencia']."</td>
            <td>".$buscarP[$i]['producto']."</td>
            <td>".$buscarP[$i]['estado']."</td>
			<td>
				<button class='btn btn-blood btn-sm' onclick='editarProducto(".$buscarP[$i]['idproducto'].")'>Editar</button>
			</td>
        </tr>";
	}
	echo '</tbody>
	</table>';
	

}

function listarProductos()
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$listar = $obj->getProductos();
	// print_r(json_encode($listar));
	echo '<table class="table table-sm table-striped table-hover">
	<thead>
		<tr>
			<th scope="col" style="width: 20%;">Referencia</th>
			<th scope="col" >Descripción</th>
			<th scope="col" style="width: 15%;">Estado</th>
			<th scope="col" style="width: 10%;">Acciones</th>
		</tr>
	</thead>
	<tbody>';
	for ($i=0; $i < count($listar); $i++) { 
		echo "<tr id=item_".$listar[$i]['idproducto'].">
            <td>".$listar[$i]['referencia']."</td>
            <td>".$listar[$i]['producto']."</td>
            <td>".$listar[$i]['estado']."</td>
			<td>
				<button class='btn btn-blood btn-sm' onclick='editarProducto(".$listar[$i]['idproducto'].")'>Editar</button>
			</td>
        </tr>";
	}
	echo '</tbody>
	</table>';

}
function agregarProducto($referencia, $descripcion, $estado)
{
	// print_r($_POST);
	if(tienePermiso(3))
	{
		require_once "../../../general/objetos/solicitud_herramientas.php";
		$obj = new SolicitudHerramientas();
		$referencia = strtoupper($referencia);
		$descripcion = strtoupper($descripcion);
		$datos = $obj->setProductos($referencia, $descripcion, $estado);
		if($datos == "existe")
		{
			return "existe";
		}
		$sede = tienePermiso(3)['sedes'];
		$addinventarios = $obj->setInventarios($referencia, (INT)$sede);
	}
	if(is_numeric($datos[0]['idproducto']) && is_numeric($addinventarios[0]['idinventario']))
	{
		echo "ok";
	}
	else
	{
		echo "error";
	}

}
function cierreinventario()
{
	require_once "../../../general/objetos/inventarios.php";
	$inv = new Inventarios();
	$inv->getCierreInventario();
}
function limpiar($str)
{
	return preg_replace('([^A-Za-z0-9ñÑ])', '', $str);
}
function sesion($usu, $clave)
{
	$usu = limpiar($usu);
	$usu = strtoupper($usu);
	$base = new Bases('postg','plataforma_web');
	$sql = "select *,CURRENT_DATE AS fechaactual from empleados where alias = '$usu' and clave = '$clave' and anulado = 0";
	$rst = $base->cons($sql);
	$data = array("usuario"=>$usu);
	if(strlen($rst[0]["retiro"])>5)
	{
		$data = array("respuesta"=>"retirado");
	}
	else if($rst[0]["alias"]==$usu && $rst[0]["clave"]==$clave)
	{
		// unset($_SESSION["privi"]);
		$_SESSION["idusu"] = $rst[0]["idusuario"];
		//$_SESSION["usuweb"] = $rst["usuario"];  // PARACONSULTA DONANTES MIENTRAS SE SACA LOGIN EN HEXABAN
		$_SESSION["idusuweb"] = $rst[0]["idusuario"];
		$_SESSION["usu"] = $rst[0]["usuario"];
		$_SESSION["foto"] = $rst[0]["foto"];

		setPrivilegios();

		$sql = "INSERT INTO seguridad_ingresos(idusuario, fecha, hora, ip)VALUES (".$_SESSION["idusuweb"].", '".date("d-m-y")."', '".date("H:i:s")."', '".$_SERVER["REMOTE_ADDR"]."');";
		$base->cons($sql);
		cierreinventario();
		if($rst[0]["clave"]=="123")
		{
			$_SESSION["temppass"] = $rst[0]["clave"];
			$data ["respuesta"] = "caducado";
		}
		else if($rst[0]["fechacaduca"]<=$rst[0]["fechaactual"])
		{
			$_SESSION["temppass"] = $rst[0]["clave"];
			$data ["respuesta"] = "caducado";
		}
		else
		{
		 $data ["respuesta"] = $_SESSION["idusuweb"];
		}

		echo json_encode($data);
	}
	else
	{
		$data["respuesta"] = "error";
		echo json_encode($data);
	}
}
function validarSesion()
{
	if(!isset($_SESSION["idusuweb"])) {
		echo "no";
	}else{
		echo $_SESSION["idusuweb"];
		
	}
}
function getAreasSedesDependencias()
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$datos = $obj->getSedesAreasDependencias();
	echo "<option value='0' selected disabled>Seleccione una sede</option>" ;
	
	$sedesSinDuplicados = array();
	foreach ($datos as $key => $value) {
		if(!in_array($value['idsede'], $sedesSinDuplicados))
		{
			$sedesSinDuplicados[] = $value['idsede'];
			echo "<option sede='".$value['idsede']."' value='".$value['idsede']."'>".$value['sede']."</option>";
		}
	}
	echo "|";
	echo "<option value='0' selected disabled>Seleccione un área</option>";
	$areasSinDuplicados = array();
	foreach ($datos as $key => $value) {
		if(!in_array($value['idarea'], $areasSinDuplicados))
		{
			$areasSinDuplicados[] = $value['idarea'];
			echo "<option area='".$value['idarea']."' value='".$value['idarea']."'>".$value['area']."</option>";
		}
	}
	echo "|";
	echo "<option value='0' selected disabled>Seleccione una dependencia</option>";
	$banderaDependencia = 0;
	for($i=0;$i<count($datos);$i++)
	{
		if($banderaDependencia != $datos[$i]["iddependencia"])
		{
			echo "<option value='".$datos[$i]["iddependencia"]."'>".$datos[$i]["dependencia"]."</option>";
			$banderaDependencia = $datos[$i]["iddependencia"];
		}
	}
}
function setPrivilegios()
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$_SESSION["permisos"] = $obj->getPrivilegios();

}
function getSedes()
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$datos = $obj->getSedes();
	echo "<option value='0' selected disabled>Seleccione una sede</option>" ;
	foreach ($datos as $key => $value) {
		echo "<option value='".$value['idsede']."'>".$value['sede']."</option>";
	}
}
function inicio()
{
	getSedes();
	setPrivilegios();
}

