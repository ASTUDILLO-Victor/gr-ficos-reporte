<?php
	require 'modelo_grafico.php';
    $MG =new modelo_grafico();
    $consulta=$MG ->traerdatosgraficosbar2();
    echo json_encode($consulta)
?>
