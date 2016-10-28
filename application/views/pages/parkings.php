<?
$nivel = $this->session->userdata('level');
$property_id=$this->session->userdata('property_id');
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
                    <span><?php echo $titulo ?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">
            <?php echo $result[0]['name'] ?> > <?php echo $titulo ?>
            <div class="actions pull-right">
                <div class="btn-group">
                    <a class="btn dark btn-outline" href="javascript:history.back();">
                        <i class="fa fa-chevron-left"></i>
                        Volver atras
                    </a>
                </div>
            </div>        
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <table class="table table-striped table-hover table-bordered" id="sample_2">
                            <thead>
                                <tr>
                                    <th> Proyecto </th>
                                    <th> Parking </th>
                                    <th> Unidad </th>
                                    <th> Comprador </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($result as $r) { ?>
                                <tr>
                                    <td> <?php echo $r['name'] ?> </td>
                                    <td> <?php echo $r['parking'] ?> </td>
                                    <td> <?php echo $r['unity'] ?> </td>
                                    <td> <?php echo $r['firstname']; ?> <?php echo $r['lastname']; ?> </td>
                                    <td> 
                                        <a data-toggle="modal" href="#parkingEdit" onclick="javascrip:edit(<?php echo $r['property_parking_id'] ?>);" class="view">
                                            <i class="fa fa-pencil"></i> 
                                            Modificar
                                        </a>
                                        <a class="delete" href="javascript:;" onclick="javascript:check(<? echo $r['property_parking_id']?>);">
                                            <i class="fa fa-trash"></i> 
                                            Borrar
                                        </a>
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

<div class="modal fade" id="parkingEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Editar</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('', ['id'=>"form-parking", 'class'=>"form-horizontal", 'role'=>"form"]); ?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_parking_id','id'=>'property_parking_id'))?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_unity_id','id'=>'property_unity_id'))?>
                    <?=form_input(array('type'=>'hidden','name'=>'property_id','id'=>'property_id'))?>
                    <div class="form-group">
                        <?=form_label('Unidad','Unidad', ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;'])?>
                        <div class="col-md-9">
                        <?=form_input(array('name'=>'unity','id'=>'unity','class'=>'form-control','placeholder'=>'Unidad','autocomplete'=>'off','readonly'=>'readonly'))?>
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
                        <?=form_input(array('name'=>'parking','id'=>'parking','class'=>'form-control','placeholder'=>'Parking','autocomplete'=>'off'))?>
                        <span id="helpBlock" class="help-block">Nota: Identificativo del puesto asignado. Ej. A10 o 101</span>
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

<script>
function check(id){
    // confirm delete or not
    if (confirm('Desea eliminar este registro?','Acción requerida')) {
        window.location.href="<? echo site_url()?>/property_parking/delete/"+id;
        toastr.success('Acción ejecutada con exito!');
    } else {
        return false;
    }
}

function edit(id){
    console.log('edit', id);
    
    $.getJSON('<?=site_url() ?>/property_parking/getData/'+id, function(response) {
        console.log('response', response);
        $('#parkingEdit').modal('show');
        $('#parkingEdit #client_id').val(response.client_id);
        $('#parkingEdit #property_parking_id').val(response.property_parking_id);
        $('#parkingEdit #parking').val(response.parking);
        $('#parkingEdit #unity').val(response.unity);
        $('#parkingEdit #amount').val(response.amount);
        $('#parkingEdit #property_unity_id').val(response.property_unity_id);
        $('#parkingEdit #property_id').val(response.property_id);
    });
    $('#SubmitParking').on('click', function(event){
        event.preventDefault();
        var formId = "#form-parking";// #form-edit-note
        var params = {
            property_parking_id : $(formId +" #property_parking_id").val(),
            number : $(formId +" #parking").val(),
            client_id : $(formId +" #client_id").val(),
            //property_unity_id : $(formId +" #property_unity_id").val(),
        }
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>/property_parking/update",
            dataType: 'json',
            data: params, 
        })
        .success(function(res) {
            toastr.success('Información actualizada!');
            //$('#parkingEdit form input, #parkingEdit form select, #parkingEdit form textarea').val('');
            $('#parkingEdit').modal('hide');
        });
    })
}
</script>