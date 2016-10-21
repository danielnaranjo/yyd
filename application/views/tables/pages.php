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
                    <span style="text-transform: capitalize;"><?php echo $title ?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title" style="text-transform: capitalize;"> <?php echo $title ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <?php if($model=='property_photo') { ?>
                                        <a href="<? echo site_url()?>/<?php echo $model ?>/action/upload" id="" class="btn green"> Cargar imagen
                                            <i class="fa fa-upload"></i>
                                        </a>
                                        <?php } else if($model=='client') { ?>
                                        <a href="<? echo site_url()?>/<?php echo $model ?>/action/create" id="" class="btn green"> Nuevo comprador
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <?php } else { ?>
                                        <a href="<? echo site_url()?>/<?php echo $model ?>/action/new" id="" class="btn green"> Agregar nuevo
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_1">
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
                                                // property_unity
                                                && !preg_match("/_unity_id/i", $field->name)
                                                && !preg_match("/comission/i", $field->name)
                                                && !preg_match("/flat/i", $field->name)
                                                && !preg_match("/square/i", $field->name)

                                            ) {  // campos con "_id" ?>
                                            <th style="text-transform: capitalize;" id="<? echo $field->name ?>"> 
                                                <?php 
                                                    echo traducir($field->name);
                                                ?> 
                                            </th>
                                        <? } ?>
                                    <? } ?>
                                    <th>
                                    <?php //if($this->session->userdata('level')==1) { ?> 
                                        Opciones 
                                    <? //} ?>
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
                                                // property_unity
                                                && !preg_match("/_unity_id/i", $f->name)
                                                && !preg_match("/comission/i", $f->name)
                                                && !preg_match("/flat/i", $f->name)
                                                && !preg_match("/square/i", $f->name)

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
                                        <i class="fa fa-eye"></i> 
                                        <a class="view" href="<? echo site_url() ?>/<?php echo $model ?>/profile/<? echo $r[$model.'_id']?>">
                                            Ver perfil
                                        </a>

                                        <?php if($nivel!=0) { ?>
                                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
                                        <a class="view" href="javascript:;" onclick="javascript:visit(<? echo $r[$model.'_id']?>,1)">
                                            Visita
                                        </a>
                                        <? } ?>
                                        <? } ?>

                                        <?php if($model=="property") { ?>
                                        <i class="fa fa-eye"></i> 
                                        <a class="view" href="<? echo site_url()?>/<?php echo $model ?>/see/<? echo $r[$model.'_id']?>">
                                            Ver proyecto
                                        </a>
                                        <? } ?>

                                        <?php if($nivel!=2) { ?>
                                        <i class="fa fa-pencil"></i> 
                                        <a class="edit" href="<? echo site_url()?>/<?php echo $model ?>/action/edit/<? echo $r[$model.'_id']?>">
                                            Editar
                                        </a>
                                        <? } ?>
                                        
                                        <?php if($nivel==0) { ?>
                                        <i class="fa fa-trash"></i> 
                                        <a class="delete" href="javascript:;" onclick="javascript:check(<? echo $r[$model.'_id']?>);">
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
    if (confirm('Desea eliminar este registro?')) {
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