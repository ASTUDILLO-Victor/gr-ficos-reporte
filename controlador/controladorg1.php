<?php
	require './modelo_grafico.php';
    $MG =new modelo_grafico();
    $consulta=$MG ->traerdatosgraficosbar7();
    echo json_encode($consulta)
?>
