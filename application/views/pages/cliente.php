<?
/* variables */
$nivel = $this->session->userdata('level');

/* General para ambos formularios */
$options = array('1'=>'Reserva','2'=>'Firma CCV','3'=>'Cuota','4'=>'Posesión');
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
                        <div class="col-md-7">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <span class="caption-subject font-blue-madison bold uppercase">Transacciones</span>
                                        <a data-toggle="modal" href="#transactions" ><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable table-scrollable-borderless" style="max-height:500px;overflow-y:auto;">
                                        <table class="table table-hover table-light">
                                            <thead>
                                                <tr class="uppercase">
                                                    <th> BROKER </th>
                                                    <th> MONTO </th>
                                                    <th> FORMA DE PAGO </th>
                                                    <th> FECHA </th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?
                                                // Sumamos todos los pagos y restamos el monto total de la propiedad
                                                $montoventa=$unity[0]['price'];
                                                $pagado=0;
                                                $restante=0;
                                                $deuda=0;
                                            ?>
                                            <?php foreach($transactions as $m) {?>
                                            <tr>
                                                <td> <?php echo $m['lastname'] ?> </td>
                                                <td> $<?php echo number_format($m['amount'],2); $pagado+=$m['amount']; ?> </td>
                                                <td> <?php echo $m['bank']; ?>. <?=strtoupper($options[$m['transaction_type']]) ?></td>
                                                <td> <?php echo nice_date($m['date'],'d/m/Y') ?> </td>
                                                <td>
                                                    <?php if($nivel!=2) { ?>
                                                    <a data-toggle="modal" href="#basic" class="primary-link"> <i class="fa fa-search"></i></a>
                                                    <a class="edit" href="javascript:edit(<?=$m['transaction_id']?>);"> <i class="fa fa-pencil"></i></a>
                                                    <a class="delete" href="javascript:;" onclick="javascript:check(<?=$m['transaction_id']?>);"> <i class="fa fa-trash"></i></a>
                                                <?php }  ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php if(count($transactions)==0) { ?>
                                            <tr>
                                                <td colspan="4">
                                                    No hay transacciones
                                                </td>
                                            </tr>
                                            <?php }  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                        <?php }  ?>
                        <div class="col-md-5">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">INFORMACION DE VENTA</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div id="chart_6" style="width:100%;height:200px;"></div>
                                        <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                            <table class="table table-hover table-light" style="margin-top:10px" >
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th> DETALLE </th>
                                                        <th>  </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> Precio de venta:</td>
                                                        <td>
                                                            <strong>$<?=number_format($montoventa,2)?></strong>
                                                         </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Adeuda: </td>
                                                        <td>
                                                            <strong style="color:#f00">$<? $restante=$montoventa-$pagado; echo number_format($restante,2); ?></strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Pagado a la fecha: </td>
                                                        <td>
                                                            <strong style="color:#0a942d">$<?=number_format($pagado,2)?></strong>
                                                         </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <?//=$deuda?> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php if($nivel!=2) {?>
                    </div>
                    <div class="row">
                    <? } ?>
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
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=> $property[0]['property_id']))?>
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
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=> $property[0]['property_id']))?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id','value'=> @$unity[0]['property_unity_id']))?>
                    <?=form_input(array('type'=>'hidden','name'=>'broker_id','id'=>'broker_id','value'=> $this->session->userdata('aID')))?>
                    <?=form_input(array('type'=>'hidden','name'=>'client_id','id'=>'client_id','value'=> $result[0]['client_id']))?>

                    <div class="form-group">
                        <?=form_label('Tipo de pago','Tipo de pago', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?= form_dropdown(array('name'=>'transaction_type','id'=>'transaction_type','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Tipo de pago'),$options)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Forma de pago','Forma de pago', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <? //$options = array('0'=>'Efectivo','1'=>'Transferencia','2'=>'Cheque','3'=>'Tarjeta de Credito','4'=>'Otros'); ?>

                        <?php foreach ($bank as $b) {
                            $payment[$b['bank_id']]=$b['name'];
                            }
                        ?>
                        <?= form_dropdown(array('name'=>'payment_type','id'=>'payment_type','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Forma de pago'),$payment)?>
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
                        <small class="help-block">Opcional</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Fecha','Fecha', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?= form_input(array('name'=>'date','id'=>'date','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Fecha de transacción', 'type'=>'date'))//, 'value'=>date('Y-m-d H:i:s')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Comentarios','Comentarios', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_textarea(array('name'=>'notes','id'=>'notes','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Comentarios'))?>
                        <small class="help-block">Opcional</small>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <?=form_submit('SubmitTrans', 'Guardar', ['class'=>'btn blue','id'=>'SubmitTrans','onclick'=>'addTransaction()'])?>
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
                                    <li> <?php echo $info[0]['address'] ?> </li>
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
                                        Parking: <?php
                                            //if(@$parking!='' && $parking[0]) {
                                                echo $parking['number'];
                                            //} else {
                                            //    echo "0";
                                            //}
                                        ?></strong>
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
                                            <th> METODO / TRANSACCION </th>
                                            <th> FECHA </th>
                                        </tr>
                                    </thead>
                                    <?php $total=0; foreach($transactions as $m) {?>
                                    <tr>
                                        <td> USD $<?php echo number_format($m['amount'],2); $total += $m['amount']; ?> </td>
                                        <td>
                                            <?php echo $m['bank'] ?> <?php if($m['number']!='') { echo 'Ref. '.$m['number']; } ?>.
                                            <?=strtoupper($options[$m['transaction_type']]) ?>
                                        </td>
                                        <td> <?php echo nice_date($m['date'],'d/m/Y') ?> </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-4 invoice-block">
                                <ul class="list-unstyled amounts">
                                    <!--<li>
                                        <strong>Sub - Total amount:</strong> USD $0.00
                                    </li>-->
                                    <li>
                                        <strong>Total:</strong> USD $<?=number_format($total,2) ?>
                                    </li>
                                </ul>
                                <br/><br/><br/>
                                <a class="btn blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Imprimir
                                    <i class="fa fa-print"></i>
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

<div class="modal fade" id="transactionEdit" tabindex="-1" role="note" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Transacciones</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('', ['id'=>"editar", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <div class="form-group">
                        <?=form_label('Tipo de pago','Tipo de pago', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?= form_dropdown(array('name'=>'transaction_type','id'=>'transaction_type','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Tipo de pago'),$options)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Forma de pago','Forma de pago', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?php foreach ($bank as $b) {
                            $payment[$b['bank_id']]=$b['name'];
                            }
                        ?>
                        <?= form_dropdown(array('name'=>'payment_type','id'=>'payment_type','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Forma de pago'),$payment)?>
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
                        <small class="help-block">Opcional</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Fecha','Fecha', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?= form_input(array('name'=>'date','id'=>'date','class'=> 'form-control date-picker','autocomplete'=>'off','placeholder'=>'Fecha de transacción'))?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Comentarios','Comentarios', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_textarea(array('name'=>'notes','id'=>'notes','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Comentarios'))?>
                        <small class="help-block">Opcional</small>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <?=form_submit('Submit', 'Guardar', ['class'=>'btn blue','id'=>'Submited'])?>
                            </div>
                        </div>
                    </div>
                    <?= form_input(array('name'=>'transaction_id', 'id'=>'transaction_id', 'type'=> 'hidden', ))?>
                <?php echo form_close();?>
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
        }).fail(function(err) {
            toastr.error('Ha ocurrido un problema');
            console.error('data', err);
        });
    }
    //if (jQuery().datepicker) {
        $('#date').datepicker({
            format:{
                toDisplay: function (date, format, language) {
                    var d = new Date(date);
                    d.setDate(d.getDate());
                    return d.toISOString();
                },
                toValue: function (date, format, language) {
                    var d = new Date(date);
                    d.setDate(d.getDate());
                    return new Date(d);
                }
            }
             /*'yyyy-mm-dd'*/,
            autoclose: true,
            todayBtn: 'linked',
            todayHighlight: true
        });
    //}



}//end window.onload
var edit = function(id){
    console.log('Edit on ', id);
    $('#transactionEdit form')[0].reset();
    $('#transactionEdit select option').removeAttr('selected');
    var formId = "#editar";
    $.getJSON('<?=site_url() ?>/transaction/view/'+id, function(data) {
        console.debug('data',data);
        $(formId +" #transaction_id").val(data.transaction_id);
        $(formId +" #notes").val(data.notes);
        $(formId +" #amount").val(data.amount);
        $(formId +" #number").val(data.number);
        $(formId +" #date").val(data.date);
        //$(formId +' #transaction_type option:selected').val(data.transaction_type).prop('selected', true);
        //$(formId +' #payment_type option:selected').val(data.payment_type).prop('selected', true);
        $(formId +' #transaction_type').val(data.transaction_type).prop('selected', true);
        $(formId +' #payment_type').val(data.payment_type).prop('selected', true);

        $('#transactionEdit').modal('show');
    });
    $("#transactionEdit #editar #Submited").click(function(event) {
        event.preventDefault();
        var params = {
            'transaction_id' : $(formId +" #transaction_id").val(),
            'notes' : $(formId +" #notes").val(),
            'amount' : $(formId +" #amount").val(),
            'number' : $(formId +" #number").val(),
            'transaction_type' : $(formId +" #transaction_type").val(),
            'payment_type' : $(formId +" #payment_type").val(),
            'date' : $(formId +" #date").val(),
        }
        console.log('params', params);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>/transaction/modify",
            dataType: 'json',
            data: params,
        }).done(function(res){
            console.log('success',res);
            if(res) {
                toastr.success('Información actualizada!');
                //console.log(res);
                $('#transactionEdit').modal('hide');
                setTimeout(function(){
                    location.reload()
                }, 3000);
            }
        }).fail(function(err){
            toastr.error('Ha ocurrido un error');
            console.log('error',err);
        });/**/
    });
}//edit transactionEdit

