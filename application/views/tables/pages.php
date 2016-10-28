<?
/* variables */

// comienza el formulario
$model = $this->uri->segment(1);
$action = $this->uri->segment(2);
// niveles de usuario
$nivel = $this->session->userdata('level');

if($titulo==''){
    $title=$model;
} else {
    $title=$titulo;
}

    if($this->uri->segment(3)==''){
        $Id = $this->session->userdata('property_id');
    } else {
        $Id = $this->uri->segment(3);
    }
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span style="text-transform: capitalize;"><?php echo traducir($title) ?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title" style="text-transform: capitalize;"> 
            <?php echo $title ?>
            <?php if($model!='bank' && $model!='administrator' && $model!='client') { ?>
            <div class="actions pull-right">
                <div class="btn-group">
                    <? if($nivel!=0) { ?>
                    <a class="btn dark btn-outline" href="<?php echo site_url() ?>/property/see/<?php echo $Id ?>">
                        <i class="fa fa-chevron-left"></i>
                        Volver atras
                    </a>
                    <a class="btn dark btn-outline" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-eye"></i> Ver Unidades
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="<?php echo site_url() ?>/property/unities/<?php echo $Id ?>">
                                <i class="fa fa-building"></i> Ver <?php if($nivel!=2) { ?>/ Agregar<?php } else { echo "Unidades"; } ?> 
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>/property/details/<?php echo $Id ?>">
                                <i class="fa fa-user"></i> Detalles
                            </a>
                        </li>
                    </ul>
                    <? } ?>
                </div>
            </div>
            <? } ?>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <?php //if($nivel==0) { ?>
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <?php if($model=='property_photo' && $nivel!=2) { ?>
                                        <a href="<? echo site_url()?>/<?php echo $model ?>/action/upload/<?=$Id?>" id="" class="btn green"> Cargar imagen
                                            <i class="fa fa-upload"></i>
                                        </a>
                                        <?php } ?>
                                        <?php if($model=='client') { ?>
                                        <a href="<? echo site_url()?>/<?php echo $model ?>/create" id="" class="btn green"> Nuevo comprador
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <?php } ?>
                                        <?php if($model!='client' && $nivel!=2 && $model!='property_photo' && $model!='property_parking') { ?>
                                        <a href="<? echo site_url()?>/<?php echo $model ?>/action/new/<?php echo $Id ?>" id="" class="btn green"> Agregar nuevo
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <? //} ?>
                        <table class="table table-striped table-hover table-bordered" id="sample_2">
                            <thead>
                                <tr>
                                    <?php foreach ($fields as $field){ //campos ?>
                                        <?php 
                                            if (!preg_match("/".$model."_id/i", $field->name) // Muestra todo, excepto el model_id de la tabla
                                                && !preg_match("/status/i", $field->name)  
                                                //&& !preg_match("/level/i", $field->name) 
                                                && !preg_match("/password/i", $field->name)
                                                && !preg_match("/description/i", $field->name)
                                                && !preg_match("/notes/i", $field->name)
                                                && !preg_match("/phone/i", $field->name)
                                                && !preg_match("/email/i", $field->name)
                                                // property
                                                && !preg_match("/floors/i", $field->name)
                                                && !preg_match("/unities/i", $field->name)
                                                && !preg_match("/lobby/i", $field->name)
                                                && !preg_match("/coordinates/i", $field->name)
                                                && !preg_match("/parking/i", $field->name)
                                                // property_unity
                                                && !preg_match("/_unity_id/i", $field->name)
                                                && !preg_match("/comission/i", $field->name)
                                                && !preg_match("/flat/i", $field->name)
                                                && !preg_match("/square/i", $field->name)
                                                // photos
                                                && !preg_match("/caption/i", $field->name)

                                            ) {  // campos con "_id" ?>
                                            <th style="text-transform: capitalize;" id="<? echo $field->name ?>"> 
                                                <?php 
                                                    echo traducir($field->name);
                                                ?> 
                                            </th>
                                        <? } ?>
                                    <? } ?>
                                    <th>
                                        Opciones 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($result as $r) { // filas ?>
                                <tr>
                                    <?php foreach ($fields as $f) { // columnas ?>
                                        <?php 
                                            if (
                                                !preg_match("/".$model."_id/i", $f->name) // Muestra todo, excepto el model_id de la tabla
                                                && !preg_match("/status/i", $f->name)  
                                                //&& !preg_match("/level/i", $f->name)  
                                                && !preg_match("/password/i", $f->name)
                                                && !preg_match("/description/i", $f->name)
                                                && !preg_match("/notes/i", $f->name)
                                                && !preg_match("/phone/i", $f->name)
                                                && !preg_match("/email/i", $f->name)
                                                && !preg_match("/status/i", $f->name)
                                                // property
                                                && !preg_match("/floors/i", $f->name)
                                                && !preg_match("/unities/i", $f->name)
                                                && !preg_match("/lobby/i", $f->name)
                                                && !preg_match("/coordinates/i", $f->name)
                                                && !preg_match("/parking/i", $f->name)
                                                // property_unity
                                                && !preg_match("/_unity_id/i", $f->name)
                                                && !preg_match("/comission/i", $f->name)
                                                && !preg_match("/flat/i", $f->name)
                                                && !preg_match("/square/i", $f->name)
                                                // photos
                                                && !preg_match("/caption/i", $f->name)

                                            ) {  // campos con "_id" ?>
                                            <td id="<?php echo $f->name ?>">
                                                <?php 
                                                    //echo $r[$f->name]; 
                                                    if (preg_match("/registered/i", $f->name) ) {
                                                        /*
                                                        $fecha = mysql_to_unix($r[$f->name]);
                                                        $now = time();
                                                        $units = 2;
                                                        echo 'Hace '.timespan($fecha, $now, $units);
                                                        */
                                                        echo mdate('%d/%m/%Y %h:%i %a', strtotime($r[$f->name]));

                                                    } else if (preg_match("/level/i", $f->name) ) {

                                                        if ($r['level']==0) {
                                                            echo 'Administrador';
                                                        } else if ($r['level']==1) {
                                                            echo 'Gerente de Proyecto';
                                                        } else { 
                                                            echo "Broker"; 
                                                        }

                                                    } else if (preg_match("/file/i", $f->name) ) {

                                                        $imagen = array(
                                                            'src'   => base_url().'/upload/'.$r['file'],
                                                            'class' => 'img_responsive',
                                                            'width' => '200',
                                                            'height'=> '200',
                                                        );
                                                        echo img($imagen);

                                                    } else if(preg_match("/price/i", $f->name) || preg_match("/amount/i", $f->name)) {

                                                        echo 'USD $'.number_format($r[$f->name],2);

                                                    } else if (preg_match("/property_id/i", $f->name) ) {
                                                        /**/
                                                        if($r[$f->name]!=0){
                                                            echo $property[$r[$f->name]-1]['name'];
                                                        } else {
                                                            echo "YYD Group";
                                                        }
                                                        //echo $r[$f->name];

                                                    } else {
                                                        echo $r[$f->name];
                                                    }
  
                                                ?>
                                            </td>
                                        <? } ?>
                                    <? } ?>

                                    <td>
                                        <!-- 
                                        ver perfil
                                        ver propiedad
                                        ver compradores
                                        -->
                                        <?php if($model=="client") { ?>
                                        <a class="view" href="<? echo site_url() ?>/<?php echo $model ?>/profile/<? echo $r[$model.'_id']?>">
                                            <i class="fa fa-eye"></i> 
                                            Ver <? if($nivel==2) { ?>perfil<? } else { ?>/ Editar<? } ?>
                                        </a>

                                        <?php /*if($nivel!=0) { ?>
                                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
                                        <a class="view" href="javascript:;" onclick="javascript:visit(<? echo $r[$model.'_id']?>,1)">
                                            Visita
                                        </a>
                                        <? } */?>
                                        <? } ?>

                                        <?php if($model=="property") { ?>
                                        <a class="view" href="<? echo site_url()?>/<?php echo $model ?>/see/<? echo $r[$model.'_id']?>">
                                            <i class="fa fa-eye"></i> 
                                            Ver <? if($nivel==2) { ?>proyecto<? } else { ?>/ Editar<? } ?>
                                        </a>
                                        <? } ?>

                                        <?php if($nivel!=2 && $model!='property' && $model!="client") { ?>
                                        <a class="edit" href="<? echo site_url()?>/<?php echo $model ?>/action/edit/<? echo $r[$model.'_id']?>">
                                            <i class="fa fa-pencil"></i> 
                                            Editar
                                        </a>
                                        <? } ?>
                                        
                                        <?php if($nivel==0) { ?>
                                        <a class="delete" href="javascript:;" onclick="javascript:check(<? echo $r[$model.'_id']?>);">
                                            <i class="fa fa-trash"></i> 
                                           Borrar
                                        </a>
                                        <? } ?>
                                    </td>
                                   
                                </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<script>
function check(id){
    // confirm delete or not
    if (confirm('Desea eliminar este registro?','Acción requerida')) {
        window.location.href="<? echo site_url()?>/<?php echo $model ?>/delete/"+id;
        toastr.success('Acción ejecutada con exito!');
    } else {
        return false;
    }
}
function visit(c,p){
    $.ajax({
        url: "<? echo site_url() ?>/<?php echo $model ?>/visited",
        method: "POST",
        data: { client_id: c, property_id: p }
    }).done(function(data) {
        console.log('data', data);
        toastr.success('Visita registrada!');
    });
}
</script>