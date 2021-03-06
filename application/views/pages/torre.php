<?
    $nivel = $this->session->userdata('level');
    if($this->uri->segment(3)==''){
        $Id = $this->session->userdata('property_id');
    } else {
        $Id = $this->uri->segment(3);
    }
?>
<style>
    .label {
        padding: 5px 10px;
    }
    ul {
        margin: 0;
        padding: 0;
    }
    ul li {
        list-style: none;
    }
</style>
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
                    <span><?php echo $titulo ?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">
            <?php echo $titulo ?>
            <div class="actions pull-right">
                <div class="btn-group">
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
                </div>
            </div>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <!--  funcion para pintar el edificio y sus unidades-->
                <?php
                    function makeatower($pisos, $lobby, $unidades, $propiedad){
                        $ouput ="";
                        $ouput.="<table class=\"table table-bordered table-hover\">";
                        // encabezado y pie
                        $ouput.="<tr>";
                        for($j=0; $j<=$unidades; $j++){
                            $ouput.="<td style=\"background-color:#2b3643;color:#fff;\">";
                            if($j>0){
                                $ouput.="<strong>".$j."</strong>";
                            }
                            $ouput.="</td>";
                        }
                        $ouput.="<td style=\"background-color:#2b3643;color:#fff;\"> </td>";// recuadro vacio
                        $ouput.="</tr>";
                        // pisos
                        for($i=$pisos; $i>=$lobby; $i--){
                            if($i!=13){
                                $ouput.="<tr>";
                                $ouput.="<td style=\"background-color:#2b3643;color:#fff;\"><strong>".$i."</strong></td>";// Pisos
                                for($j=1; $j<=$unidades; $j++){
                                    $ouput.="<td id=\"".$i.'0'.$j."\">";
                                    $ouput.="<a href=\"javascript:getInfo(".$i.'0'.$j.",".$propiedad.");\">";
                                    $ouput.=$i.'0'.$j;
                                    $ouput.="</a>";
                                    $ouput.="</td>";
                                    if($j==$unidades){
                                        $ouput.="<td style=\"background-color:#2b3643;color:#fff;\"><strong>".$i."</strong></td>";// Pisos
                                        $ouput.="</tr>";
                                    }
                                }
                            }
                        }
                        // encabezado y pie
                        $ouput.="<tr>";
                        for($j=0; $j<=$unidades; $j++){
                            $ouput.="<td style=\"background-color:#2b3643;color:#fff;\">";
                            if($j>0){
                                $ouput.="<strong>".$j."</strong>";
                            }
                            $ouput.="</td>";
                        }
                        $ouput.="<td style=\"background-color:#2b3643;color:#fff;\"> </td>";// recuadro vacio
                        $ouput.="</tr>";
                        $ouput.="</table>";
                        return $ouput;
                    }
                    echo makeatower($result['floors'],$result['lobby'],$result['unities'], $ID);
                    //echo json_encode($result);
                ?>
                <!--  funcion para pintar el edificio y sus unidades-->
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12" id="detalle">
                <div>
                    <span class="label label-default">No disponible <span class="badge" id="bagde-none">0</span></span>
                    <span class="label label-success">Disponible <span class="badge" id="bagde-free">0</span></span>
                    <span class="label label-warning">Reservada <span class="badge" id="bagde-reserved">0</span></span>
                    <span class="label label-danger">Vendida <span class="badge" id="bagde-sold">0</span></span>
                </div>
                <h3></h3>
                <p id="infoUnity">
                    <p class="alert alert-info" role="alert">Selecciona una unidad para ver mas información</p>
                </p>

                <div class="panel panel-default" id="action" style="display: none;">
                    <div class="panel-body">
                        <div class="col-sm-4" id="btnBuyer">
                            <a data-toggle="modal" href="#comprador" class="btn btn-block btn-success">
                                <!-- <i class="fa fa-user"></i> -->
                                Modificar
                            </a>
                        </div>
                        <div class="col-sm-4" id="btnMethod">
                            <a data-toggle="modal" href="#formasdepago" class="btn btn-block btn-info">
                                <!-- <i class="fa fa-pencil"></i> -->
                                Formas de pago
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a data-toggle="modal" href="#basic" class="btn btn-block btn-default">
                                <!-- <i class="fa fa-pencil"></i> -->
                                Nota
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="notas" style="display: none;">
                    <div class="panel-body">
                        <p>No hay notas disponibles para esta unidad</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Notas</h4>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('', ['id'=>"addnote", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=>$ID))?>
                    <?=form_input(array('type'=>'hidden','name'=>'broker_id','id'=>'broker_id','value'=> $this->session->userdata('aID')))?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id'))?>
                    <?=form_input(array('type'=>'hidden','name'=>'client_id','id'=>'client_id'))?>
                    <div class="form-group">
                        <?=form_label('Comentarios','Comentarios', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_textarea(array('name'=>'note','id'=>'note','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Comentarios',))?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <?=form_submit('SubmitNew', 'Guardar', ['class'=>'btn blue btn-block','id'=>'SubmitNew'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="comprador" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Información de venta</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('', ['id'=>"addsell", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id'))?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=>$ID))?>
                    <div class="form-group">
                        <?=form_label('Unidad','Unidad', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'unidad','id'=>'unidad','class'=>'form-control','placeholder'=>'Unidad','autocomplete'=>'off','readonly'=>'readonly'))?><!-- AQUI-->
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Estado','Estado', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?php
                        $optionsStatus = array(
                            //'-1' => 'Estado',
                            '4' => 'Vendida',
                            '3' => 'Reservada',
                            '2' => 'Disponible',
                            '0' => 'No Disponible'
                        );
                        ?>
                        <?=form_dropdown(array('name'=>'status','id'=>'status','class'=> 'form-control','autocomplete'=>'off'), $optionsStatus)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Broker','Broker', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?
                            $optionsBroker=[];
                            $optionsBroker['0']='- Seleccione - ';
                            foreach($brokers as $broker) {
                                $optionsBroker[$broker['administrator_id']]=$broker['firstname'].' '.$broker['lastname'];
                            }
                        ?>
                        <?=form_dropdown(array('name'=>'broker_id','id'=>'broker_id','class'=> 'form-control','placeholder'=>'Clientes','autocomplete'=>'off'),$optionsBroker)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Cliente','Cliente', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?
                            $optionsClient=[];
                            $optionsClient['0']='- Seleccione - ';
                            foreach($clients as $client) {
                                $optionsClient[$client['client_id']]=$client['firstname'].' '.$client['lastname']. ' ('.$client['country'].')';
                            }
                        ?>
                        <?=form_dropdown(array('name'=>'client_id','id'=>'client_id','class'=> 'form-control','placeholder'=>'Clientes','autocomplete'=>'off'),$optionsClient)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Parking','Parking', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?php $optionsParking=['0'=>'Sin parking','1'=>'1 puesto','2'=>'2 puestos','3'=>'3 puestos'];?>
                        <?=form_dropdown(array('name'=>'parking','id'=>'parking','class'=> 'form-control','placeholder'=>'Parkings','autocomplete'=>'off'),$optionsParking)?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <?=form_submit('SubmitBuyer', 'Guardar', ['class'=>'btn blue btn-block','id'=>'SubmitBuyer'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editNote" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Editar Nota</h4>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('', ['id'=>"form-edit-note", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'note_id','id'=>'note_id'))?>
                    <?//=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=>$ID))?>
                    <?=form_input(array('type'=>'hidden','name'=>'broker_id','id'=>'broker_id','value'=> $this->session->userdata('aID')))?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id'))?>
                    <?//=form_input(array('type'=>'hidden','name'=>'client_id','id'=>'client_id'))?>
                    <div class="form-group">
                        <?=form_label('Comentarios','Comentarios', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_textarea(array('name'=>'note','id'=>'note','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Comentarios',))?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <?=form_submit('SubmitEdit', 'Guardar', ['class'=>'btn blue btn-block','id'=>'SubmitEdit'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="parking" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Parking</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('', ['id'=>"addparking", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id'))?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=>$ID))?>
                    <?=form_input(array('type'=>'hidden','name'=>'broker_id','id'=>'broker_id','value'=> $this->session->userdata('aID')))?>
                    <div class="form-group">
                        <?=form_label('Unidad','Unidad', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'unidad','id'=>'unidad','class'=>'form-control','placeholder'=>'Unidad','autocomplete'=>'off','readonly'=>'readonly' ))?> <!-- AQUI -->
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Cliente','Cliente', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?
                            $optionsClient=[];
                            $optionsClient['0']='- Seleccione - ';
                            foreach($clients as $client) {
                                $optionsClient[$client['client_id']]=$client['firstname'].' '.$client['lastname']. ' ('.$client['country'].')';
                            }
                        ?>
                        <?=form_dropdown(array('name'=>'client_id','id'=>'client_id','class'=> 'form-control','placeholder'=>'Clientes','autocomplete'=>'off'),$optionsClient)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Numero','Numero', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'number','id'=>'number','class'=>'form-control','placeholder'=>'Numero','autocomplete'=>'off'))?>
                        <span id="helpBlock" class="help-block">Nota: Identificativo del puesto asignado. Ej. A10 o 101/span>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Monto (USD)','Monto (USD)', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'amount','id'=>'amount','class'=>'form-control','placeholder'=>'Precio','autocomplete'=>'off','value'=>'0'))?>
                        <span id="helpBlock" class="help-block">Nota: Campo opcional</span>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <?=form_submit('SubmitParking', 'Guardar', ['class'=>'btn blue btn-block','id'=>'SubmitParking'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<!-- AQUI -->
<div class="modal fade" id="editarprecio" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Editar Precio de venta</h4>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('', ['id'=>"form-price", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id'))?>
                    <div class="form-group">
                        <?=form_label('Precio','Precio', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'price','id'=>'price','class'=>'form-control','placeholder'=>'Precio de Venta','autocomplete'=>'off'))?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Precio pies','Precio pies', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'price_feet','id'=>'price_feet','class'=>'form-control','placeholder'=>'Precio pies','autocomplete'=>'off'))?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Precio mts','Precio mts', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'price_mts','id'=>'price_mts','class'=>'form-control','placeholder'=>'Precio mts','autocomplete'=>'off'))?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <?=form_submit('SubmitEditPrice', 'Modificar', ['class'=>'btn blue btn-block','id'=>'SubmitEditPrice'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formasdepago" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Formas de pago</h4>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('', ['id'=>"payments", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=>$Id))?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id'))?>
                    <div class="form-group">
                        <?=form_label('Forma de pago','', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_dropdown(array('name'=>'transaction_type','id'=>'transaction_type','class'=> 'form-control','autocomplete'=>'off'), array('1'=>'Reserva','2'=>'Firma CCV','3'=>'Cuota','4'=>'Entrega','5'=>'Contado'))?>
                        <!-- <small style="padding-top:20px">ej. Couta</small> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Monto','', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'amount','id'=>'amount','class'=> 'form-control','autocomplete'=>'off','placeholder'=>'Monto',))?>
                        <!-- <small style="padding-top:20px">ej. 150000</small> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <?=form_label('Cuota del mes','', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'date','id'=>'date','class'=> 'form-control','autocomplete'=>'off', 'placeholder'=>'Fecha', 'type'=>'date'))?>
                        <!-- <small style="padding-top:20px">ej. Mayo 2017</small> -->
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <?=form_submit('SubmitPayment', 'Guardar', ['class'=>'btn blue btn-block','id'=>'SubmitPayment'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script>
    var customPrice = function(property_unity_id){
        console.log('editPrecio', property_unity_id);
        $('#editarprecio').modal('show');
        $.getJSON('<?=site_url() ?>/property_unity/json/'+property_unity_id, function(response) {
            console.log('response', response);
            $('#editarprecio').modal('show');
            $('#editarprecio form #price').val(response.price);
            $('#editarprecio form #price_feet').val(response.price_feet);
            $('#editarprecio form #price_mts').val(response.price_mts);
            $('#editarprecio form #property_unity_id').val(response.property_unity_id);
        });
        $('#SubmitEditPrice').on('click', function(event){
            event.preventDefault();
            var formId = "#form-price-note";// #form-edit-note
            var params = {
                price : $(formId +" #price").val(),
                price_mts : $(formId +" #price_mts").val(),
                price_feet : $(formId +" #price_feet").val(),
                property_unity_id : $(formId +" #property_unity_id").val(),
            }
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/property_unity/update",
                dataType: 'json',
                data: params,
            })
            .success(function(res) {
                toastr.success('Información actualizada!');
                $('.modal form input, .modal form select, .modal form textarea').val('');
                $('.modal').modal('hide');
                //getNotes(res);
            })
            .fail(function(err) {
                toastr.error('Ha ocurrido un problema');
            });
        })
    }
    var getInfo = function(id, property){
        //console.info('getInfo', new Date());
        $('#detalle h3').html('Unidad '+id);
        $('#detalle h4').html(' ');
        $('#detalle p[role="alert"]').remove();
        $('#detalle #infoUnity').html('<img src="<?=base_url() ?>/assets/global/img/input-spinner.gif" />');

        $.getJSON('<?=site_url() ?>/transaction/info/'+id+'/'+property, function(res) {
            console.log('res', res);
            var info = res.info,
                broker = res.broker,
                notes = res.notes,
                parkeo = res.parking;
            $('#infoUnity').html(' ');
            $('.modal form #unidad').val(info.number);
            $('.modal form #property_unity_id').val(info.property_unity_id);
            <?php if($nivel==2) {  // se muestra solo en Project manager / administrador ?>

            if(info.status!=0){
            <? } ?>
                $('#detalle #infoUnity').html('<ul></ul>');
                $('#detalle ul').append('<li><strong>Tipo:</strong> '+info.type+'</li>');
                $('#detalle ul').append('<li><strong>Orientación:</strong> '+info.orientation+'</li>');
                $('#detalle ul').append('<li><strong>Superficie (pies/metros):</strong> '+info.total_feet+' pies&sup2; / '+ info.total_mts +' metros&sup2; <br><br></li>');
<!-- AQUI -->
                $('#detalle ul').append('<li><strong>Precio:</strong> USD $<span id="preciofull">'+info.price+'</span> <a href="javascript:customPrice('+ info.property_unity_id+')"><i class="fa fa-pencil"></i> Modificar</a></li>');// data-toggle="modal" href="#comprador"
                $('#detalle ul').append('<li><strong>Precio (pies/metros):</strong> USD $<span id="preciopies">'+info.price_feet +'</span> pies / USD <span id="preciomts">$'+info.price_mts+'</span> metros<br><br></li>');

                $('#boxStatus').attr('style','display:block');

                if(info.status==0) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> NO DISPONIBLE</li>');
                } else if(info.status==2) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> DISPONIBLE</li>');
                } else if(info.status==3) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> RESERVADA</li>');
//                    $('#btnBuyer').attr('style','display:none;');
                } else if(info.status==4) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> <strong>VENDIDA</strong></li>');
                    $('#boxStatus').attr('style','display:none');
                } else {
                    $('#detalle ul').append('<li><strong>Estado: </strong> DISPONIBLE</li>');
                    toastr.info('Es posible reservar esta unidad', 'Unidad #'+info.number);
                }

                if(info.status>2){
                    $('#detalle ul').append('<li><strong>Broker:</strong> <span id="brokerInfo">No disponible</span></li>');
                    $('#detalle ul').append('<li><strong>Cliente:</strong> <span id="buyerInfo">No disponible</span></li>');
                }
                if(info.status>3){
                    //$('#btnBuyer, #btnMethod').attr('style','display:none;');
                } else {
                    //$('#btnBuyer, #btnMethod').attr('style','display:inline;');
                }

                if(res.owner && res.owner.name!=null){
                    $('#buyerInfo').html('<a href="<?php echo site_url() ?>/client/profile/'+res.owner.Id+'/'+info.number+'">'+res.owner.name +' '+res.owner.surname+'</a>');
                    $('#brokerInfo').html('<a href="mailto:'+res.owner.brokerEmail+'">'+res.owner.brokerName +' '+res.owner.brokerSurname+'</a>');
                    //console.info('buyerInfo',res.owner.name);
                }

                $('#property_unity #status').val(info.status);
                $('#notes, #action, #notas').removeAttr('style');
                $('#notes #note').val('Unidad #'+id+' Propiedad: '+property);
                // populate property_unity_id
                $('#addnote #property_unity_id').val(info.property_unity_id);
<!-- AQUI -->   //$('.modal form #unidad').val(id);// Unidad en el Modal

            <?php if($nivel==2) { ?>
            } // se muestra solo en Project manager / administrador
            <?php } ?>
            //console.log('data', res);

            // agrega info de compra
            $('#addsell #property_unity_id').val(info.property_unity_id);
            $('#addsell #client_id').val(res.owner.Id);
            $('#addsell #broker_id').val(res.owner.brokerID);
            $('#addsell #status').val(info.status);
            getNotes(info.property_unity_id,id);

            $('#detalle ul').append('<li><strong>Parking:</strong> <span id="parkingInfo">Sin parking</span></li>');

            var puestos = 0,
                puestosasignados = parkeo[0].number;
            if(puestosasignados>0){
                puestos = parkeo[0].number;
            }
            $('#parkingInfo').html(puestos+' puesto(s)');
            $('#addsell #parking').val(puestos);
        });
    };
    var getData = function(){
        toastr.info('Cargando disponibilidad, por favor, espere..');
        $.getJSON('<?=site_url() ?>/property/populate/<?=$ID?>', function(response) {
            console.log('actualizado:',new Date());
            var st =  response.unities,
                none = 0,
                available = 0,
                free = 0,
                reserved = 0,
                sold = 0;
            for(var i = 0; i<st.length; i++){
                var statusProp = parseFloat(st[i].status),
                    currentProp = st[i].number;
                if(statusProp==0) {
                    <?php if($nivel==2) { ?>
                    $('#'+currentProp).html(currentProp);
                    <?php } ?>
                    $('#'+currentProp).removeAttr('class').addClass('bg-default');
                    none+=1;
                } else if(statusProp==1) {
                    $('#'+currentProp).removeAttr('class').addClass('bg-default');
                    console.log('statusProp:1', statusProp, '#'+currentProp);
                    free+=1;
                } else if(statusProp==2) {
                    $('#'+currentProp).removeAttr('class').addClass('bg-success');
                    free+=1;
                } else if(statusProp==3) {
                    $('#'+currentProp).removeAttr('class').addClass('bg-warning');
                    reserved+=1;
                } else if(statusProp==4) {
                    $('#'+currentProp).removeAttr('class').addClass('bg-danger');
                    $('#btnChange').attr('style','display:inline;');
                    sold+=1;
                } else {
                    //$('#bagde-free').text(st.length - none - sold -free - reserved);
                    console.error('statusProp', statusProp,'#'+currentProp);
                }
            }
            $('#bagde-none').text(none);
            $('#bagde-sold').text(sold);
            $('#bagde-reserved').text(reserved);
            $('#bagde-free').text(free);
            $('#bagde-available').text(available);
            //console.log('Totales: ',none,available,free,reserved,sold);
        });
    }
    var remove = function(note_id){
        console.log('remove', note_id);

        if (confirm('Desea eliminar este registro?','Acción requerida')) {
            jQuery.ajax({
                type: "GET",
                url: "<?php echo site_url(); ?>/note/delete/"+note_id,
                dataType: 'json',
            })
            .success(function(res) {
                toastr.success('Información actualizada!');
                getNotes(res.property_unity_id);
                console.log('remove/res', res);
            });
            toastr.success('Acción ejecutada con exito!');
        } else {
            return false;
        }
    }
    var getNotes = function(property_unity_id){
        $('#notas .panel-body').html('<img src="<?=base_url() ?>/assets/global/img/input-spinner.gif" />');
        $.getJSON('<?=site_url() ?>/note/unity/'+property_unity_id, function(response) {
            //console.log('notes',response);
            $('#notas .panel-body').html('No hay notas disponibles para esta unidad');
            var notes = response;
            if(notes.length>0){
                //console.log('notes', notes);
                var content = "";
                for(var i=0; i<notes.length; i++){
                    content +='<p><strong>'+ notes[i].note+'</strong> <a href="javascript:edit('+ notes[i].note_id+');"><i class="fa fa-pencil" style="color:green;"></i></a> <a href="javascript:remove('+ notes[i].note_id+');"><i class="fa fa-times" style="color:red;"></i></a><br>por '+ notes[i].firstname +' '+ notes[i].lastname+', el '+ notes[i].updated+'</p>';
                }
                $('#notas .panel-body').html(content);
                if(i>10){
                    $('#notas .panel-body').attr('style','height:500px;overflow-y:scroll;');
                } else {
                    $('#notas .panel-body').removeAttr('style');
                }
            }
        });
    }
    var edit = function(note_id){
        console.log('edit', note_id);

        $.getJSON('<?=site_url() ?>/note/view/'+note_id, function(response) {
            console.log('response', response);
            $('#editNote').modal('show');
            $('#editNote #note_id').val(response.note_id);
            $('#editNote #note').val(response.note);
            $('#editNote #broker_id').val(response.broker_id);
            $('#editNote #property_unity_id').val(response.property_unity_id);
        });
        $('#SubmitEdit').on('click', function(event){
            event.preventDefault();
            var formId = "#editNote";// #form-edit-note
            var params = {
                note_id : $(formId +" #note_id").val(),
                note : $(formId +" #note").val(),
                broker_id : $(formId +" #broker_id").val(),
                property_unity_id : $(formId +" #property_unity_id").val(),
            }
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/note/update",
                dataType: 'json',
                data: params,
            })
            .success(function(res) {
                toastr.success('Información actualizada!');
                $('.modal form input, .modal form select, .modal form textarea').val('');
                $('.modal').modal('hide');
                getNotes(res);
            })
            .fail(function(err) {
                toastr.error('Ha ocurrido un problema');
            })
        })
    }

    window.onload = function(){
        console.log('Loaded!');
        getData();
        $("#SubmitNew").click(function(event) {
            event.preventDefault();
            var formId = "#basic #addnote";
            var params = {
                property_id : $(formId +" #property_id").val(),
                property_unity_id : $(formId+" #property_unity_id").val(),
                broker_id : $(formId +" #broker_id").val(),
                client_id : $(formId +" #client_id").val(),
                note : $(formId +" #note").val(),
            }
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/note/add",
                dataType: 'json',
                data: params, //{ property_id: property_id, broker_id: broker_id, client_id: client_id, note: note },
            })
            .success(function(res) {
                console.log('res',res);
                getNotes(res);
                toastr.success('Información actualizada!');
                //$('#basic form input, #basic form select, #basic form textarea').val('');
                $('#basic').modal('hide');
            })
            .fail(function(err) {
                toastr.error('Ha ocurrido un problema');
            });
        });

        $("#SubmitBuyer").click(function(event){
            event.preventDefault();
            var formId = "#comprador #addsell";
            var params = {
                property_id: $(formId+" #property_id").val(),
                broker_id: $(formId+" #broker_id").val(),
                client_id: $(formId+" #client_id").val(),
                property_unity_id: $(formId+" #property_unity_id").val(),
                status: $(formId+" #status").val(),
                unidad: $(formId+" #unidad").val(),
                parking: $(formId+" #parking").val()
            }
            console.debug('params',params)
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/property_unity/marked",
                dataType: 'json',
                data: params,
            })
            .success(function(data) {
                toastr.success('Información actualizada!');
                console.info('SubmitBuyer', data);
                getInfo(data.n,data.p);
                $('#comprador').modal('hide');
            })
            .fail(function(err) {
                toastr.error('Ha ocurrido un problema');
            });
        });
        $('#comprador #addsell #status').on('change', function(){
            var status = $(this).val();
            var formId = "#addsell";
            console.log('#comprador #addsell #status', status);
            if(status<=2){
                $(formId+" #property_id").attr('readonly','readonly').val(0);
                $(formId+" #broker_id").attr('readonly','readonly').val(0);
                $(formId+" #client_id").attr('readonly','readonly').val(0);
            } else {
                $(formId+" #property_id").removeAttr('readonly');
                $(formId+" #broker_id").removeAttr('readonly');
                $(formId+" #client_id").removeAttr('readonly');
            }
        });
        $('#comprador #addsell #client_id').on('change', function(){
            var clienteId = $(this).val();
            var formId = "#addsell";
            if(clienteId>0){
                $(formId+" #status").val(3);
            } else {
                $(formId+" #status").val(0);
            }
        });

        $("#SubmitParking").click(function(event){
            event.preventDefault();
            var formId = "#parking #addparking";
            var params = {
                property_id: $(formId+" #property_id").val(),
                client_id: $(formId+" #client_id").val(),
                property_unity_id: $(formId+" #property_unity_id").val(),
                unidad: $(formId+" #unidad").val(),
                amount: $(formId+" #amount").val(),
                broker_id: $(formId+" #broker_id").val(),
                number: $(formId+" #number").val(),
            }
            //console.debug('params',params)
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/property_parking/assign",
                dataType: 'json',
                data: params,
            })
            .success(function(data) {
                toastr.success('Información actualizada!');
                console.info('SubmitParking', data);
                //getInfo(data.n,data.p);
                //getData();
                $('#parking').modal('hide');
            })
            .fail(function(err) {
                toastr.error('Ha ocurrido un problema');
            });
        });

        $("#SubmitEditPrice").click(function(event){
            event.preventDefault();
            var formId = "#form-price";
            var params = {
                price: $(formId+" #price").val(),
                price_mts: $(formId+" #price_mts").val(),
                price_feet: $(formId+" #price_feet").val(),
                property_unity_id: $(formId+" #property_unity_id").val(),
            }
            console.debug('params',params)
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/property_unity/updateonsale",
                dataType: 'json',
                data: params,
            })
            .success(function(res) {
                toastr.success('Información actualizada!');
                console.info('SubmitEditPrice', res);
                //getInfo(res.id, <?php echo $Id ?>);
                $('span#preciofull').html(res.price);
                $('span#preciopies').html(res.price_feet);
                $('span#preciomts').html(res.price_mts);
                $('#editarprecio').modal('hide');
            })
            .fail(function(err) {
                toastr.error('Ha ocurrido un problema');
            });
        });

        $("#SubmitPayment").click(function(event){
            event.preventDefault();
            var formId = "#payments";
            var params = {
                amount: $(formId+" #amount").val(),
                transaction_type: $(formId+" #transaction_type").val(),
                property_unity_id: $(formId+" #property_unity_id").val(),
                property_id: $(formId+" #property_id").val(),
                date: $(formId+" #date").val(),
            }
            console.debug('params',params)
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/transaction/method",
                dataType: 'json',
                data: params,
            })
            .success(function(res) {
                toastr.success('Información actualizada!');
                console.info('SubmitPayment', res);
                $('span#preciofull').html(res.price);
                $('span#preciopies').html(res.price_feet);
                $('span#preciomts').html(res.price_mts);
                $('#formasdepago').modal('hide');

                $(formId+" #amount").val('');
                $(formId+" #transaction_type").val('');
                $(formId+" #property_unity_id").val('');
                $(formId+" #property_id").val('');
                $(formId+" #date").val('');
                setTimeout(function(){
                    location.reload()
                }, 3000);
            })
            .fail(function(err) {
                toastr.error('Ha ocurrido un problema');
            });
        });
    }
</script>
