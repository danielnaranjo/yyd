<?
/* variables */
$nivel = $this->session->userdata('level');
?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="nav-item start">
                <a href="<?php echo site_url() ?>/administrator/" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Home</span>
                </a>
            </li>
            
            <!-- administrador general -->
            <?php if($nivel!=2) { ?>
            <li class="nav-item">
                <a href="<?php echo site_url() ?>/client/all" class="nav-link">
                    <i class="fa fa-user"></i>
                    <span class="title">Compradores</span>
                </a>
            </li>
            <?php if($nivel==0) { ?>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-building"></i>
                    <span class="title">Proyectos</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/property/all" class="nav-link ">
                            <span class="title">Proyectos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/bank/all" class="nav-link ">
                            <span class="title">Formas de pagos</span>
                        </a>
                    </li>                    
                </ul>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Usuarios</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <?php  if($nivel==0) { ?>
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/administrator/all/0" class="nav-link ">
                            <span class="title">Administradores</span>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/administrator/all/1" class="nav-link ">
                            <span class="title">Gerente de Proyecto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/administrator/all/2" class="nav-link ">
                            <span class="title">Brokers</span>
                        </a>
                    </li>                
                </ul>
            </li>
            <?php } ?>
            <!-- administrador general -->

            <!-- administrador de proyecto -->
            <?php  if($nivel!=2) { ?>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-line-chart"></i>
                    <span class="title">Reportes</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/transaction/countries" class="nav-link ">
                            <span class="title">Nacionalidades</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/transaction/unities" class="nav-link ">
                            <span class="title">Unidades</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/transaction/brokers" class="nav-link ">
                            <span class="title">Brokers</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <!-- administrador general -->
            <? 
                if($nivel!=0 && $this->session->userdata('property_id')=='') {
                    echo '<meta http-equiv="refresh" content="0" >';
                    echo '<script>console.log("Fix it",'.now().')</script>';
                }
            ?>

            <?php  if($nivel!=0) { ?>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-building"></i>
                    <span class="title">Unidades</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/property/unities/<?php echo $this->session->userdata('property_id') ?>" class="nav-link ">
                            <span class="title"> Ver <?php if($nivel!=2) { ?>/ Agregar<?php } else { echo "Unidades"; } ?> </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url() ?>/property/details/<?php echo $this->session->userdata('property_id') ?>" class="nav-link ">
                            <span class="title">Detalles</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php  if($nivel==2) { ?>
            <li class="nav-item">
                <a href="<?php echo site_url() ?>/client/all" class="nav-link">
                    <i class="fa fa-user"></i>
                    <span class="title">Compradores</span>
                </a>
            </li>
            <?php } ?>

            <li class="heading">
                <h3 class="uppercase"></h3>
            </li>
            
            

            <!-- todos -->
            <li class="heading">
                <h3 class="uppercase"></h3>
            </li>
            <li class="nav-item">
                <a href="<?php echo site_url() ?>/site/logout" class="nav-link">
                    <i class="icon-logout"></i>
                    <span class="title">Cerrar sesión</span>
                </a>
            </li>
            <!--  todos -->


        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->        