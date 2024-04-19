<?php
	require './modelo_grafico.php';
    $MG =new modelo_grafico();
    $v_fecha=$_POST['bfecha'];
    $v_valor=$_POST['blugar'];
    $consulta=$MG ->parametrotemperatura($v_valor,$v_fecha);
    echo json_encode($consulta)
?>