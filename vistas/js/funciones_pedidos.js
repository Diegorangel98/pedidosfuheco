$(document).ready(inicializarEventos);

function inicializarEventos()
{
	inicio();
}
let idusua;
let sedesN;
let areasN;
let dependenciasN;
let sedesC;
let areasC;
let dependenciasC;
let btnModalAgregarProducto;
let btnModalNuevaSolicitud;
let btnAgregarProducto;
let btnEditarProducto;
let btnBuscarDescripcionP;
let btnBuscarReferenciaP;
let modalAgregarProducto;
let modalEditarProducto;
let modalNuevaSolicitud;
let modalBuscarProductoN;
let addReferencia;
let addDescripcion;
let editReferencia;
let editDescripcion;
let addEstado;
let editEstado;
let listaProductos;
let btnListarAll;
let item_solicitudes;
let item_configuracion;
let item_compras_producto;
let item_compras_pendiente;
let item_almacen;
let item_firma_digital;
let item_salidas;
let divSolicitudes;
let divListadoSolicitudes;
let divConfiguracion;
let divComprasProducto;
let divComprasPendiente;
let divAlmacen;
let divFirmaDigital;
let divSalidas;
let inputBuscarProducto;
let editIdProducto;
let btnBuscarProductoN;
let btnAddItemCarrito;
let buscarProductoN;
let breferencia;
let bdescripcion;
let tbodyBuscarProductoN;
let detalleTempProductoN;
let btnVolverSelectSolicitud;
let idProductoTemp;
let idproductoTempN;
let cantidadProductoN;
let btnConfirmarSolicitudN;
var pedido = new Array();
pedido[0]= new Array ('id','DESCRIPCION DEL PRODUCTO','CANTIDAD');
let item = 0;
let eliminados=0;
/*  */

