<?php
session_start();
error_reporting(0);
$varsesion=$_SESSION['usuario'];
if ($varsesion == null || $varsesion ='') {
    header ("location:index.html");
    die();
}
?>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'id21026606_bd_esp8266');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Proyecto Integrador</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">AGUA</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <h2 class="text text-white"><?php
                    echo $_SESSION['usuario'];
                    
                    ?></h2>
                    <li><a class="btn btn-danger" href="cerrar.php">cerrar</a></li>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="cerrar.php">cerrar</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Grafico-analisis</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">pagina 1</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">pagina 2</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <!-- aqui poner el codigo -->
                        <div class="class="col-lg-12" style="padding-top:20px;">
        <div class="card">
            <div class="card-header bg-black text-white">
                Grafico Comparativo 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <canvas id="myChart1"  width="400" height="400"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <canvas id="myChart2"  width="400" height="400"></canvas>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- <div class="card"> 
            <div class="card-header">
                Grafico con Parametros
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-lg-4">
                        <canvas id="myChart3" width="400" height="400"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <canvas id="myChart4"  width="400" height="400"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <canvas id="myChart5"  width="400" height="400"></canvas>
                    </div>
                    
                </div>
            </div>
        </div>  -->
        <div class="card">
            <div class="card-header bg-black text-white">
                Grafico con Parametros TDS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <select name="valor" id="valor">
                        <?php
                        $query = $mysqli -> query ("SELECT lugar FROM monitoreo_agua GROUP by lugar");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores['lugar'].'">'.$valores['lugar'].'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <input type="date" name="fecha" id="fecha">
                    </div>
                    <div class="col-lg-2">
                        <label for=""></label>
                        <button class="btn btn-danger" onclick="datos_barra_parametros()"><strong>Buscar</strong></button>
                    </div>
                <div class="col-lg-4">
                        <canvas id="myChart6" width="400" height="400"></canvas>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-black text-white">
                Grafico con Parametros Turbidez
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <select name="valor" id="lugar">
                        <?php
                        $query = $mysqli -> query ("SELECT lugar FROM monitoreo_agua GROUP by lugar");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores['lugar'].'">'.$valores['lugar'].'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <input type="date" name="fecha" id="selec_fecha">
                    </div>
                    <div class="col-lg-2">
                        <label for=""></label>
                        <button class="btn btn-danger" onclick="datos_barra_turbidez()"><strong>Buscar</strong></button>
                    </div>
                <div class="col-lg-4">
                        <canvas id="myChart7" width="400" height="400"></canvas>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-black text-white">
                Grafico con Parametros Temperatura
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <select name="valor" id="lugar_temperatura">
                        <?php
                        $query = $mysqli -> query ("SELECT lugar FROM monitoreo_agua GROUP by lugar");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores['lugar'].'">'.$valores['lugar'].'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <input type="date" name="fecha" id="selec_fechatem">
                    </div>
                    <div class="col-lg-2">
                        <label for=""></label>
                        <button class="btn btn-danger" onclick="datos_barra_temperatura()"><strong>Buscar</strong></button>
                    </div>
                <div class="col-lg-4">
                        <canvas id="myChart8" width="400" height="400"></canvas>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>

                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>









    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