var addTransaction = function(){
    //$("#transactions #addmoney #SubmitTrans").on('click',function(event) {
        console.log('#transactions #addmoney #SubmitTrans clicked');
        //event.preventDefault();
        var params = {
            'property_id' : $("#property_id").val(),
            'property_unity_id' : $("#property_unity_id").val(),
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
                    //$('#transactions').modal('hide');
                    setTimeout(function(){
                        location.reload()
                    }, 3000);
                }
            },
            fail: function(xhr, status, error) {
                toastr.error('Ha ocurrido un problema');
                console.error('data', err);
            }
        });
    //});
}//addTransaction

var addNote = function(){
    //$("#Submit").click(function(event) {
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
            },
            fail: function(xhr, status, error) {
                toastr.error('Ha ocurrido un problema');
                console.error('data', err);
            }
        });
    //});
}

function check(id){
    // confirm delete or not
    if (confirm('Desea eliminar este registro?','Acción requerida')) {
        //window.location.href="<? echo site_url()?>/transaction/delete/"+id;
        jQuery.ajax({
            type: "GET",
            url: "<?php echo site_url(); ?>/transaction/delete/"+id,
        }).done(function(res){
            if(res) {
                toastr.success('Acción ejecutada con exito!');
                setTimeout(function(){
                    location.reload()
                }, 3000);
            }
        }).fail(function(err){
            toastr.error('Ha ocurrido un error');
            console.log('error',err);
        });

        //location.reload();
    } else {
        return false;
    }
}//check


window.onload = function(){
    var chartData = [{
      type: "Pagado",
      percent: <?=$pagado?>,
      color: "#0a942d",
    },{
      type: "Restante",
      percent: <?=$restante?>,
      color: "#f00",
    }];
    AmCharts.makeChart("chart_6", {
        "type": "pie",
        "theme": "light",
        "dataProvider": chartData,
        "titleField": "type",
        "valueField": "percent",
        "pullOutRadius": 0,
        "labelRadius": -22,
        "labelText": "[[percents]]%",
        "balloonText": "[[title]]: $[[value]]",
        "percentPrecision": 1,
        "colorField": "color",
    });
}
</script>
