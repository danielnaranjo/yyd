<?
/* variables */
    $title ="";
    // comienza el formulario
    $model = 'client';
    $action = '';
    $ejecutar ="created";
    $nivel = 2;

    $titulo="Nuevo";
    $btn = "Agregar nuevo";
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>">Home </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?php echo site_url() ?>/<?php echo $model ?>/all">
                        <span style="text-transform: capitalize;">
                            <?php echo $model ?>
                        </span>
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span><?=$titulo?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <div class="row">
            <div class="col-md-12">
                <h3> </h3>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase"><?=$titulo?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet-body form">
                                <? echo json_encode($fields)?>
                                <?php echo form_open($model.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]); ?>
                                    <?php require_once('formulario.php');// campos ?>
                                    <?php makeaform($fields, $model, $nivel, $action, $btn, '') ?>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>