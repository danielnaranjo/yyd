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
                                <i class="fa fa-building"></i> Estado
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
                    <a href="javascript:getData()"><i class="fa fa-refresh"></i></a>
                </div>
                <h3></h3>
                <p id="infoUnity">
                    <p class="alert alert-info" role="alert">Selecciona una unidad para ver mas información</p>
                </p>

                <div class="panel panel-default" id="action" style="display: none;">
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <a data-toggle="modal" href="#basic" class="btn btn-block dark">Agregar nota</a>
                        </div>
                        <div class="col-sm-6" id="btnBuyer">
                            <a data-toggle="modal" href="#comprador" class="btn btn-block dark">Asignar comprador</a>
                        </div>
                        <div class="col-sm-6" id="btnChange" style="display: none;">
                            <a data-toggle="modal" href="#comprador" class="btn btn-block dark">Modificar</a>
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
                <h4 class="modal-title">Información de visita</h4>
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
                                <?=form_submit('Submit', 'Guardar', ['class'=>'btn blue btn-block','id'=>'Submit'])?>
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
                        <?=form_input(array('name'=>'unidad','id'=>'unidad','class'=>'form-control','placeholder'=>'Unidad','autocomplete'=>'off','readonly'=>'readonly'))?>
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
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <?=form_submit('Submit', 'Guardar', ['class'=>'btn blue btn-block','id'=>'SubmitBuyer'])?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>



