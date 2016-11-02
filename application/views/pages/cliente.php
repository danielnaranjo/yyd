<?
/* variables */
$nivel = $this->session->userdata('level');
?>
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
                    <a href="<?php echo site_url() ?>/client/all">Compradores</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span><?php echo $result[0]['lastname'].', '. $result[0]['firstname'] ?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">
        <?php echo @$property[0]['name'] ?>
            <div class="actions pull-right">
                <div class="btn-group">
                    <a class="btn dark btn-outline" href="javascript:history.back();">
                        <i class="fa fa-chevron-left"></i>
                        Volver atras
                    </a>
                    <a class="btn dark btn-outline" href="<? echo site_url()?>/client/edit/<?php echo $result[0]['client_id'] ?>">
                        <i class="fa fa-pencil"></i>
                        Editar perfil
                    </a>
                </div>
            </div>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="<?php echo base_url() ?>upload/avatar.png" class="img-responsive" alt="">
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> <?php echo $result[0]['firstname'].' '. $result[0]['lastname'] ?> </div>
                            <div class="profile-usertitle-job"> <?php echo @$info[0]['country'] ?> </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->

                    </div>
                    <!-- END PORTLET MAIN -->
                    <!-- PORTLET MAIN -->
                    <div class="portlet light ">
                        <!-- STAT -->
                        <? if(count($unity)>0) { ?>
                        <div class="row list-separated profile-stat">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $unity[0]['number'] ?> </div>
                                <div class="uppercase profile-stat-text"> Unidad </div>
                            </div>
                            <!--<div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="uppercase profile-stat-title"> <?php echo $unity[0]['total_feet'] ?> </div>
                                <div class="uppercase profile-stat-text"> Pies </div>
                            </div>-->
                            
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php if($parking['number']!='') { echo $parking['number']; } else { echo "0"; } ?> </div>
                                <div class="uppercase profile-stat-text"> Parking </div>
                            </div>
                        </div>
                        <? } else { /*?>
                        <div>
                            <div class="margin-top-20 margin-bottom-30 profile-desc-text">
                                <a href="/" class="btn btn-default btn-block">Agregar unidad</a>
                            </div>
                        </div>
                        <? */ } ?>
                        <!-- END STAT -->
                        <? if(count($info)>0) { ?>
                        <div>
                            <h4 class="profile-desc-title">Información</h4>
                            <span class="profile-desc-text">
                                <!-- descripcion -->
                            </span>
                            <? if($info[0]['address']!='') { ?>
                            <div class="margin-top-20 profile-desc-text">
                                Dirección: <?php echo $info[0]['address'] ?>. <?php echo $info[0]['city'].', '.$info[0]['country'] ?>
                            </div>
                            <? } ?>
                            <? if($info[0]['phone']!='') { ?>
                            <div class="margin-top-20 profile-desc-text">
                                Teléfono: <?php echo auto_link($info[0]['phone']) ?>
                            </div>
                            <? } ?>
                            <? if($info[0]['email']!='') { ?>
                            <div class="margin-top-20 profile-desc-text">
                                E-mail: <?php echo mailto($info[0]['email'], $info[0]['email']) ?>
                            </div>
                            <? } ?>
                        </div>
                        <? } ?>
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <?php if($nivel!=2) {?>
                        <div class="col-md-6">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <span class="caption-subject font-blue-madison bold uppercase">Transacciones</span>
                                        <a data-toggle="modal" href="#transactions" ><i class="fa fa-pencil"></i></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable table-scrollable-borderless">
                                        <table class="table table-hover table-light">
                                            <thead>
                                                <tr class="uppercase">
                                                    <th> BROKER </th>
                                                    <th> MONTO </th>
                                                    <th> TRANSACCION </th>
                                                    <th> FECHA </th>
                                                </tr>
                                            </thead>
                                            <?php foreach($transactions as $m) {?>
                                            <tr>
                                                <td> <?php echo $m['lastname'] ?> </td>
                                                <td> $<?php echo number_format($m['amount'],2) ?> </td>
                                                <td> <a data-toggle="modal" href="#basic" class="primary-link"><?php echo $m['number'] ?></a> </td>
                                                <td> <?php echo $m['date'] ?> </td>
                                            </tr>
                                            <?php } ?>
                                            <?php if(count($transactions)==0) { ?>
                                            <tr>
                                                <td colspan="4">
                                                    No hay transacciones
                                                </td>
                                            </tr>
                                            <?php }  ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                        <?php }  ?>
                        <!--<div class="col-md-6">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">ACTIVIDAD</span>
                                        <a  data-toggle="modal" href="#note" ><i class="fa fa-pencil"></i></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                            <ul class="feeds">
                                            <?php if(count($notes)>0) { ?>
                                                <?php foreach ($notes as $n) { // columnas ?>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="">
                                                                    <i class="fa fa-check-square-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"><? echo $n['note'] ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 
                                                        <?php 
                                                            $fecha = mysql_to_unix($n['updated']);
                                                            $now = time();
                                                            $units = 2;
                                                            echo timespan($fecha, $now, $units) . ' ago';
                                                            //echo timespan($fecha, $now) . ' ago';
                                                        ?> 
                                                        </div>
                                                    </div>
                                                </li>
                                                <? } ?>
                                            <? } else { ?>
                                                <li>No hay notas disponibles</li>
                                            <? } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    <?php if($nivel!=2) {?>
                    </div>
                    <div class="row">
                    <? } ?>
                        <!--<div class="col-md-6">
                            <div class="portlet light portlet-fit " >
                                <div class="portlet-title" <?php if($nivel==2) {?>style="padding: 15px 20px 5px 20px !important;"<? } ?>>
                                    <div class="caption">
                                        <span class="caption-subject bold font-green uppercase"> Visitas</span>
                                        <a class="pull-right" href="javascript:;" onclick="javascript:visit(<? echo $result[0]['client_id']?>,1)">
                                            <i class="fa fa-check" aria-hidden="true"></i> 
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body" style="overflow-y: scroll;height: 500px;">
                                    <div class="timeline">
                                        <?php foreach($visits as $v) {?>
                                        <div class="timeline-item">
                                            <div class="timeline-badge">
                                                <div class="timeline-icon">
                                                    <?php if($v['activity']==1){ ?>
                                                    <i class="icon-user-following font-grey-cascade"></i>
                                                    <?php } else if($v['activity']==2){ ?>
                                                    <i class="icon-user-following font-green"></i>
                                                    <?php } else if($v['activity']==3){ ?>
                                                    <i class="icon-globe font-green-haze"></i>
                                                    <?php } else if($v['activity']==4){ ?>
                                                    <i class="icon-docs font-red-intense"></i>
                                                    <?php } else { ?>
                                                    <i class="icon-user-following font-green-haze"></i>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="timeline-body-arrow"> </div>
                                                <div class="timeline-body-head">
                                                    <div class="timeline-body-head-caption">
                                                        <span class="timeline-body-alerttitle font-green-haze">
                                                           <?php
                                                                if($v['activity']==1){ 
                                                                    echo "Nuevo cliente";
                                                                } else if($v['activity']==2){ 
                                                                    echo "Propiedad agregada";
                                                                } else if($v['activity']==3){ 
                                                                    echo "Visita";
                                                                } else if($v['activity']==1){ 
                                                                    echo "Pago registrado";
                                                                } else {
                                                                    echo "Consulta a la cuenta";
                                                                }
                                                            ?>
                                                        </span>
                                                        <span class="timeline-body-time font-grey-cascade">
                                                            <?php 
                                                                //echo $v['timestamp'];
                                                                $fecha = mysql_to_unix($v['timestamp']);
                                                                $now = time();
                                                                $units = 2;
                                                                echo timespan($fecha, $now, $units);
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="timeline-body-content">
                                                    <span class="font-grey-cascade">

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <?php if(count($visits)==0) { ?>
                                        <div class="timeline-item">
                                            <div class="timeline-badge">
                                                <div class="timeline-icon">
                                                    <i class="icon-puzzle font-green-haze"></i>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="timeline-body-arrow"> </div>
                                                <div class="timeline-body-head">
                                                    <div class="timeline-body-head-caption">
                                                        <span class="timeline-body-alerttitle font-green-haze">No tiene propiedades</span>
                                                        <span class="timeline-body-time font-grey-cascade"><?php echo date('d-m-Y') ?></span>
                                                    </div>
                                                </div>
                                                <div class="timeline-body-content">
                                                    <span class="font-grey-cascade">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php  } ?>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

<div class="modal fade" id="note" tabindex="-1" role="note" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Actividad</h4>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('', ['id'=>"addnote", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=> 1))?>
                    <?=form_input(array('type'=>'hidden','name'=>'broker_id','id'=>'broker_id','value'=> $this->session->userdata('aID')))?>
                    <?=form_input(array('type'=>'hidden','name'=>'client_id','id'=>'client_id','value'=> $result[0]['client_id']))?>
                    <div class="form-group">
                        <?=form_label('Comentarios','Comentarios', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_textarea(array('name'=>'note','id'=>'note','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Comentarios',))?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <?=form_submit('Submit', 'Agregar nota', ['class'=>'btn blue','id'=>'Submit'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="transactions" tabindex="-1" role="note" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Transacciones</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('', ['id'=>"addmoney", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=> 1))?>
                    <?=form_input(array('type'=>'hidden','name'=>'broker_id','id'=>'broker_id','value'=> $this->session->userdata('aID')))?>
                    <?=form_input(array('type'=>'hidden','name'=>'client_id','id'=>'client_id','value'=> $result[0]['client_id']))?>
                    
                    <div class="form-group">
                        <?=form_label('Tipo de pago','Tipo de pago', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <? $options = array('1'=>'Seña','2'=>'Cuota','3'=>'Reserva','4'=>'Contado'); ?>
                        <?= form_dropdown(array('name'=>'transaction_type','id'=>'transaction_type','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Tipo de pago'),$options)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Forma de pago','Forma de pago', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <? $options = array('0'=>'Efectivo','1'=>'Transferencia','2'=>'Cheque','3'=>'Tarjeta de Credito','4'=>'Otros'); ?>
                        <?= form_dropdown(array('name'=>'payment_type','id'=>'payment_type','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Monto'),$options)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Monto (USD)','Monto', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?= form_input(array('name'=>'amount','id'=>'amount','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Monto'))?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Numero','Numero', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?= form_input(array('name'=>'number','id'=>'number','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Numero'))?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Fecha','Fecha', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?= form_input(array('name'=>'date','id'=>'date','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Fecha de transacción', 'value'=>date('Y-m-d H:i:s')))?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Comentarios','Comentarios', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_textarea(array('name'=>'notes','id'=>'notes','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Comentarios'))?>
                        <small>Opcional</small>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <?=form_submit('Submit', 'Agregar pago', ['class'=>'btn blue','id'=>'Submit'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Resumen del Cliente</h4>
            </div>
            <div class="modal-body">
                <!-- BEGIN CONTENT  -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->

                    <!-- END PAGE HEADER-->
                    <div class="invoice">
                        <div class="row invoice-logo">
                            <div class="col-xs-6 col-xs-offset-6">
                                <p> 
                                    <?=date('d/m/Y')?>
                                </p>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-xs-4">
                                <h3>Cliente:</h3>
                                <ul class="list-unstyled">
                                    <li> <?php echo $result[0]['firstname'].' '. $result[0]['lastname'] ?> </li>
                                    <li> <?php echo $info[0]['address'] ?>.  </li>
                                    <li> <?php echo $info[0]['city'] ?> </li>
                                    <li> <?php echo @$info[0]['phone'] ?> </li>
                                    <li> <?php echo @$info[0]['country'] ?> </li>
                                </ul>
                            </div>
                            <div class="col-xs-4 col-xs-offset-4 invoice-payment">
                                <h3>Detalle:</h3>
                                <ul class="list-unstyled">
                                    <li>
                                        <?php echo @$property[0]['name'] ?>
                                    </li>
                                    <li>
                                        Unidad: #<?php echo $unity[0]['number'] ?>
                                    </li>
                                    <li>
                                        Superficie: <?php echo $unity[0]['total_feet'] ?> pies
                                    </li>
                                    <? if($parking>0) {?>
                                    <li>
                                        Parking: <?php echo $parking ?></strong> 
                                    </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="uppercase">
                                            <th> MONTO </th>
                                            <th> TRANSACCION </th>
                                            <th> FECHA </th>
                                        </tr>
                                    </thead>
                                    <?php $total=0; foreach($transactions as $m) {?>
                                    <tr>
                                        <td> USD $<?php echo number_format($m['amount'],2); $total += $m['amount']; ?> </td>
                                        <td> <?php echo $m['number'] ?> </td>
                                        <td> <?php echo $m['date'] ?> </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <!--<div class="col-xs-4">
                                <div class="well">
                                    <address>
                                        <strong>Loop, Inc.</strong>
                                        <br/> 795 Park Ave, Suite 120
                                        <br/> San Francisco, CA 94107
                                        <br/>
                                        <abbr title="Phone">P:</abbr> (234) 145-1810 </address>
                                    <address>
                                        <strong>Full Name</strong>
                                        <br/>
                                        <a href="mailto:#"> first.last@email.com </a>
                                    </address>
                                </div>
                            </div>-->
                            <div class="col-xs-8 col-xs-offset-4 invoice-block">
                                <ul class="list-unstyled amounts">
                                    <li>
                                        <strong>Sub - Total amount:</strong> USD $0.00 
                                    </li>
                                    <li>
                                        <strong>Total:</strong> USD $<?=number_format($total,2) ?>
                                    </li>
                                </ul>
                                <br/><br/><br/>
                                <a class="btn blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Imprimir
                                    <i class="fa fa-print"></i>
                                </a>
                                <a class="btn green hidden-print margin-bottom-5"> Enviar
                                    <i class="fa fa-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
window.onload = function(){
    function visit(c,p){
        $.ajax({
            url: "<? echo site_url() ?>/client/visited",
            method: "POST",
            data: { client_id: c, property_id: p }
        }).done(function(data) {
            console.log('data', data);
            toastr.success('Visita registrada!');
        });
    }
    $("#Submit").click(function(event) {
        event.preventDefault();
        var property_id = $("#property_id").val(),
            broker_id = $("#broker_id").val(),
            client_id = $("#client_id").val(),
            note = $("#note").val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>/note/add",
            dataType: 'json',
            data: { property_id: property_id, broker_id: broker_id, client_id: client_id, note: note },
            success: function(res) {
            if(res) {
                toastr.success('Información actualizada!');
                //form[0].reset();
                $('.modal form input, .modal form select, .modal form textarea').val('');
                $('#basic').modal('hide');
                }
            }
        });
    });

    $("#addmoney #Submit").click(function(event) {
        event.preventDefault();
        var params = { 
            'property_id' : $("#property_id").val(),
            'broker_id' : $("#broker_id").val(),
            'client_id' : $("#client_id").val(),
            'notes' : $("#notes").val(),
            'amount' : $("#amount").val(),
            'number' : $("#number").val(),
            'transaction_type' : $("#transaction_type").val(),
            'payment_type' : $("#payment_type").val(),
            'date' : $("#date").val(),
        }
        console.log('params', params);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>/transaction/add",
            dataType: 'json',
            data: params,
            success: function(res) {
                if(res) {
                    toastr.success('Información actualizada!');
                    console.log(res);
                    $('#transactions').modal('hide');
                }
            }
        });
    });
}
</script>