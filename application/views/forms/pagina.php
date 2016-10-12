<?
/* variables */
$title ="";
// comienza el formulario
$model = $this->uri->segment(1);
$action = $this->uri->segment(3);
$nivel = $this->session->userdata('level');

    if($action=='edit'){
        $btn = "Actualizar";
        $ejecutar ="update"; //"update/".$this->uri->segment(4);
    } else if($action=='upload'){
        $btn = "Subir imagen";
        $ejecutar ="upload"; //"update/".$this->uri->segment(4);
    } else {
        $btn = "Agregar nuevo";
        $ejecutar = "add";
    }
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
                    <span>Configuración</span>
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
                            <span class="caption-subject font-dark sbold uppercase">Configuración</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet-body form">
                                <!-- necesario si hay upload files -->
                                    <?php 
                                        if (!preg_match("/_photo/i", $model) ) {
                                            echo form_open($model.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]);
                                        } else {
                                            echo form_open_multipart($model.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]);
                                        }
                                    ?>
                                    <?php require_once('formulario.php');// campos ?>
                                    <?php makeaform($fields, $model, $nivel, $action, $btn, $tables) ?>
                                <?php echo form_close();?>
                            </div>
                        </div>
                        <?php if($model=='client') { ?>
                        <div class="col-md-6">
                            <div class="portlet-body form">
                                <?php echo form_open($model.'_info'.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]); ?>
                                    <?php //require_once('formulario.php');// campos ?>
                                    <?php makeaform($fieldsmore, $model.'_info', $nivel, $action, $btn, '') ?>
                                <?php echo form_close();?>
                            </div>
                        </div>
                        <script>
                            var datamore = <? echo json_encode($resultmore) ?>;
                            setTimeout(function(){
                                console.log('custom', datamore);
                                $.each(datamore, function (index, value) {
                                    $('#'+index).val(value);
                                    })
                                }, 300);
                        </script>
                        <? } ?>

                        <?php if($model=='client' && $action=='new') { ?>
                            <script>
                                setTimeout(function(){
                                    $('#email').removeAttr('disabled');
                                    $('.form-group label[for="registered"]').parent().attr('style','display:none;');
                                    $('.form-group label[for="status"]').parent().attr('style','display:none;');
                                }, 1);
                            </script>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var data = <? echo json_encode($result) ?>;
setTimeout(function(){
    console.log('fire', data);
    $.each(data, function (index, value) {
        $('#'+index).val(value);
        })
    }, 300);
</script>