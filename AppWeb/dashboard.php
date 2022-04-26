<?php require_once 'includes/conection.php'; ?>
<?php require_once 'includes/consultaTable.php'; ?>
<?php require_once 'includes/consultaGrafica.php'; ?>
<?php



if($_SESSION['usuario'] == null ||  $_SESSION['usuario']  =='' ){
    header('location: login.php');
    die();

}
?>

<?php

//
//$obj = json_decode(file_get_contents("json/led.json"));
//$led = $obj->{'led'};
//
//$ledswitch = $led <= 0 ? "unchecked" : "checked";
//

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="assets/styles/styles.css" rel="stylesheet" />
    <link href="assets/styles/toggle.css" rel="stylesheet" />
<!--    <link rel="stylesheet" href="assets/styles/style.css">-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

</head>


<body class="sb-nav-fixed" onload="deshabilitaRetroceso()">

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->


    <?php if(isset( $_SESSION['usuario'])) :?>
        <a class="navbar-brand ps-3" href="dashboard.php">
            Welcome <?= $_SESSION['usuario']['username'] ; ?>
        </a>
    <?php endif; ?>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <!--                <div class="input-group">-->
        <!--                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />-->
        <!--                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>-->
        <!--                </div>-->
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <!--                        <li><a class="dropdown-item" href="#!">Settings</a></li>-->
                <!--                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>-->
                <!--                        <li><hr class="dropdown-divider" /></li>-->
                <li><a class="dropdown-item" href="cerrar.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.php">Login</a>
                                    <a class="nav-link" href="new_user.php">Register</a>

                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php if(isset( $_SESSION['usuario'])) :?>
                    <?= $_SESSION['usuario']['username'] ; ?>
                <?php endif; ?>


            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"></li>
                </ol>
                <div class="row">
                    <form action="pruebaForm.php" method="post">

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <h3> Dispositivo 1 </h3>
                                <span>
                                    <input  id="led" class="l foco" type="checkbox"  name="led" >
<!--                                        <input type="checkbox" id="led" --><?php //echo $ledswitch; ?><!-- >-->
<!--                                       <input  id="led" class="l foco" type="checkbox"  --><?php //echo $ledswitch; ?><!-- >-->
                                </span>
                        </div>
                    </div>
<!---->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <h3> Dispositivo 2 </h3>
                            <span>
                                <input  id="led1" class="l foco" type="checkbox"  name="led1" >
                            </span>
                        </div>
                    </div>
                        <input type="submit" class="btn"  value="send">
                    </form>
                </div>  <!--        ROW        -->



                <hr class="dropdown-divider">

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Grafica de lineal
                            </div>
                            <div class="card-body">
                                <div id="tester" width="100%" height="40"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Grafica de barras
                            </div>
                            <div class="card-body">
                                <div id="tester1" width="100%" height="40"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Event #</th>
                                <th>Value</th>
                                <ht>location</ht>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>User</th>
                                <th>Event #</th>
                                <th>Value</th>
                                <ht>location</ht>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($save)){?>
                                <tr>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['id_event']; ?></td>
                                    <td><?php echo $row['value']; ?></td>
                                    <td><?php echo $row['location']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['reading_time']; ?></td>
                                </tr>
                            <?php }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2022</div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script src="js/plotly-2.11.1.min.js"></script>
<!---->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/main.js"></script>
<script src="js/range.js"></script>

<!---->
</body>
</html>
<script type="text/javascript">
    function crearCadenaLineal(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for(var x in parsed){
            arr.push(parsed[x]);

        }
        return arr;

    }
</script>

<script type="text/javascript">
    //// myAreaChart
    datosX = crearCadenaLineal('<?php  echo $datosx ?>')
    datosY = crearCadenaLineal('<?php  echo $datosy ?>')
    // console.log(datosX, datosY);
    //
    var  trace = {
        x: datosX,
        y: datosY,
        type: 'scatter'

    };
    var  trace1 = {
        x: datosX,
        y: datosY,
        type: 'bar'

    };


    var data = [trace];
    var data1 = [trace1];
    // console.log(data);
    // var TESTER = document.getElementById('tester');

    TESTER = document.getElementById('tester');
    TESTER1 = document.getElementById('tester1');
    // Plotly.newPlot( TESTER, [{
    //     x: [1, 2, 3, 4, 5],
    //     y: [1, 2, 4, 8, 16] }], {
    //     margin: { t: 0 } } );

    Plotly.newPlot( TESTER, data);
    Plotly.newPlot( TESTER1, data1);

</script>






<!--<script type="text/javascript">-->
<!--    TESTER = document.getElementById('tester');-->
<!--    Plotly.newPlot( TESTER, [{-->
<!--    x: [1, 2, 3, 4, 5],-->
<!--    y: [1, 2, 4, 8, 16] }], {-->
<!--    margin: { t: 0 } } );-->
<!---->
<!---->
<!--</script>-->

