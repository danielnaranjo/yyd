<?php
if ($this->session->userdata('logged_in') == FALSE) {
    redirect(site_url().'?msg=Por+favor+verifica+los+datos+de+acceso', 'refresh');
}
/* variables */
$nivel = $this->session->userdata('level');
$options = array( '0' => 'Administrador', '1' => 'Manager', '2' => 'Broker' );
$titulo=$options[$nivel];
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>YYD Group</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
         -->

        <link href="<?php echo base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url()?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url()?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/pages/css/blog.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/pages/css/portfolio.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/pages/css/invoice.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url()?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url()?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        <style> .amcharts-chart-div a { /* quita el credito */  display: none !important; } </style>

    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">

                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="/">
                        <img src="<?php echo base_url()?>assets/pages/img/logo-05.png" alt="logo" class="logo-default" /> </a>
                    <!--<div class="menu-toggler sidebar-toggler"> </div>-->
                </div>
                <!-- END LOGO -->
                
                <!-- BEGIN HEADER SEARCH BOX -->
                <? echo form_open('client/results', ['class'=>"search-form", 'role'=>"form"]); ?>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar cliente" name="q" id="q" autocomplete="off">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                <? echo form_close(); ?>
                <!-- END HEADER SEARCH BOX -->

                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->

                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">

                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="<?php echo base_url()?>upload/avatar.png" />
                                <span class="username username-hide-on-mobile"> <?php echo $this->session->userdata('firstname') .' '.$this->session->userdata('lastname') ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-lock"></i> Perfil: <?php echo $titulo ?>
                                    </a>
                                </li>
                                <?php if($this->session->userdata('project')!='') { ?>
                                <li style="overflow: hidden;">
                                    <a href="javascript:;">
                                        <i class="fa fa-building"></i> <?php echo $this->session->userdata('project') ?>
                                    </a>
                                </li>
                                <? } ?>
                                <li>
                                    <a href="<?php echo site_url() ?>/administrator/action/edit/<?php echo $this->session->userdata('aID') ?>">
                                        <i class="fa fa-pencil"></i> Editar Perfil 
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="<?php echo site_url() ?>/site/logout">
                                        <i class="icon-logout"></i> Cerrar sesión </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a href="<?php echo site_url() ?>/site/logout" class="dropdown-toggle">
                                <i class="icon-logout"></i>
                            </a>
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        
        <!-- BEGIN CONTENT (block) -->