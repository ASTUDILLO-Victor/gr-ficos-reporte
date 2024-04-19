<?php
	require './modelo_grafico.php';
    $MG =new modelo_grafico();
    $fecha=$_POST['fecha'];
    $valor=$_POST['valor'];
    $consulta=$MG ->parametrotds($valor,$fecha);
    echo json_encode($consulta)
?>

