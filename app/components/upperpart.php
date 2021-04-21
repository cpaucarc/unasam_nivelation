<?php
$rtax = isset($routeAux) ? $routeAux : "";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $rtax; ?>public/images/ogcushort.png" type="image/x-icon"/>
    <title>Sistema de Nivelacion</title>

    <?php require_once(COMPONENT_PATH . "dependencies.php"); ?>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
</head>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
           href="inicio">
            <div class="sidebar-brand-icon ">
                <img src="<?php echo $rtax; ?>public/images/logo.jpg" width="50px" class="rounded float-start"
                     alt="Escudo de la Unasam">
            </div>

            <div class="sidebar-brand-text mx-3">
                UNASAM <span class="badge bg-primary p-1 small">Nivelación</span>
            </div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="inicio">
                <i class="fas fa-home"></i>
                <span>Inicio del sitio</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Vistas
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-table"></i>
                <span>Vistas</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Vistas por:</h6>
                    <a class="collapse-item" href="<?php echo $rtax; ?>estudiante">Vista por
                        Estudiante</a>
                    <a class="collapse-item" href="<?php echo $rtax; ?>curso">Vista por Curso</a>
                    <a class="collapse-item" href="<?php echo $rtax; ?>escuela">Vista por Escuela</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Componentes</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Vista por:</h6>
                    <a class="collapse-item" href="<?php echo $rtax; ?>rangos">Rangos</a>
                    <a class="collapse-item" href="<?php echo $rtax; ?>areas">Areas</a>
                    <a class="collapse-item" href="<?php echo $rtax; ?>admision">Admisión</a>
                    <a class="collapse-item" href="<?php echo $rtax; ?>cursos">Cursos</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-user"></i>
                <span>Usuario</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Vistas de usuario</h6>
                    <a class="collapse-item" href="<?php echo $rtax; ?>usuarios">Usuarios registrados</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top border-bottom">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <h5 class="ml-2 mt-3 font-weight-bold d-none d-lg-inline text-gray-600" id="view-title">
                    Cargando...
                </h5>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">


                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600">
                                    <?php
                                    echo isset($_SESSION['user_logged']) ? (ucfirst($_SESSION['user_logged']['name']) . ' ' . ucfirst($_SESSION['user_logged']['lastname'])) : 'Guest'
                                    ?>
                                </span>

                            <button class="mt-3 avatar img-profile rounded-circle text-center text-capitalize font-weight-bold alert alert-primary"
                                    role="alert">
                                <?php echo substr($_SESSION['user_logged']['name'], 0, 1); ?>
                            </button>

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?php echo $rtax; ?>perfil">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger font-weight-bold" href="#" data-toggle="modal"
                               data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                Cerrar sesión
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>