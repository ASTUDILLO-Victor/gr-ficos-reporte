<?php
    include("conexion.php");
    date_default_timezone_set("America/Guayaquil");

    //$select = "select u.*, e.nombre emple from usuario u, empleado e where u.us_id=1 
    //           and e.us_id=u.us_id and u.estado=1";
    //$resp = $db->query($select);
    //while($fila = $resp->fetch_array()){
    //    $nombre = $fila['emple'];
    //}
    //$variable = "holas todos";

?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>PROYECTO 9AB</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<script src="jquery-3.6.4.js"> </script> <!-- llamar archivos funciones -->
	<!-- <script src="bootstrap/js/bootstrap.js"> </script> 
	<script src="bootstrap/js/bootstrap.bundle.js"> </script> 
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" /> llamar archivos -->

	<link href="dataTables.bootstrap4.min.css" rel="stylesheet" /> <!-- llamar archivos -->
	<script src="jquery.dataTables.min.js"> </script>
	<script src="dataTables.bootstrap4.min.js"> </script>

    <script src="sweetalert/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="sweetalert/sweetalert.css">
    
    <!-- Agregar los enlaces a los archivos de SweetAlert y Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    

    <script src="chosen/chosen.jquery.min.js"></script>
    <link href='chosen/chosen.min.css' rel='stylesheet'>

	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
  	<meta content="" name="description">

</head>
<body>
	<div id="container" class="offset-2">
		<div class="card"> 
			<div class="card-header bg-info">
				<div class="card-title text-white"><h2>ANALISIS DE CONTAMINACION DEL AGUA</h2></div>
			</div>
		</div>
		<hr class="lin" />
		<h1>Selecciona un dato de la tabla:</h1>
    <table border=1 class="table table-striped table-bordered table-hover" id="tablita">
        <thead class="bg-dark text-white text-center">
            <th>TDS</th>
            <th>TURBIDEZ</th>
            <th>TEMPERATURA</th>
            <TH>FECHA</TH>
            
            <TH>ALERTA</TH>
            <th>ACCIONES</th>
        </thead>
        <tbody>
            <?php
                $select = "SELECT * FROM monitoreo where estado=1";
                $resp = $con->query($select);
                while($fila = $resp->fetch_array()){
            ?>
            <tr>
                <td><?php echo $fila['tds']; ?></td>
                <td><?php echo $fila['turbidez']; ?></td>
                <td><?php echo $fila['temperatura']; ?></td>
                <td><?php echo $fila['fecha']; ?></td>
                
                <td><?php echo $fila['contaminacion']; ?></td>
                <td>
                    <form action="ejecutar_procedimiento.php" method="post">
                        <input type="submit" value="Analisis" class="btn btn-primary">
                    </form>
                    <form action="graficonta.php" method="post">
                        <input type="hidden" name="contaminacion" value="<?php echo $fila['contaminacion']; ?>">
                        <input type="hidden" name="dato_id" value="<?php echo $fila['id']; ?>">
                        <button type="submit" class="btn btn-success">Detalle</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
	</div>
<script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	function eliminar(id){

        swal({
                title: 'CHARLLES SOFT',
                text: "Desea eliminar el registro?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#dd3333',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            },
            function() {
                window.location.href = "eliminarDatos.php?id=" + id;
            });
	}

	function aparezcaModal(id, nom, cedu, fnaci){
		$("#mimodal").modal("show");
		$("#Enombre").val(nom);
		$("#Eced").val(cedu);
		$("#idempleado").val(id);
		$("#Efnac").val(fnaci);
	}

	function cerrarModal(){
		$("#mimodal").modal("hide");
	}

	function obtenernombredelinput(){
		var mens = document.getElementById("nombre").value;
		let mens1 = $("#nombre").val();
		mens1 = mens1.toUpperCase();
		alert(mens1);
	}

	function validarCorreo(){
		let cor = $("#correo").val();
		var lugar = cor.indexOf(".");
		let bandera = true;
		if(lugar==-1) bandera = false;
		else{
			var contador = 0;
			for(var i=0; i<=cor.length; i++){
				if(cor[i]=="@")	contador = contador +1;
			}
			if (contador>1 || contador<1) bandera =false;
		}
		if(bandera){
			$("#correo").removeClass("border-danger");
			$("#correo").addClass("border-success");
			$("#desaparezca").prop("hidden", true);
		}else{
			swal("CHARLLES SOFT","Todo mal","error");
			$("#correo").val("");
			$("#correo").removeClass("border-success");
			$("#correo").addClass("border-danger");
			$("#desaparezca").removeAttr("hidden");
		}
	}

	function soloLetras(){
		var nom = $("#nombre").val();
		let bandera = false;
		for(var i=0;i<nom.length;i++){
			if (nom[i]=="1")  bandera = true;
			else if (nom[i]=="2")  bandera = true;
			else if (nom[i]=="3")  bandera = true;
			else if (nom[i]=="4")  bandera = true;
			else if (nom[i]=="5")  bandera = true;
			else if (nom[i]=="6")  bandera = true;
			else if (nom[i]=="7")  bandera = true;
			else if (nom[i]=="8")  bandera = true;
			else if (nom[i]=="9")  bandera = true;
			else if (nom[i]=="0")  bandera = true;
		}
		if (bandera==true){
			alert("No acepta números");
			$("#nombre").val("");
		}
	}

	function validarLetras(e) { // 1
		var tecla = (document.all) ? e.keyCode : e.which;// 2
		if (tecla==8) return true; // 3
		var patron =/[A-Za-z\s]/; // 4
		var te = String.fromCharCode(tecla); // 5
		return patron.test(te); // 6
	}

	function validarNumeros(e) { // 1
		var tecla = (document.all) ? e.keyCode : e.which;// 2
		if (tecla==8) return true; // 3
		var patron =/[0-9]/; // 4
		var te = String.fromCharCode(tecla); // 5
		return patron.test(te); // 6
	}

	$(document).ready(function () {
		$('#tablita').DataTable({
            "language": {
                "processing": "Procesando...",
                "lengthMenu": "Ver _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "infoThousands": ",",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Sig.",
                    "previous": "Ant."
                },
            }
        });
	});


    $(document).ready(function() {
        $('.chzn-select').chosen({"width": "100%"});
        $('.chzn-drop').css({"width": "300px"});
    })
    
    
    function mostrarAlerta() {
        // Aquí puedes obtener el valor de "contaminacion" desde tu base de datos
        var contaminacion = "Contaminación detectada en el monitoreo";

        // Muestra la alerta utilizando SweetAlert
        Swal.fire({
            icon: 'warning',
            title: 'Alerta de Contaminación',
            text: contaminacion,
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Redirecciona a la página deseada después de mostrar la alerta
            window.location.href = 'otra_pagina.php';
        });
    }
    
    function mostrarBienvenida() {
        // Mensaje de bienvenida
        var mensaje = "¡Bienvenido a nuestro sitio web!";

        // Muestra la alerta utilizando SweetAlert
        Swal.fire({
            icon: 'success',
            title: '¡Bienvenida!',
            text: mensaje,
            confirmButtonText: 'Aceptar'
        });
    }

    function mostrarTabla(id) {
    window.location.href = "graficonta.php?id=" + id; // Reemplaza "otra_pagina.php" con el nombre de la otra página
    }



</script>

</body>
</html>