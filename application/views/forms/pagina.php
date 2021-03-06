<?
/* variables */
$title ="";
// comienza el formulario
$model = $this->uri->segment(1);
$action = $this->uri->segment(3);
$nivel = $this->session->userdata('level');
    if($nivel==1) {
        $property_id = $this->session->userdata('property_id');
    } else {
        $property_id = $this->input->get("property_id");
    }
    if($action=='edit'){
        $titulo="Modificar";
        $btn = "Guardar";
        $ejecutar ="update"; //"update/".$this->uri->segment(4);
    } else if($action=='upload'){
        $titulo="Cargar imagen";
        $btn = "Subir imagen";
        $ejecutar ="upload"; //"update/".$this->uri->segment(4);
    } else {
        $titulo="Nuevo";
        $btn = "Guardar";
        $ejecutar = "add";
    }

//$Id=1;
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
                            <?php echo traducir($model); ?>
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
                <h3> 

                </h3>
                <div class="actions pull-right">
                    <div class="btn-group">
                        <a class="btn dark btn-outline" href="javascript:history.back();">
                            <i class="fa fa-chevron-left"></i>
                            Volver atras
                        </a>
                    </div>
                </div>

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
                                <!-- necesario si hay upload files -->
                                <?php 
                                    if (!preg_match("/_photo/i", $model) ) {
                                        echo form_open($model.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]);
                                    } else {
                                        echo form_open_multipart($model.'/'.$ejecutar.'/'.$property_id, ['class'=>"form-horizontal", 'role'=>"form"]);
                                    }
                                ?>
                                    <?php require_once('formulario.php');// campos ?>
                                    <?php makeaform($fields, $model, $nivel, $action, $btn, $tables, $property_id) ?>
                                <?php echo form_close();?>
                            </div>
                        </div>
                        <?php /*if($model=='client') { ?>
                        <div class="col-md-6">
                            <div class="portlet-body form">
                                <?php echo form_open($model.'_info'.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]); ?>
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
                        <? }*/ ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.onload = function(){
    <?php if($action=='edit') {?>
    var data = <? echo json_encode($result) ?>;
    console.log('fire', data);
    $.each(data, function (index, value) {
        $('#'+index).val(value);
    });
    $('#password').val('');
    <?php } ?>
    <?php  
        if($this->uri->segment(4)!='' && $model=='administrator' && $nivel!=0) { ?>
        $('#property_id').parent().parent().attr('style','display:none;');
        $('#property_id').replaceWith('<input type="hidden" value="<?=$property_id ?>" id="property_id" name="property_id" />');
    <?php } ?>

    <?php if($action=='upload') {?>
        $("#btn<?=strtoupper($action)?>").attr('disabled',true);
        $("input:file").change(function (){
            var fileName = $(this).val();
            $("#btn<?=strtoupper($action)?>").removeAttr('disabled');
        });
    <?php } ?>

    <?php if($action=='new') {?>
        $("#btn<?=strtoupper($action)?>").attr('disabled',true);
        $("input").change(function (){
            $("#btn<?=strtoupper($action)?>").removeAttr('disabled');
        });
    <?php } ?>

    <?php  
        if($this->uri->segment(4)!='' && $model=='property_amenities') { ?>
        $('#property_id').parent().parent().attr('style','display:none;');
        $('#property_id').replaceWith('<input type="hidden" value="<?=$this->uri->segment(4)?>" id="property_id" name="property_id" />');
        console.log(<?=$this->uri->segment(4)?>)
    <?php } ?>

    <?php  
        if($this->uri->segment(4)!='' && $model=='property_photo') { ?>
        $('#property_id').parent().parent().attr('style','display:none;');
        $('#property_id').replaceWith('<input type="hidden" value="<?=$this->uri->segment(4)?>" id="property_id" name="property_id" />');
        console.log(<?=$this->uri->segment(4)?>)
    <?php } ?>
};
</script>