<script>
    function getInfo(id, property){
        //console.info('getInfo', new Date());
        $('#detalle h3').html('Unidad '+id);
        $('#detalle h4').html(' ');
        $('#detalle p[role="alert"]').remove();
        $('#detalle #infoUnity').html('<img src="<?=base_url() ?>/assets/global/img/input-spinner.gif" />');

        $.getJSON('<?=site_url() ?>/transaction/info/'+id+'/'+property, function(res) {

            var info = res.info,
                broker = res.broker,
                notes = res.notes;
            $('#infoUnity').html(' ');

            <?php if($nivel==2) {  // se muestra solo en Project manager / administrador ?>

            if(info.status!=0){ 
            <? } ?>
                $('#detalle #infoUnity').html('<ul></ul>');
                $('#detalle ul').append('<li><strong>Tipo:</strong> '+info.type+'</li>');
                $('#detalle ul').append('<li><strong>Orientación:</strong> '+info.orientation+'</li>');
                $('#detalle ul').append('<li><strong>Superficie (pies/metros):</strong> '+info.total_feet+' pies / '+ info.total_feet +' metros <br><br></li>');
                $('#detalle ul').append('<li><strong>Precio:</strong> USD $'+info.price+'</li>');
                $('#detalle ul').append('<li><strong>Precio (pies/metros):</strong> USD $'+info.price_feet +' pies / USD $'+info.price_mts+' metros<br><br></li>');

                
                //$('#detalle h4').html(res.status);
                $('#boxStatus').attr('style','display:block');

                if(info.status==0) {
                    //$('#detalle h4').html('<strong>Estado: </strong> No disponible');
                } else if(info.status==2) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> DISPONIBLE</li>');
                    $('#btnBuyer').attr('style','display:block');
                    $('#btnChange').attr('style','display:none;');
                } else if(info.status==3) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> RESERVADA</li>');
                    $('#btnBuyer').attr('style','display:none');
                    $('#btnChange').attr('style','display:block;');
                } else if(info.status==4) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> <strong>VENDIDA</strong></li>');
                    $('#btnBuyer').attr('style','display:none');
                    $('#btnChange').attr('style','display:inline');
                    $('#boxStatus').attr('style','display:none');
                    
                } else {
                    $('#detalle ul').append('<li><strong>Estado: </strong> DISPONIBLE</li>');
                    //$('#detalle a').attr('href','#').text('Reservar').addClass('btn btn-default');
                    toastr.info('Es posible reservar esta unidad', 'Unidad #'+info.number);
                    $('#btnChange').attr('style','display:none;');
                }

                if(info.status>2){ 
                    $('#detalle ul').append('<li><strong>Broker:</strong> <span id="brokerInfo">No disponible</span></li>');
                    $('#detalle ul').append('<li><strong>Comprador:</strong> <span id="buyerInfo">No disponible</span></li>');
                }

                if(res.owner && res.owner.name!=null){
                    $('#buyerInfo').html('<a href="<?php echo site_url() ?>/client/profile/'+res.owner.Id+'">'+res.owner.name +' '+res.owner.surname+'</a>');
                    $('#brokerInfo').html('<a href="mailto:'+res.owner.brokerEmail+'">'+res.owner.brokerName +' '+res.owner.brokerSurname+'</a>');
                    //console.info('buyerInfo',res.owner.name);
                }

                $('#property_unity #status').val(info.status);
                $('#notes, #action, #notas').removeAttr('style');
                $('#notes #note').val('Unidad #'+id+' Propiedad: '+property);
                // populate property_unity_id
                $('#addnote #property_unity_id').val(info.property_unity_id);
                $('#unidad').val(info.number);

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
        });
    };
    function getData(){
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
                if(st[i].status==0) {
                    <?php if($nivel==2) { ?>
                    $('#'+st[i].number).html(st[i].number);
                    <?php } ?>
                    $('#'+st[i].number).removeAttr('class').addClass('bg-default');
                    $('#bagde-none').text(none);
                    $('#btnBuyer').attr('style','display:none;');
                    none+=1;
                } else if(st[i].status==1) {
                    $('#'+st[i].number).removeAttr('class').addClass('bg-default');
                    $('#btnBuyer').attr('style','display:inline;');
                    $('#bagde-available').text(available);
                    free+=1;
                } else if(st[i].status==2) {
                    $('#'+st[i].number).removeAttr('class').addClass('bg-success');
                    $('#btnBuyer').attr('style','display:inline;');
                    $('#bagde-free').text(free);
                    free+=1;
                } else if(st[i].status==3) {
                    $('#'+st[i].number).removeAttr('class').addClass('bg-warning');
                    $('#bagde-reserved').text(reserved);
                    $('#btnBuyer').attr('style','display:none;');
                    reserved+=1;
                } else if(st[i].status==4) {
                    $('#'+st[i].number).removeAttr('class').addClass('bg-danger');
                    $('#bagde-sold').text(sold);
                    $('#btnBuyer').attr('style','display:none;');
                    $('#btnChange').attr('style','display:inline;');
                    sold+=1;
                } else {
                    //$('#bagde-free').text(st.length - none - sold -free - reserved);
                }
            }
                //console.log('!',response, st.length, none, free, sold, reserved, available);
        });
    }
    function remove(note_id){
        console.log('remove', note_id);

        if (confirm('Desea eliminar este registro?')) {
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
    function getNotes(property_unity_id){
        $('#notas .panel-body').html('<img src="<?=base_url() ?>/assets/global/img/input-spinner.gif" />');
        $.getJSON('<?=site_url() ?>/note/unity/'+property_unity_id, function(response) {
            //console.log('notes',response);
            $('#notas .panel-body').html('No hay notas disponibles para esta unidad');
            var notes = response;
            if(notes.length>0){
                //console.log('notes', notes);
                var content = "";
                for(var i=0; i<notes.length; i++){
                    content +='<p><strong>'+ notes[i].note+'</strong>  <a href="javascript:remove('+ notes[i].note_id+');"><i class="fa fa-times" style="color:red;"></i></a><br>por '+ notes[i].firstname +' '+ notes[i].lastname+', el '+ notes[i].updated+'</p>';
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
    window.onload = function(){
        console.log('Loaded!');
        getData();
        $("#Submit").click(function() {
            var formId = "#basic #addnote";
            //event.preventDefault();
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
                toastr.success('Información actualizada!');
                $('.modal form input, .modal form select, .modal form textarea').val('');
                $('.modal').modal('hide');
            });
        });

        $("#SubmitBuyer").click(function(){
            var formId = "#comprador #addsell";
            var params = {
                property_id: $(formId+" #property_id").val(),
                broker_id: $(formId+" #broker_id").val(),
                client_id: $(formId+" #client_id").val(),
                property_unity_id: $(formId+" #property_unity_id").val(),
                status: $(formId+" #status").val(),
                unidad: $(formId+" #unidad").val()
            }
            //console.debug('params',params)
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/property_unity/markassold",
                dataType: 'json',
                data: params,
            })
            .success(function(res) {
                toastr.success('Información actualizada!');
                //console.info('SubmitBuyer', res);
                getData();
                getInfo(res.unidad,res.property_id);
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
        })
    }
</script>