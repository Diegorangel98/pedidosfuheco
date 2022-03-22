<?php 

$excel = $_REQUEST['export']; 
header("Content-type: application/vnd.ms-excel"); 
header("Content-disposition: attachment; filename=exportar.xls"); 
print $excel; 
exit; 


/*
$excel = $_REQUEST['export']; 
header("Content-type: application/notepad"); 
header("Content-disposition: attachment; filename=PLANO.txt"); 
print $excel; 
exit; 
*/
/*
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=plano.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_REQUEST['export'];
*/
?>