<?php

require_once("../../general/creasantos/creasantos.php");
$formatos = new creaSantos();
$formatos->setRuta("../../");

$formatos->setCss("style");
$formatos->setJs("funciones_pedidos");

$formatos->setCssGeneral("bootstrap/bootstrap.min");
$formatos->setCssGeneral("sweetalert2.min");
$formatos->setJsGeneral("bootstrap/bootstrap.bundle.min");
$formatos->setJsGeneral("sweetalert2.min");

$formatos->setTitulo("Pedidos");
$formatos->setVista("pedidos");

echo $formatos->render();
// tsetss