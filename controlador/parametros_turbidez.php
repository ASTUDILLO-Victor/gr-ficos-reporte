<?php
	require './modelo_grafico.php';
    $MG =new modelo_grafico();
    $v_fecha=$_POST['fecha'];
    $v_valor=$_POST['vlugar'];
    $consulta=$MG ->parametroturbidez($v_valor,$v_fecha);
    echo json_encode($consulta)
?>