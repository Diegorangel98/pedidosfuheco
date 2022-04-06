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
let areasB;
let dependenciasB;
let sedesB;
let areasC;
let dependenciasC;
let btnModalAgregarProducto;
let btnModalNuevaSolicitud;
let btnAgregarProducto;
let btnEditarProducto;
let btnBuscarDescripcionP;
let btnBuscarReferenciaP;
let btnBuscarSolicitud;
let modalAgregarProducto;
let modalEditarProducto;
let modalNuevaSolicitud;
let modalBuscarProductoN;
let modalBuscarSolicitudN;
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
let btnBuscarProductoDependencia;
let btnAddItemCarrito;
let btnModalBuscarSolicitudN;
let btnAgregarProductoDependencia;
let buscarProductoN;
let breferencia;
let breferenciaDependencia;
let bdescripcionDependencia;
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
let permisos = new Array();
let listaSolicitudes;
let inputBuscarProductoDependencia;
let modalBuscarProductoC;
let tbodyBuscarProductoC;
let idproductoC;
let sedeAlmacen;
let modalDetalleSolicitudAlmacen;
let bodyModalDetalleSolAlmacen;
let modalAjustarCantidad;
let bodyAjustarCantidad;
let cantidadActual;
let nuevaCantidad;
let btnActualizarCantidad;
let btnHacerSalida;
let nombreQuienCreaSol;
let fechaCreaSol;
let horaCreaSol;
let sedesCompras;
let listaSolicitudesCompras;
let modalSolicitudAtendida;
let bodyAtenderSolicitud;
let btnAtenderSolicitud;
let listarProductosConfig;	
let nombreQuienautoSol;
let modalAutorizarSolicitud;
let bodyAutorizarSolicitud;
let modalAjustarcantidadAutorizar;
let cantidadActualSolicitada;
let nuevaCantidadSolicitada;
let iddetalleajustar;
let btnAjustarCantAutorizar;
let btnAtutorizarSolicitud;
let numeroSolicitudB;
let desdeBuscar;
let hastaBuscar;
/*  */

