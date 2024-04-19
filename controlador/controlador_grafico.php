<?php
	require './modelo_grafico.php';
    $MG =new modelo_grafico();
    $consulta=$MG ->traerdatosgraficosbar();
    echo json_encode($consulta)
?>

