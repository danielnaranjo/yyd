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
        <h3 class="page-title"> <?php echo $titulo ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-5" id="detalle">
                <div>
                    <span class="label label-default">No disponible <span class="badge" id="bagde-none">0</span></span>
                    <span class="label label-success">Disponible <span class="badge" id="bagde-free">0</span></span>
                    <span class="label label-warning">Reservada <span class="badge" id="bagde-reserved">0</span></span>
                    <span class="label label-danger">Vendida <span class="badge" id="bagde-sold">0</span></span>
                </div>
                <h3></h3>
                <p class="alert alert-info" role="alert">
                    Selecciona una unidad para ver mas información
                </p>
                <h4></h4>
                <a></a>

                <div class="col-md-6" id="action" style="display: none;">
                    <?php echo form_open_multipart('', ['class'=>"form-horizontal", 'role'=>"form", 'id'=>'property_unity']); ?>
                        <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id','value'=>$ID))?>
                        <?//=form_input(array('type'=>'hidden','name'=>'broker_id','id'=>'broker_id','value'=> $this->session->userdata('aID')))?>
                        <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id'))?>
                        <div class="form-group">
                            <?=form_label('cambiar','cambiar', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                            <div class="col-md-9">
                            <?php 
                            $options = array(
                                '-1' => 'Estado', 
                                '4' => 'Vendida', 
                                '3' => 'Reservada', 
                                '2' => 'Disponible',
                                '1' => 'Disponible'
                                ); 
                            ?>
                            <?=form_dropdown(array('name'=>'status','id'=>'status','class'=> 'form-control','autocomplete'=>'off'), $options)?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <?=form_submit('Submit', 'Cambiar estado', ['class'=>'btn btn-block blue','id'=>'btnStatus'])?>
                                </div>
                                <div class="col-md-6">
                                    <a data-toggle="modal" href="#basic" class="btn btn-block green">Agregar nota</a>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close();?>
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
                    <div class="form-group">
                        <?=form_label('Cliente','Cliente', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <? 
                            $options=[];
                            $options['0']='- Seleccione - ';
                            foreach($clients as $client) {
                                $options[$client['client_id']]=$client['firstname'].' '.$client['lastname']. ' ('.$client['country'].')';
                            }   
                        ?>
                        <?=form_dropdown(array('name'=>'client_id','id'=>'client_id','class'=> 'form-control','placeholder'=>'Clientes','autocomplete'=>'off'),$options)?>
                        </div>
                    </div>
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



<script>
    function getInfo(id, property){
        $('#detalle h3').html('Unidad '+id);
        $('#detalle h4').html(' ');
        //$('#detalle a').remove();
        $('#detalle p').html('Cargando, por favor espere.');
        $.getJSON('<?=site_url() ?>/transaction/info/'+id+'/'+property, function(res) {
            var info = res.info,
                broker = res.broker;
            $('#detalle p').html('').removeClass('alert').removeClass('alert-info');
            if(info.status!=0){
                $('#detalle p').html('<ul></ul>');
                $('#detalle ul').append('<li><strong>Tipo:</strong> '+info.type+'</li>');
                $('#detalle ul').append('<li><strong>Orientación:</strong> '+info.orientation+'</li>');
                $('#detalle ul').append('<li><strong>Espacio (pies/metros):</strong> '+info.total_feet+' pies /'+ info.total_feet +' metros <br><br></li>');
                $('#detalle ul').append('<li><strong>Precio:</strong> USD $'+info.price+'</li>');
                $('#detalle ul').append('<li><strong>Precio por pies/metros:</strong> USD $'+info.price_feet +' pies / $'+info.price_mts+' metros<br><br></li>');
                $('#detalle ul').append('<li><strong>Broker:</strong> No disponible</li>');
                //$('#detalle h4').html(res.status);
                if(info.status==0) {
                    //$('#detalle h4').html('<strong>Estado: </strong> No disponible');
                } else if(info.status==2) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> Disponible</li>');
                } else if(info.status==3) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> Reservada</li>');
                } else if(info.status==4) {
                    $('#detalle ul').append('<li><strong>Estado: </strong> Vendida</li>');
                } else {
                    $('#detalle ul').append('<li><strong>Estado: </strong> Disponible</li>');
                    //$('#detalle a').attr('href','#').text('Reservar').addClass('btn btn-default');
                    toastr.info('Es posible reservar esta unidad', 'Unidad #'+info.number);
                }
                $('#property_unity #status').val(info.status);
                $('#notes, #action').removeAttr('style');
                $('#notes #note').val('Unidad #'+id+' Propiedad: '+property);
                // populate property_unity_id
                $('#action #property_unity_id').val(info.property_unity_id);
            }
            //console.log('data', res);
        }).fail(function(err) {
            toastr.error('Ha ocurrido un error en la consulta, intenta nuevamente');
            console.log('err', err.statusText);
        });
    };
    function getData(){
        $.getJSON('<?=site_url() ?>/property/populate/<?=$ID?>', function(response) {
            console.log(new Date());
            var st =  response.unities,
                none = 0,
                free = 0,
                reserved = 0,
                sold = 0;
            for(var i = 0; i<st.length; i++){
                //$('#'+response[i].number);
                if(st[i].status==0) {
                    //$('#'+st[i].number).addClass('bg-default');
                    //$('#'+st[i].number).attr('style','background-color:#E35B5A;');
                    $('#'+st[i].number).html(st[i].number); // quita el link de consulta
                    $('#bagde-none').text(none);
                    none+=1;
                } else if(st[i].status==1) {
                    $('#'+st[i].number).addClass('bg-default');
                    //$('#'+st[i].number).attr('style','background-color:#659be0;');
                    //$('#bagde-free').text(free);
                    free+=1;
                } else if(st[i].status==2) {
                    $('#'+st[i].number).addClass('bg-success');
                    //$('#'+st[i].number).attr('style','background-color:#36c6d3;');
                    $('#bagde-free').text(free);
                    free+=1;
                } else if(st[i].status==3) {
                    $('#'+st[i].number).addClass('bg-warning');
                    //$('#'+st[i].number).attr('style','background-color:#F1C40F;');
                    $('#bagde-reserved').text(reserved);
                    reserved+=1;
                } else if(st[i].status==4) {
                    $('#'+st[i].number).addClass('bg-danger');
                   // $('#'+st[i].number).attr('style','background-color:#F1C40F;');
                    $('#bagde-sold').text(sold);
                    sold+=1;
                } else {
                    $('#bagde-free').text(st.length - none - sold -free - reserved);
                }
            }
        });
    }
    window.onload = function(){
        toastr.info('Cargando disponibilidad, por favor, espere..');
        console.log('Loaded!');
        getData();
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
        $("#btnStatus").click(function(event) {
            event.preventDefault();
            var property_id = $("#property_id").val(),
                //broker_id = $("#broker_id").val(),
                status = $("#status").val(),
                property_unity_id = $("#property_unity_id").val();
            //console.log('btnStatus', property_id, status, property_unity_id);
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/property_unity/change",
                dataType: 'json',
                data: { property_id: property_id, property_unity_id: property_unity_id, status: status },
                success: function(res) {
                if(res==1) {
                    toastr.success('Información actualizada!');
                    console.info('res', res);
                    getData();
                    }
                },
                fail: function(err){
                    toastr.error('Error');
                    console.error('error', err);
                }
            });
        });
    }
</script>