caragardatostodoguanga()
caragardatostodofer()
caragardatostodotri()
caragardatosgraficobar()
caragardatosgraficobarHORIZONTAL()
caragardatosgraficobarH()
function caragardatosgraficobar(){
        $.ajax({
            url:'./controlador/controlador_grafico.php ',
            type:'POST'
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][1]);
                    cantida.push(data[i][2]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'bar','tds','myChart',color)
            }
        })
    }
            
    function caragardatosgraficobarHORIZONTAL(){
        $.ajax({
            url:'controlador/controlargrafico2.php ',
            type:'POST'
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][1]);
                    cantida.push(data[i][2]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'line','Turbidez','myChart1',color)
                
            }
    
                    
                })
    }
    function caragardatosgraficobarH(){
        $.ajax({
            url:'controlador/controlargrafico3.php ',
            type:'POST'
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][1]);
                    cantida.push(data[i][2]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'bar','temperatura','myChart2',color)
                
            }
    
                    
                })
    }

    function caragardatostodotri(){
        $.ajax({
            url:'controlador/controladorg1.php ',
            type:'POST'
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][0]);
                    cantida.push(data[i][0]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'bar','turbidez-Trinitaria','myChart3',color)
                
            }
    
                    
                })
    }
    function caragardatostodoguanga(){
        $.ajax({
            url:'controlador/controladorg2.php ',
            type:'POST'
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][0]);
                    cantida.push(data[i][0]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'bar','turbidez-Guangala','myChart4',color)
                
            }
    
                    
                })
    }
    function caragardatostodofer(){
        $.ajax({
            url:'controlador/controladorg3.php ',
            type:'POST'
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][0]);
                    cantida.push(data[i][0]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'bar','turbidez-Fertisa','myChart5',color)
                
            }
    
                    
                })
    }
    
    

    function CREARGRAFICO(titulo,cantida,tipo,emcabezado,id,color) {
        const ctx = document.getElementById(id);

        new Chart(ctx, {
        type: tipo,
        data: {
            labels: titulo,
            datasets: [{
            label: emcabezado,
            data: cantida,
            backgroundColor:color,
            borderColor:color,
            borderWidth: 1
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
        });
    }   
    function generarNumero(numero){
        return (Math.random()*numero).toFixed(0);
        }

        function colorRGB(){
            var coolor = "("+generarNumero(255)+"," + generarNumero(255) + "," + generarNumero(255) +")";
            return "rgb" + coolor;
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////

    //////////funciones con parametro////////////////////////////////////////////////////////////
    function datos_barra_parametros(){
        var valor= document.getElementById("valor");
        var fecha= document.getElementById("fecha");
        var vfecha=fecha.value;
        var vvalor=valor.value;
        $.ajax({
            url:'controlador/parametros_comparativo.php',
            type:'POST',
            data:{
                valor:vvalor,
                fecha:vfecha
            }
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][0]);
                    cantida.push(data[i][0]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'bar','TDS','myChart6',color)
                
            }
    
                    
                })
    }
    ///////////////////////////tubidez//////////////////////////////////////////////
    function datos_barra_turbidez(){
        var lugar= document.getElementById("lugar");
        var s_fecha= document.getElementById("selec_fecha");
        var v_fecha=s_fecha.value;
        var v_valor=lugar.value;
        $.ajax({
            url:'controlador/parametros_turbidez.php',
            type:'POST',
            data:{
                vlugar:v_valor,
                fecha:v_fecha
            }
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][0]);
                    cantida.push(data[i][0]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'bar','Turbidez','myChart7',color)
                
            }
    
                    
                })
    }
    /////////////////////////////temperatura//////////////////////////////////////
    function datos_barra_temperatura(){
        var lugar= document.getElementById("lugar_temperatura");
        var s_fecha= document.getElementById("selec_fechatem");
        var v_fecha=s_fecha.value;
        var v_valor=lugar.value;
        $.ajax({
            url:'controlador/parametros_temperatura.php',
            type:'POST',
            data:{
                blugar:v_valor,
                bfecha:v_fecha
            }
        }).done(function(resp){
            if(resp.length >0){
                var titulo =[];
                var cantida=[];
                var color=[];
                var data = JSON.parse(resp);
                for(var i=0;i < data.length;i++){
                    titulo.push(data[i][0]);
                    cantida.push(data[i][0]);
                    color.push(colorRGB());
                }
                CREARGRAFICO(titulo,cantida,'bar','Temperatura','myChart8',color)
                
            }
    
                    
                })
    }
    
</script>
