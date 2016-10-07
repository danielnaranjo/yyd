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
                                        <a href="<? echo site_url()?>/<?php echo $model ?>/action/new" id="" class="btn green"> Agregar nuevo
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <?php //echo json_encode($fields) ?>
                        <?php //echo json_encode($result) ?>
                        <table class="table table-striped table-hover table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <?php foreach ($fields as $field){ //campos ?>
                                        <?php 
                                            if (!preg_match("/_id/i", $field->name) 
                                                && !preg_match("/status/i", $field->name)  
                                                //&& !preg_match("/level/i", $field->name) 
                                                && !preg_match("/password/i", $field->name)
                                                && !preg_match("/description/i", $field->name)
                                                && !preg_match("/notes/i", $field->name)
                                                && !preg_match("/phone/i", $field->name)
                                                && !preg_match("/email/i", $field->name)

                                            ) {  // campos con "_id" ?>
                                            <th style="text-transform: capitalize;" id="<? echo $field->name ?>"> 
                                                <? echo $field->name ?> 
                                            </th>
                                        <? } ?>
                                    <? } ?>
                                    <th>
                                    <?php if($this->session->userdata('level')==1) { ?> 
                                        Opciones 
                                    <? } ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($result as $r) { // filas ?>
                                <tr>
                                    <?php foreach ($fields as $f) { // columnas ?>
                                        <?php 
                                            if (!preg_match("/_id/i", $f->name) 
                                                && !preg_match("/status/i", $f->name)  
                                                //&& !preg_match("/level/i", $f->name)  
                                                && !preg_match("/password/i", $f->name)
                                                && !preg_match("/description/i", $f->name)
                                                && !preg_match("/notes/i", $f->name)
                                                && !preg_match("/phone/i", $f->name)
                                                && !preg_match("/email/i", $f->name)
                                            ) {  // campos con "_id" ?>
                                            <td id="<?php echo $f->name ?>">
                                                <?php 
                                                    //echo $r[$f->name]; 
                                                    if (preg_match("/registered/i", $f->name) ) {
                                                        
                                                        $fecha = mysql_to_unix($r[$f->name]);
                                                        $now = time();
                                                        $units = 2;
                                                        echo timespan($fecha, $now, $units) . ' ago';

                                                    } else if (preg_match("/level/i", $f->name) ) {

                                                        if ($r['level']==0) {
                                                            echo 'Administrador';
                                                        } else if ($r['level']==1) {
                                                            echo 'Gerente de Proyecto';
                                                        } else { 
                                                            echo "Broker"; 
                                                        }

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
                                            <i class="fa fa-eye"></i> Ver perfil
                                        </a>
                                        <? } ?>

                                        <?php if($model=="property") { ?>
                                        <a class="view" href="<? echo site_url()?>/<?php echo $model ?>/see/<? echo $r[$model.'_id']?>">
                                            <i class="fa fa-eye"></i> Ver proyecto
                                        </a>
                                        <? } ?>


                                        <?php if($nivel!=2) { ?>
                                        <a class="edit" href="<? echo site_url()?>/<?php echo $model ?>/action/edit/<? echo $r[$model.'_id']?>">
                                            <i class="fa fa-pencil"></i> Editar
                                        </a>
                                        <? } ?>
                                        
                                        <?php if($nivel==0) { ?>
                                        <a class="delete" href="javascript:;" onclick="javascript:check(<? echo $r[$model.'_id']?>);">
                                           <i class="fa fa-trash"></i> Borrar
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
        //window.location.href="<? echo site_url()?>/<?php echo $model ?>/delete/"+id;
        toastr.success('Acción ejecutada con exito!')
    } else {
        return false;
    }
}
</script>