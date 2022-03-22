<?php
require_once "../../../base/clase_bases.php";


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
	case "buscarProductoNuevaSol":
	{
		buscarProductoNuevaSol($_POST["item"], $_POST["tipo"]);
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
		ingresosoli($_POST["idsede"], $_POST["iddependencia"], $_POST["idarea"], $_POST["obs"], "usuario",$_SESSION["idusu"],0);
		break;
	}
}
function ingresosoli($idsede,$iddepartamento,$idarea,$obs)
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	echo $_SESSION["conse"],$_SESSION["privi"];
	if($_SESSION["conse"]>0)
	{
		if($_SESSION["privi"]==1 or $_SESSION["privi"]==2)
		{
			$result= $obj->insertSolicitud($idsede,$iddepartamento,$idarea,$obs,$idusuario,$doc_origen,$orden);
			if($result)
			{
				echo "viene vacio";
				echo $result;
			}
			else
			{
				echo $result;
				echo "trae algo";
			}
		}
		
		$_SESSION["conse"]=0;
	}
	else
	{
		if($origen=="usuario")
		{
			echo "NO SE ENVIO LA SOLICITUD!!!";
		}
		
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

	if ($_SESSION["conse"]==0)
	{
		$_SESSION["conse"]=consecutivo();
	}
	
	$result= $obj->insertDetalle($idprod,$cantidad,$entrega);
	
	return $result;
}
function ingresoDetalle($idproducto, $cantidad, $fin, $idsede, $idarea)
{
	// print_r($_POST);
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$inv = $obj->getInventario($idproducto, $idsede)[0];
	// print_r($inv);
	if($inv)
	{
		$can = $inv["cantidad"];
		echo $can;
		echo $cantidad;
		if($can>=$cantidad)
		{
			$restar=$obj->updateInventario($cantidad,$inv["referencia"],$inv["bodega"]);
			$resp=detalles($idproducto,$cantidad,$cantidad,0);
			echo '{"operacion":"ok","resultado":"'.$resp.'","fin":"'.$fin.'"}';
		}else{
			if($can>0)
			{
				$resinv=updateInventario($can,$inv["referencia"],$inv["bodega"]);
				$resp=detalles($idproducto,$cantidad,$can,0);
				echo '{"operacion":"pen","resultado":"'.$resp.'","fin":"'.$fin.'"}';
			}
			else
			{
				$resp=detalles($idproducto,$cantidad,0,0);
				echo '{"operacion":"fal","resultado":"'.$resp.'","fin":"'.$fin.'"}';
			}
		}
	}
	else
	{
		echo "No existe inventario";
		
	}
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
	if($update)
	{
		echo "error";
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
function buscarProductoNuevaSol($item, $tipo)
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
			echo "<td><button class='btn btn-success' onclick='addItemCarritoN(".$value["idproducto"].")'>Agregar</button></td>";
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
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$referencia = strtoupper($referencia);
	$descripcion = strtoupper($descripcion);
	$datos = $obj->setProductos($referencia, $descripcion, $estado);
	if($datos)
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

		require_once "../../../general/objetos/solicitud_herramientas.php";
		$obj = new SolicitudHerramientas();
		$privilegios = $obj->getPrivilegios($rst[0]["idusuario"]);
		print_r($privilegios);
		if(count($privilegios)>0)
		{
			for ($i=0; $i < count($privilegios) ; $i++) { 
				if($privilegios[$i]["privilegio"] == 1 || $privilegios[$i]["privilegio"] == 2)
				{
					$_SESSION["privi"] = $privilegios[$i]["privilegio"];
				}
			}
		}

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
		echo "no";
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
// function getSedes()
// {
// 	require_once "../../../general/objetos/solicitud_herramientas.php";
// 	$obj = new SolicitudHerramientas();
// 	$sedes = $obj->getSedes();
// 	echo "<option value='0' selected disabled>Seleccione una sede</option>";
// 	for ($i=0; $i < count($sedes); $i++) { 
// 		echo "<option value='".$sedes[$i]["idsede"]."'>".$sedes[$i]["sede"]."</option>";
// 	}
	
// }
function getAreasSedesDependencias()
{
	require_once "../../../general/objetos/solicitud_herramientas.php";
	$obj = new SolicitudHerramientas();
	$datos = $obj->getSedesAreasDependencias();
	echo "<option value='0' selected disabled>Seleccione una sede</option>";
	for($i=0;$i<count($datos);$i++)
	{
		echo "<option value='".$datos[$i]["idsede"]."'>".$datos[$i]["sede"]."</option>";
	}
	echo "|";
	echo "<option value='0' selected disabled>Seleccione un área</option>";
	$banderaArea = 0;
	for($i=0;$i<count($datos);$i++)
	{
		if($banderaArea != $datos[$i]["idarea"])
		{
			echo "<option value='".$datos[$i]["idarea"]."'>".$datos[$i]["area"]."</option>";
			$banderaArea = $datos[$i]["idarea"];
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
function inicio()
{
	getAreasSedesDependencias();
}

