<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="public/images/ogcushort.png" type="image/x-icon"/>
    <title>Sistema de Nivelacion</title>

    <?php require_once(COMPONENT_PATH . "dependencies.php"); ?>
    <?php require_once(CONTROLLER_PATH . "timezone.php"); ?>

</head>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <!--     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion bg-light w-100" id="accordionSidebar">


</ul> -->
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column content-student">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 pl-4 static-top border-bottom">
                    <span class="navbar-brand">
                        <span class="sidebar-brand d-flex align-items-center justify-content-center">
                            <div class="sidebar-brand-icon ">
                                <img src="public/images/logo.jpg" width="50px"
                                     class="rounded float-start" alt="Escudo de la Unasam" loading="lazy">
                            </div>

                            <div class="mx-3">
                                <h6 class="text-dark font-weight-bold px-2 mb-0">UNASAM</h6>
                                <span class="badge bg-primary text-white py-1 px-2 small">Nivelación</span>
                            </div>
                        </span>
                    </span>
                <h5 class="ml-2 mt-3 font-weight-bold d-none text-light" id="view-title">
                    Cargando...
                </h5>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle text-primary" href="#">
                            <strong>Perú,&nbsp;</strong> <?php echo fechaPeru(); ?></a>

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

                            <button class="mt-3 p-1 avatar img-profile rounded-circle text-center text-capitalize font-weight-bold alert alert-primary"
                                    role="alert">
                                <?php echo substr($_SESSION['user_logged']['name'], 0, 1); ?>
                            </button>

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="seguimiento">
                                <i class="bi bi-bookmarks-fill mr-2"></i>Seguimientos
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="perfil">
                                <i class="bi bi-person-lines-fill mr-2"></i>Mi Perfil
                            </a>
                            <a class="dropdown-item text-danger font-weight-bold click-logout" href="#"
                               data-toggle="modal" data-target="#logoutModal">
                                <i class="bi bi-box-arrow-in-left mr-2 text-danger"></i>
                                Cerrar sesión
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>