/*  */
function validarSesion()
{
	$.post("./php/funciones_pedidos.php",{op: "validarSesion"}, (x)=>{
		//console.log(x);
		if(x == "no")
		{
			idusua.val("");
			Swal.fire({
				title: "Error",
				text: "No se ha iniciado sesión",
				icon: "error",
				confirmButtonText: "Aceptar"
			});

			// login en swalert2
			Swal.fire({
				title: 'Iniciar sesión',
				icon: "warning",
				html: `<input type="text" id="login" class="swal2-input" placeholder="Username">
				<input type="password" id="password" class="swal2-input" placeholder="Password">`,
				confirmButtonText: 'Iniciar sesión',
				confirmButtonColor: '#000',
				showCancelButton: true,
				focusConfirm: false,
				preConfirm: () => {
				  const login = Swal.getPopup().querySelector('#login').value
				  const password = Swal.getPopup().querySelector('#password').value
				  if (!login || !password) {
					Swal.showValidationMessage(`Por favor ingrese su usuario y contraseña`)
				  }else{

				  }
				  return { login: login, password: password }
				}
			  }).then((result) => {
				  console.log(result);
				if (result.isDismissed) {
					console.log("Cancelado");
				}else{
				  console.log("enviar validacion php");
				  	$.ajax({
					url: "./php/funciones_pedidos.php",
					type: "POST",
					data: {
						op: "sesion",
						login: result.value.login,
						password: result.value.password
					},
					success: function(data)
					{
						console.log(data);
						data = JSON.parse(data); 
						if(data.respuesta == "caducado")
						{
							console.log("caducado");

							window.open("../../cambio.php","popup", "Cambio de clave");

						}else if(!data.respuesta.isNaN)
						{
							idusua.val(data.respuesta);
							console.log("inicio sesion");
						}
						else
						{
							Swal.fire({
								title: "Error",
								text: "Usuario o contraseña incorrectos",
								icon: "error",
								confirmButtonText: "Aceptar"
							});
						} 
					}
					});
				}
			  })
		}else{
			idusua.val(x);
		}
	});
}
function editarProducto(id)
{
	$.post("./php/funciones_pedidos.php",{op: "datosProducto", idProducto: id}, (x)=>{
		if(x != "error")
		{
			x = JSON.parse(x);
			editIdProducto.val(x.idproducto);
			editReferencia.val(x.referencia);
			editDescripcion.val(x.producto);
			if(x.estado == "Activo")
			{
				editEstado.prop("checked", true);
			}else{
				editEstado.prop("checked", false);
			}
			modalEditarProducto.modal("show");
		}else{
			Swal.fire({
				title: "Error",
				text: "No se pudo obtener los datos del producto",
				icon: "error",
				confirmButtonText: "Aceptar"
			});
		}
	});
}
function salvarEditarProducto()
{
	if(editIdProducto.val() != "" && editReferencia.val() != "" && editDescripcion.val() != "")
	{
		let estadoEdit;
		if(editEstado.is(":checked"))
		{
			estadoEdit = "Activo";
		}else{
			estadoEdit = "Inactivo";
		}
		$.post("./php/funciones_pedidos.php",{op: "editarProducto", idProducto: editIdProducto.val(), referencia: editReferencia.val(), producto: editDescripcion.val(), estado: estadoEdit}, (x)=>{
			if(x == "ok")
			{
				Swal.fire({
					title: "Correcto",
					text: "Producto editado correctamente",
					icon: "success",
					confirmButtonText: "Aceptar"
				});
				modalEditarProducto.modal("hide");
				listarProductos();
			}else{
				Swal.fire({
					title: "Error",
					text: "No se pudo editar el producto",
					icon: "error",
					confirmButtonText: "Aceptar"
				});
			}
		});
	}else{
		Swal.fire({
			title: "Error",
			text: "Por favor complete todos los campos",
			icon: "error",
			confirmButtonText: "Aceptar"
		});
	}
}
function listarProductos()
{
	$.post("./php/funciones_pedidos.php",{op: "listarProductos"}, (x)=>{
		listaProductos.html(x);
	});
}
function addItemCarritoN(id)
{
	modalBuscarProductoN.modal("hide");
	modalNuevaSolicitud.modal("show");
	$.post("./php/funciones_pedidos.php",{op: "datosProducto", idProducto: id}, (x)=>{
		if(x != "error")
		{
			x = JSON.parse(x);
			console.log(x);
			buscarProductoN.val(x.producto);
			idproductoTempN.val(x.idproducto);
			
		}else{
			Swal.fire({
				title: "Error",
				text: "No se pudo obtener los datos del producto",
				icon: "error",
				confirmButtonText: "Aceptar"
			});
		}

	});

}
function agregarProducto()
{
	if(addReferencia.val() == "" || addDescripcion.val() == "")
	{
		Swal.fire({
			title: "Error",
			text: "Por favor ingrese todos los datos",
			icon: "error",
			confirmButtonText: "Aceptar"
		});
	}else{
		let estado;
		if( addEstado.prop('checked') ) {
			estado = "Activo";
		}else{
			estado = "Inactivo";
		}
		$.post("./php/funciones_pedidos.php",{op: "agregarProducto", referencia: addReferencia.val(), descripcion: addDescripcion.val(), estado: estado}, (x)=>{
			// console.log(x);
			if(x == "ok")
			{
				Swal.fire({
					title: "Exito",
					text: "Producto agregado",
					icon: "success",
					confirmButtonText: "Aceptar"
				});
				modalAgregarProducto.modal("hide");
				addReferencia.val("");
				addDescripcion.val("");
				listarProductos();
			}else{
				Swal.fire({
					title: "Error",
					text: "Producto no agregado",
					icon: "error",
					confirmButtonText: "Aceptar"
				});
			}
		});
	}

}
function agregar_item()
{
	$.post("./php/funciones_pedidos.php",{op:"validarPendiente",idsede: sedesN.val(),idarea: areasN.val(),iddependencia: dependenciasN.val(), idproducto: idproductoTempN.val()},(x)=>{ 
		var temp=x.split("-*-");
		if(temp[0]==0)
		{
			item++;
			pedido[item]= new Array (idproductoTempN.val(), buscarProductoN.val(), cantidadProductoN.val(),item,'ver');
			buscarProductoN.val("");
			idproductoTempN.val(0);
			cantidadProductoN.val(0);
			buscarProductoN.focus();
			refrescarpedido();
		}
		else
		{
			alert("Del producto: " + $("#producto").val()+", tiene pendiente:\n\n"+temp[1]);
		}
		if(item>0)
		{
			$("#carritoSolicitud").show();
		}
	});
}
function ingresosoli()
{
	$.post("./php/funciones_pedidos.php",{"op":"ingresosoli","idsede":sedesN.val(),"iddependencia":dependenciasN.val(),"idarea":areasN.val(),"obs":"obs"},(x)=>{
		console.log(x);
	});
}
function confirmar()
{
	
	if(item>eliminados)
	{
		Swal.fire({
			title: 'Desea Guardar este pedido?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Guardar'
		  }).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
					title: 'Desea agregar una observacion?',
					input: 'text',
					inputAttributes: {
					  autocapitalize: 'off'
					},
					showCancelButton: true,
					cancelButtonText: 'No',
					confirmButtonText: 'Guardar observacion',
					allowOutsideClick: false,
					showLoaderOnConfirm: false,
				  }).then((result) => {
					if (result.isConfirmed) {
						console.log("isConfirmed");
						for(x=1;x<=item;x++)
						{
							console.log("entro al for");
							if(pedido[x][4]=="ver")
							{
								console.log("entro al if");
								idpro=pedido[x][0];
								cantidad=pedido[x][2];
								//alert("vamos a inGresar el detalle No.="+x);
								console.log(item);
								console.log(x);
								if(item==x){ok="si";}else{ok="no";}
								console.log("ok: "+ok);

								$.post("./php/funciones_pedidos.php",{"op":"ingresoDetalle","idprod":idpro,"cantidad":cantidad,"fin":ok,"idsede":sedesN.val(),"idarea":areasN.val()},(x)=>{
									console.log("entro al get");
									console.log("x: "+x);
									if(x.fin = "si"){
										console.log("se envio a ingreso soli");
										ingresosoli();}
								});
								console.log("salio del get");
							}
							console.log("salio del if");
						}
						console.log("salio del for");
						item=0;
						eliminados=0;
						refrescarpedido();
					}else{
						Swal.fire({
							title: "Guardando sin observacion",
						  })
					}
				  })
			}
		  })
		/* if(confirm("Desea guardar este pedido???"))
		{
			obs=prompt("Desea digitar una Observacion...");
			$("#espere").fadeTo("show",0.5);
			$("#procesando").fadeIn();
			for(x=1;x<=item;x++)
			{
				if(pedido[x][4]=="ver")
				{
					idpro=pedido[x][0];
					cantidad=pedido[x][2];
					//alert("vamos a inGresar el detalle No.="+x);
					if(item==x){ok="si";}else{ok="no";}
					$.getJSON("funciones_pedidos.php",{"op":"ingresodetalles","idprod":idpro,"cantidad":cantidad,"fin":ok,"idsede":$("#sedes").val(),"idarea":$("#areas").val()},respuesta_ingresodetalles);
				}
			}
			item=0;
			eliminados=0;
			$("#sedes").attr("disabled",false);
			$("#departamentos").attr("disabled",false);
			$("#areas").attr("disabled",false);
		} */
	}
	else
	{
		alert("Debe ingresar al menos un producto...");
		$("#producto").focus();
	}
}
function eliminaritem(eli)
{
	Swal.fire({
		title: "Esta seguro que quiere eliminar \n" + pedido[eli][1]+"?",
		showDenyButton: false,
		showCancelButton: true,
		confirmButtonText: 'Eliminar',
	  }).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
			pedido[eli][4]='no';
			eliminados++;
			refrescarpedido();
		  Swal.fire('Eliminado con exito!', '', 'success')
		}
	  })
}
function refrescarpedido()
{
	var ver='<table border="1">';
	// console.log(item);
	// console.log(pedido);
	for(x=1;x<=item;x++)
	{
		if(pedido[x][4]=='ver')
		{
			ver=ver+'<tr><td>'+pedido[x][1]+'</td><td>'+pedido[x][2]+'</td><td><button type="button" class="btn btn-outline-red" onclick="eliminaritem('+pedido[x][3]+')"><i class="i-trash"></i></button></td><tr>';
		}
	}
	
	ver=ver+'</table>';
	$("#tbodySolicitudN").html(ver);
}
function hideInicio()
{
	divSolicitudes.hide();
	divListadoSolicitudes.show();
	divConfiguracion.hide();
	divComprasProducto.hide();
	divComprasPendiente.hide();
	divAlmacen.hide();
	divFirmaDigital.hide();
	divSalidas.hide();
}
function inicio()
{
	idusua = $("#idusua");
	sedesN = $("#sedesN");
	areasN = $("#areasN");
	dependenciasN = $("#dependenciasN");
	sedesC = $("#sedesC");
	areasC = $("#areasC");
	dependenciasC = $("#dependenciasC");
	btnAgregarProducto = $("#btnAgregarProducto");
	btnEditarProducto = $("#btnEditarProducto");
	btnModalAgregarProducto = $("#btnModalAgregarProducto");
	modalAgregarProducto = $("#modalAgregarProducto");
	modalEditarProducto = $("#modalEditarProducto");
	modalEditarProducto = $("#modalEditarProducto");
	modalNuevaSolicitud = $("#modalNuevaSolicitud");
	modalBuscarProductoN = $("#modalBuscarProductoN");
	btnModalNuevaSolicitud = $("#btnModalNuevaSolicitud");
	addReferencia = $("#addReferencia");
	addDescripcion = $("#addDescripcion");
	addEstado = $("#addEstado");
	editReferencia = $("#editReferencia");
	editDescripcion = $("#editDescripcion");
	editEstado = $("#editEstado");
	listaProductos = $("#listaProductos");
	btnListarAll = $("#btnListarAll");
	btnBuscarDescripcionP = $("#btnBuscarDescripcionP");
	btnBuscarReferenciaP = $("#btnBuscarReferenciaP");
	item_solicitudes = $("#item_solicitudes");
	item_configuracion = $("#item_configuracion");
	item_compras_producto = $("#item_compras_producto");
	item_compras_pendiente = $("#item_compras_pendiente");
	item_almacen = $("#item_almacen");
	item_firma_digital = $("#item_firma_digital");
	item_salidas = $("#item_salidas");
	divSolicitudes = $("#divSolicitudes");
	divListadoSolicitudes = $("#divListadoSolicitudes");
	divConfiguracion = $("#divConfiguracion");
	divComprasProducto = $("#divComprasProducto");
	divComprasPendiente = $("#divComprasPendiente");
	divAlmacen = $("#divAlmacen");
	divFirmaDigital = $("#divFirmaDigital");
	divSalidas = $("#divSalidas");
	inputBuscarProducto = $("#inputBuscarProducto");
	editIdProducto = $("#editIdProducto");
	btnBuscarProductoN = $("#btnBuscarProductoN");
	buscarProductoN = $("#buscarProductoN");
	breferencia = $("#breferencia");
	bdescripcion = $("#bdescripcion");
	tbodyBuscarProductoN = $("#tbodyBuscarProductoN");
	detalleTempProductoN = $("#detalleTempProductoN");
	btnAddItemCarrito = $("#btnAddItemCarrito");
	btnVolverSelectSolicitud = $("#btnVolverSelectSolicitud");
	idproductoTempN = $("#idproductoTempN");
	cantidadProductoN = $("#cantidadProductoN");
	btnConfirmarSolicitudN = $("#btnConfirmarSolicitudN");
	
	$("#carritoSolicitud").hide();
	validarSesion();
	hideInicio();
	divSolicitudes.show();
	listarProductos();
	$.post("./php/funciones_pedidos.php",{op: "inicio"}, (x)=>{
		// console.log(x);
		let datosSedes = x.split("|");
		sedesN.html(datosSedes[0]);
		sedesC.html(datosSedes[0]);
		areasN.html(datosSedes[1]);
		areasC.html(datosSedes[1]);
		dependenciasN.html(datosSedes[2]);
		dependenciasC.html(datosSedes[2]);
		// console.log(datosSedes);
	});
	btnModalNuevaSolicitud.click(()=>{
		modalNuevaSolicitud.modal("show");
	});
	btnBuscarProductoN.click(()=>{
		let tipoBusqueda;
		if(breferencia.prop('checked')){
			tipoBusqueda = "referencia";
		}else if(bdescripcion.prop('checked')){
			tipoBusqueda = "producto";
		}
		$.post("./php/funciones_pedidos.php",{op: "buscarProductoNuevaSol", tipo: tipoBusqueda, item: buscarProductoN.val()}, (x)=>{
			modalNuevaSolicitud.modal("hide");
			modalBuscarProductoN.modal("show");
			tbodyBuscarProductoN.html(x);
		});
	});
	btnAddItemCarrito.click(()=>{
		if(idproductoTempN.val() != "" && idproductoTempN.val() > 0){
			console.log("hay id");
			if(cantidadProductoN.val() > 0){
				console.log("hay cantidad");
				agregar_item();
			}else{
			Swal.fire({
				icon: 'error',
				type: 'error',
				title: 'Oops...',
				text: 'La cantidad debe ser mayor a 0'
			});
			}
		}else{
			console.log("no hay id");
			Swal.fire({
				icon: 'error',
				type: 'error',
				title: 'Oops...',
				text: 'Seleccione un producto'
			});
		}
	});
	btnVolverSelectSolicitud.click(()=>{
		modalBuscarProductoN.modal("hide");
		modalNuevaSolicitud.modal("show");
	});

	$(".nav_only").click(function(){
		hideInicio();
		let padre;
		if($(this).attr("padre"))
		{
			padre = $(this).attr("padre");
			$("#"+padre).show();
		}else{
			console.log("no tiene atributo padre.");
		}
	});
	btnConfirmarSolicitudN.click(confirmar);

	btnModalAgregarProducto.click(()=>{
		// console.log("click");
		modalAgregarProducto.modal("show");
	});
	btnListarAll.click(listarProductos);
	btnAgregarProducto.click(agregarProducto);
	$(".nav-item").click(function(){
		$(".nav-item").removeClass("active");
		$(this).addClass("active");
	});
	
	btnEditarProducto.click(salvarEditarProducto);
	btnBuscarDescripcionP.click(()=>{
		$.post("./php/funciones_pedidos.php",{op: "buscarProducto", item: inputBuscarProducto.val(), tipo: "producto"}, (x)=>{
			// console.log(x);
			listaProductos.html(x);
		});
	});
	btnBuscarReferenciaP.click(()=>{
		$.post("./php/funciones_pedidos.php",{op: "buscarProducto", item: inputBuscarProducto.val(), tipo: "Referencia"}, (x)=>{
			// console.log(x);
			listaProductos.html(x);
		});
	});
}