/*  */
function validarSesion()
{
	$.post("./php/funciones_pedidos.php",{op: "validarSesion"}, (x)=>{
		if(x == "no")
		{
			idusua.val("");
			Swal.fire({
				title: "Error",
				text: "No se ha iniciado sesión",
				icon: "error",
				confirmButtonText: "Aceptar"
			});
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
				if (result.isDismissed) {
					location.reload();
				}else{
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
						data = JSON.parse(data);
						if(data.respuesta == "error")
						{
							Swal.fire({
								title: "Error",
								text: "Usuario o contraseña incorrectos",
								icon: "error",
								confirmButtonText: "Aceptar"
							}).then(()=>{
								location.reload();
							});

						}
						if(data.respuesta == "caducado")
						{
							window.open("../../cambio.php","popup", "Cambio de clave");
						}else if(!data.respuesta.isNaN)
						{
							idusua.val(data.respuesta);
							location.reload();
						}
						else
						{
							Swal.fire({
								title: "Error",
								text: "Usuario o contraseña incorrectos",
								icon: "error",
								confirmButtonText: "Aceptar"
							}).then(()=>{
								location.reload();
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
			}else if (x == "existe"){
				Swal.fire({
					title: "La referencia del producto ya existe",
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
function addItemCarritoC(id)
{
	modalBuscarProductoC.modal("hide");
	$.post("./php/funciones_pedidos.php",{op: "datosProducto", idProducto: id}, (x)=>{
		if(x != "error")
		{
			x = JSON.parse(x);
			inputBuscarProductoDependencia.val(x.producto);
			idproductoC.val(x.idproducto);
			
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
					title: "La referencia del producto ya existe",
					text: "Producto no agregado, intente con otra referencia",
					icon: "error",
					confirmButtonText: "Aceptar"
				});
			}
		});
	}

}
function agregar_item()
{
	// $.post("./php/funciones_pedidos.php",{op:"validarPendiente",idsede: sedesN.val(),idarea: areasN.val(),iddependencia: dependenciasN.val(), idproducto: idproductoTempN.val()},(x)=>{ 
	// 	var temp=x.split("-*-");
	// 	if(temp[0]==0)
	// 	{
			
	// 	}
	// 	else
	// 	{
	// 		alert("Del producto: " + $("#producto").val()+", tiene pendiente:\n\n"+temp[1]);
	// 	}
		item++;
			pedido[item]= new Array (idproductoTempN.val(), buscarProductoN.val(), cantidadProductoN.val(),item,'ver');
			buscarProductoN.val("");
			idproductoTempN.val(0);
			cantidadProductoN.val(0);
			buscarProductoN.focus();
			refrescarpedido();
		if(item>0)
		{
			$("#carritoSolicitud").show();
		}
	// });
}
function ajustarCantidadAutorizar(detalle, cantidad) {
	modalAutorizarSolicitud.modal("hide");
	cantidadActualSolicitada.text(cantidad);
	nuevaCantidadSolicitada.val(cantidad);
	iddetalleajustar.val(detalle);
	modalAjustarcantidadAutorizar.modal("show");	
}
function autorizar(idsol)
{

	modalAutorizarSolicitud.modal("show");
	$.post("./php/funciones_pedidos.php",{op: "detallesAutorizar", idsolicitud: idsol}, (x)=>{
		bodyAutorizarSolicitud.html(x);
	});
}
function ingresosoli(obs)
{
	$.post("./php/funciones_pedidos.php",{"op":"ingresosoli","idsede":sedesN.val(), sede: $('#sedesN  option:selected').text(),"iddependencia":dependenciasN.val(),dependencia: $('#dependenciasN  option:selected').text(),"idarea":areasN.val(), area: $('#areasN  option:selected').text(),"obs":obs},(x)=>{
		Swal.fire({
			title: "Solicitud ingresada",
			text: "el numero de la solicitud es: "+x.idsolicitud,
			icon: "success",
			confirmButtonText: "Aceptar"
		});
	}, 'json');
	listarSolicitudes();
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
				modalNuevaSolicitud.modal("hide");
				Swal.fire({
					title: 'Desea agregar una observacion?',
					html: '<input id="obs" class="form-control" type="text" placeholder="Observacion">',
					inputAttributes: {
					  autocapitalize: 'off'
					},
					preConfirm: () => {
					const obs = Swal.getPopup().querySelector('#obs').value;
					return {obs: obs};
					},
					showCancelButton: false,
					confirmButtonText: 'Guardar observacion',
					showLoaderOnConfirm: false,
				  }).then((result) => {
					if (result.isConfirmed) {
						for(x=1;x<=item;x++)
						{
							if(pedido[x][4]=="ver")
							{
								idpro=pedido[x][0];
								cantidad=pedido[x][2];
								if(item==x){ok="si";}else{ok="no";}
								$.post("./php/funciones_pedidos.php",{"op":"ingresoDetalle","idprod":idpro,"cantidad":cantidad,"fin":ok,"idsede":sedesN.val(),"idarea":areasN.val()},(x)=>{
								});
								if(ok == "si"){
									ingresosoli(`${result.value.obs}`);}

							}
						}
						item=0;
						eliminados=0;
						refrescarpedido();
					}
				})
			}
		})
	}
	else
	{
		Swal.fire({
			title: 'Debe ingresar al menos un producto...',
			icon: 'warning',
			showCancelButton: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar'
		});
		$("#producto").focus();
	}
}
function detallesSolicitudAlmacen(idsol)
{
	$.post("./php/funciones_pedidos.php",{op: "detallesSolicitudAlmacen", idsolicitud: idsol}, (x)=>{
		bodyModalDetalleSolAlmacen.html(x);
		modalDetalleSolicitudAlmacen.modal("show");
	});
}
function ajustarCantidad(iddetalle, cantidad)
{
	
	cantidadActual.html(cantidad);
	$("#idProdNewCant").val(iddetalle);
	modalDetalleSolicitudAlmacen.modal("hide");
	modalAjustarCantidad.modal("show");
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
function listarSolicitudes()
{
	$.post("./php/funciones_pedidos.php",{"op":"listarsolicitudes"},(x)=>{
		listaSolicitudes.html(x);
	});
}
function clickSolicitud(idsolicitud)
{
	$(".tr-item").removeClass("active");
	$("#tr-item-"+idsolicitud).addClass("active");
	$.post("./php/funciones_pedidos.php",{op: "detallesSolicitud", idsolicitud: idsolicitud}, (x)=>{
		x = JSON.parse(x);
		nombreQuienCreaSol.text(x.crea);
		nombreQuienautoSol.text(x.auto);
	});
}
function buscarSolicitud()
{

}
function anular(idsol) {
	Swal.fire({
		title: 'Desea anular esta solicitud?',
		text: "Esta accion no se puede deshacer",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, anular!'
	}).then((result) => {	
		if (result.isConfirmed) {
			$.post("./php/funciones_pedidos.php",{op: "anularSolicitud", idsolicitud: idsol}, (x)=>{
				if(x=="ok")
				{
				listarSolicitudes();
				Swal.fire('Anulado con exito!', '', 'success')
				}
			});
		}
	  });
}
function anularProductoConfig(x)
{
	$.post("./php/funciones_pedidos.php",{op: "anularProductoConfig", iddepprod: x}, (x)=>{
		if(x != "error")
		{
			Swal.fire({
				title: 'Permisos quitados con exito',
				icon: 'success',
				confirmButtonText: 'Aceptar'
			  }).then((result) => {
				if (result.isConfirmed) {
					listarProductosConfiguracion(x);
				}
			  })
		}
	});
}
function GuardarCantidadAutorizar()
{
	console.log("nueva cantidad: "+nuevaCantidadSolicitada.val()+" cantidad actual: "+Number(cantidadActualSolicitada.text()));
	if(nuevaCantidadSolicitada.val() > Number(cantidadActualSolicitada.text()))
	{
		Swal.fire({
			title: 'Solamente puede disminuir la cantidad',
			text: 'La cantidad actual es de '+cantidadActualSolicitada.text(),
			icon: 'warning',
			confirmButtonText: 'Aceptar'
		});
	}else{
		if(nuevaCantidadSolicitada.val() < 0)
		{
			Swal.fire({
				title: 'La cantidad no puede ser 0',
				text: 'La cantidad actual es de '+cantidadActualSolicitada.text(),
				icon: 'warning',
				confirmButtonText: 'Aceptar'
			});
		}else{
			console.log("iddetalle "+$("#iddetalleajustar").val());
			$.post("./php/funciones_pedidos.php",{op: "actualizarCantidadAutorizar", idproducto: $("#iddetalleajustar").val(), cantidad: nuevaCantidadSolicitada.val()}, (x)=>{
				console.log("x: "+x);
				if(x == "error")
				{
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Algo salio mal!',
						footer: 'Intente de nuevo'
					});
				}else{
					
					autorizar(x);
					modalAjustarcantidadAutorizar.modal("hide");
					modalAutorizarSolicitud.modal("show");
					Swal.mixin({
						toast:true,
						showConfirmButton: false,
						timer: 3000,
						position: 'top-end',
						timerProgressBar: true,
					}).fire({
						icon: 'success',
						title: 'Se actualizo la cantidad'
					});
				}
				nuevaCantidadSolicitada.val("");
			});

		}
	}
}
function listarProductosConfiguracion(iddependencia)
{
	$.post("./php/funciones_pedidos.php",{"op":"listarProductosConfig", iddependencia: iddependencia},(x)=>{
		listarProductosConfig.html(x);
	});
}
function atenderSolicitud(idsol)
{
	if($("#numhelisa").val()=="")
	{
		Swal.fire({
			title: "Debe ingresar el numero de helisa",
			icon: 'warning',
			showCancelButton: false,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if (result.isConfirmed) {
				$("#numhelisa").focus()
			}else if(result.isDismissed){
				$("#numhelisa").focus()
			}
		})
	}else{
		$.post("./php/funciones_pedidos.php",{op: "atenderSolicitud", idsolicitud: idsol, numhelisa: $("#numhelisa").val()}, (x)=>{
			if(x=="error")
			{
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'No se pudo atender la solicitud'
				})
			}else{
				Swal.fire({
					type: 'success',
					icon: 'success',
					title: 'Solicitud atendida',
					text: 'Se ha atendido la solicitud '+x+' con exito'
				}).then((result) => {
					if (result.isConfirmed) {
						modalSolicitudAtendida.modal("hide");
					}
				});
			}
						listarSolicitudesCompras(sedesCompras.val());
		});
	}
}
function FinalizarCompra(id)
{
	$.post("./php/funciones_pedidos.php",{op: "finalizarCompra", idsolicitud: id}, (x)=>{
		bodyAtenderSolicitud.html(x);
		modalSolicitudAtendida.modal("show");
	});
}
function listarSolicitudesCompras(sede)
{
	$.post("./php/funciones_pedidos.php",{op: "listarSolicitudesCompras", sede: sede}, (x)=>{
		listaSolicitudesCompras.html(x);
	});
}
function refrescarpedido()
{
	var ver='<table border="1">';
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
function isNumber(evt)
{
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	return false;
}
	return true;
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
	
	areasC.attr("disabled",true);
	dependenciasC.attr("disabled",true);
	btnAgregarProductoDependencia.attr("disabled",true);
}
function inicio()
{
	idusua = $("#idusua");
	sedesN = $("#sedesN");
	areasN = $("#areasN");
	dependenciasN = $("#dependenciasN");
	sedesB = $("#sedesB");
	areasB = $("#areasB");
	dependenciasB = $("#dependenciasB");
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
	btnAgregarProductoDependencia = $("#btnAgregarProductoDependencia");
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
	listaSolicitudes = $("#listaSolicitudes");
	modalBuscarSolicitudN = $("#modalBuscarSolicitudN");
	btnModalBuscarSolicitudN = $("#btnModalBuscarSolicitudN");
	btnBuscarSolicitud = $("#btnBuscarSolicitud");
	btnBuscarProductoDependencia = $("#btnBuscarProductoDependencia");
	modalBuscarProductoC = $("#modalBuscarProductoC");
	inputBuscarProductoDependencia = $("#inputBuscarProductoDependencia");
	breferenciaDependencia = $("#breferenciaDependencia");
	bdescripcionDependencia = $("#bdescripcionDependencia");
	tbodyBuscarProductoC = $("#tbodyBuscarProductoC");
	idproductoC = $("#idproductoC");
	sedeAlmacen = $("#sedeAlmacen");
	modalDetalleSolicitudAlmacen = $("#modalDetalleSolicitudAlmacen");
	bodyModalDetalleSolAlmacen = $("#bodyModalDetalleSolAlmacen");
	modalAjustarCantidad = $("#modalAjustarCantidad");
	bodyAjustarCantidad = $("#bodyAjustarCantidad");
	cantidadActual = $("#cantidadActual");
	nuevaCantidad = $("#nuevaCantidad");
	btnActualizarCantidad = $("#btnActualizarCantidad");
	btnHacerSalida = $("#btnHacerSalida");
	nombreQuienCreaSol = $("#nombreQuienCreaSol");
	fechaCreaSol = $("#fechaCreaSol");
	horaCreaSol = $("#horaCreaSol");
	sedesCompras = $("#sedesCompras");
	listaSolicitudesCompras = $("#listaSolicitudesCompras");
	modalSolicitudAtendida = $("#modalSolicitudAtendida");
	bodyAtenderSolicitud = $("#bodyAtenderSolicitud");
	btnAtenderSolicitud = $("#btnAtenderSolicitud");
	listarProductosConfig = $("#listarProductosConfig");
	nombreQuienautoSol = $("#nombreQuienautoSol");
	modalAutorizarSolicitud = $("#modalAutorizarSolicitud");
	bodyAutorizarSolicitud = $("#bodyAutorizarSolicitud");
	modalAjustarcantidadAutorizar = $("#modalAjustarcantidadAutorizar");
	cantidadActualSolicitada = $("#cantidadActualSolicitada");
	nuevaCantidadSolicitada = $("#nuevaCantidadSolicitada");
	iddetalleajustar = $("#iddetalleajustar");
	btnAjustarCantAutorizar = $("#btnAjustarCantAutorizar");
	btnAtutorizarSolicitud = $("#btnAtutorizarSolicitud");
	numeroSolicitudB = $("#numeroSolicitudB");
	desdeBuscar = $("#desdeBuscar");
	hastaBuscar = $("#hastaBuscar");

	$("#carritoSolicitud").hide();
	validarSesion();
	hideInicio();
	divSolicitudes.show();
	listarSolicitudes();
	listarProductos();
	$.post("./php/funciones_pedidos.php",{op: "inicio"}, (x)=>{
		sedesN.html(x);
		sedesC.html(x);
		sedesB.html(x);
		areasN.attr("disabled",true);
		dependenciasN.attr("disabled",true);
		bdescripcionDependencia.attr("disabled",true);
		breferenciaDependencia.attr("disabled",true);
		inputBuscarProductoDependencia.attr("disabled",true);
		btnBuscarProductoDependencia.attr("disabled",true);
		buscarProductoN.attr("disabled",true);
		btnBuscarProductoN.attr("disabled",true);
		bdescripcion.attr("disabled",true);
		breferencia.attr("disabled",true);
		cantidadProductoN.attr("disabled",true);
	});
	$.post("./php/funciones_pedidos.php",{op: "almacen"}, (x)=>{
		sedeAlmacen.html(x);
		sedesCompras.html(x);
	});
	listarSolicitudesCompras(0);
	
	sedesCompras.change(()=>{
		listarSolicitudesCompras(sedesCompras.val());
	});
	sedeAlmacen.change(()=>{
		$.post("./php/funciones_pedidos.php",{op: "solicitudesAlmacen", sede: sedeAlmacen.val()}, (x)=>{
			$("#listaAlmacen").html(x);
		});
	});
	sedesN.change(()=>{
		$.post("./php/funciones_pedidos.php",{op: "areas", idsede: sedesN.val()}, (x)=>{
			areasN.html(x);
			areasN.attr("disabled",false);
		});
	});
	areasN.change(()=>{
		$.post("./php/funciones_pedidos.php",{op: "dependencias", idsede: sedesN.val(), idarea: areasN.val()}, (x)=>{
			dependenciasN.html(x);
			dependenciasN.attr("disabled",false);
		});
	});
	dependenciasN.change(()=>{
		buscarProductoN.attr("disabled",false);
		btnBuscarProductoN.attr("disabled",false);
		bdescripcion.attr("disabled",false);
		breferencia.attr("disabled",false);
		cantidadProductoN.attr("disabled",false);

	});

	sedesC.change(()=>{
		$.post("./php/funciones_pedidos.php",{op: "areas", idsede: sedesC.val()}, (x)=>{
			areasC.html(x);
			areasC.attr("disabled",false);
		});
	});
	areasC.change(()=>{
		$.post("./php/funciones_pedidos.php",{op: "dependencias", idsede: sedesC.val(), idarea: areasC.val()}, (x)=>{
			dependenciasC.html(x);
			dependenciasC.attr("disabled",false);
		});
	});
	btnAtenderSolicitud.click(()=>{
		atenderSolicitud($("#idSolicitudAtender").val());
	});
	
	dependenciasC.change(()=>{
		if(dependenciasC.val()!="0")
		{
		bdescripcionDependencia.attr("disabled",false);
		breferenciaDependencia.attr("disabled",false);
		inputBuscarProductoDependencia.attr("disabled",false);
		btnBuscarProductoDependencia.attr("disabled",false);
		btnAgregarProductoDependencia.attr("disabled",false);
		listarProductosConfiguracion(dependenciasC.val());
		}
	});
	$(".btnCerrarMCntidad").click(()=>{
		modalAjustarCantidad.modal("hide");
		modalDetalleSolicitudAlmacen.modal("show");
	});
	btnActualizarCantidad.click(()=>{
		if(nuevaCantidad.val() > 0 )
		{
			if(nuevaCantidad.val() > Number(cantidadActual.text()))
			{
				Swal.fire({
					title: 'Solamente puede disminuir la cantidad',
					text: 'La cantidad actual es de '+cantidadActual.text(),
					icon: 'warning',
					confirmButtonText: 'Aceptar'
				});
			}else{
				$.post("./php/funciones_pedidos.php",{op: "actualizarCantidadEntregada", idproducto: $("#idProdNewCant").val(), cantidad: nuevaCantidad.val()}, (x)=>{
					if(Number.isInteger(Number(x)))
					{
						modalAjustarCantidad.modal("hide");
						detallesSolicitudAlmacen(x);
						modalDetalleSolicitudAlmacen.modal("show");
						Swal.mixin({
							toast:true,
							showConfirmButton: false,
							timer: 3000,
							position: 'top-end',
							timerProgressBar: true,
						}).fire({
							icon: 'success',
							title: 'Se actualizo la cantidad'
						});

					}else{
						Swal.fire({
							type: 'error',
							title: 'Oops...',
							text: 'Algo salio mal!',
							footer: 'Intente de nuevo'
						});
					}
					nuevaCantidad.val("");
				});
			}
		}
		
	});

	btnAgregarProductoDependencia.click(()=>{
		if(idproductoC != "")
		{
			$.post("./php/funciones_pedidos.php",{op: "agregarProductoDependencia", iddependencia: dependenciasC.val(), idproducto: idproductoC.val()}, (x)=>{
				listarProductosConfiguracion(dependenciasC.val());
			});	
		}
	});
	btnBuscarProductoDependencia.click(()=>{

		let tipoBusqueda;
		if(breferenciaDependencia.prop('checked')){
			tipoBusqueda = "referencia";
		}else if(bdescripcionDependencia.prop('checked')){
			tipoBusqueda = "producto";
		}
		
		$.post("./php/funciones_pedidos.php",{op: "buscarProductoConfiguracion", tipo: tipoBusqueda, item: buscarProductoN.val()}, (x)=>{
			modalBuscarProductoC.modal("show");
			tbodyBuscarProductoC.html(x);
		});

	});
	btnHacerSalida.click(()=>{

		$.post("./php/funciones_pedidos.php",{op: "hacerSalida", idsolicitud: $('#inpidsolicitudSalida').val()}, (x)=>{
			if(x=="error")
			{
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Algo salio mal!',
					footer: 'Intente de nuevo'
				});
			}else{
				Swal.fire({
					title: 'Salida realizada',
					text: 'Se ha realizado la salida para la solicitud '+x,
					icon: 'success',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.value) {
						sedeAlmacen.val("0");
						$("#listaAlmacen").html("");
					}
				});
			}
			modalDetalleSolicitudAlmacen.modal("hide");
		})
	});
	btnModalNuevaSolicitud.click(()=>{
		modalNuevaSolicitud.modal("show");
	});
	btnModalBuscarSolicitudN.click(()=>{
		modalBuscarSolicitudN.modal("show");
	});
	btnBuscarSolicitud.click(()=>{
		buscarSolicitud();
	});
	btnAjustarCantAutorizar.click(()=>{
		GuardarCantidadAutorizar();
		});
	btnBuscarProductoN.click(()=>{
		let tipoBusqueda;
		if(breferencia.prop('checked')){
			tipoBusqueda = "referencia";
		}else if(bdescripcion.prop('checked')){
			tipoBusqueda = "producto";
		}
		$.post("./php/funciones_pedidos.php",{op: "buscarProductoNuevaSol", tipo: tipoBusqueda, item: buscarProductoN.val(),dependencia : dependenciasN.val()}, (x)=>{
			modalNuevaSolicitud.modal("hide");
			modalBuscarProductoN.modal("show");
			tbodyBuscarProductoN.html(x);
		});
	});
	btnAddItemCarrito.click(()=>{
		if(idproductoTempN.val() != "" && idproductoTempN.val() > 0){
			if(cantidadProductoN.val() > 0){
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
		}
	});
	btnConfirmarSolicitudN.click(confirmar);

	btnModalAgregarProducto.click(()=>{
		modalAgregarProducto.modal("show");
	});
	btnListarAll.click(listarProductos);
	btnAgregarProducto.click(agregarProducto);

	$(".nav-item").click(function(){
		$(".nav-item").removeClass("active");
		$(this).addClass("active");
	});

	$(".tr-item").click(function(){
		alert("click");
		$(this).addClass("active");
		$(".tr-item").removeClass("active");
		$(this).addClass("active");
	});
	
	btnEditarProducto.click(salvarEditarProducto);
	btnBuscarDescripcionP.click(()=>{
		$.post("./php/funciones_pedidos.php",{op: "buscarProducto", item: inputBuscarProducto.val(), tipo: "producto"}, (x)=>{
			listaProductos.html(x);
		});
	});
	btnBuscarReferenciaP.click(()=>{
		$.post("./php/funciones_pedidos.php",{op: "buscarProducto", item: inputBuscarProducto.val(), tipo: "Referencia"}, (x)=>{
			listaProductos.html(x);
		});
	});
	btnAtutorizarSolicitud.click(()=>{
		Swal.fire({
			title: "¿Esta seguro de autorizar esta solicitud?",
			text: "",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, autorizar'
		}).then((result) => {
			if (result.value) {
				$.post("./php/funciones_pedidos.php",{op: "autorizar", idsolicitud: $("#idsolicitudAutorizar").val()}, (x)=>{
					if(x == "ok")
					{
						Swal.fire({
							title: "Exito",
							text: "Solicitud autorizada",
							icon: "success",
							confirmButtonText: "Aceptar"
						});
						listarSolicitudes();
					}else{
						Swal.fire({
							title: "Error",
							text: "No se pudo autorizar la solicitud",
							icon: "error",
							confirmButtonText: "Aceptar"
						});
					}
				});
			}
		});
	});
}

