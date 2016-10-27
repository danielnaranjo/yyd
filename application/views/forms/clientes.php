<?
/* variables */
    $title ="";
    // comienza el formulario
    $model = 'client';
    $action = '';
    $ejecutar ="created";
    $nivel = 2;

    $titulo="Nuevo";
    $btn = "Agregar nuevo";
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
                            <?php echo traducir($model) ?>
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
                <h3> </h3>
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
                                <?php echo form_open('client/created', ['class'=>"form-horizontal", 'role'=>"form"]); ?>                         
                                    <div class="form-group">
                                        <label for="firstname" class="col-md-3 control-label" style="text-transform:Capitalize;">nombre</label> 
                                        <div class="col-md-9">
                                            <input type="text" name="firstname" value="" id="firstname" placeholder="nombre" maxlength="160" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="col-md-3 control-label" style="text-transform:Capitalize;">apellido</label>   
                                        <div class="col-md-9">
                                        <input type="text" name="lastname" value="" id="lastname" placeholder="apellido" maxlength="160" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-md-3 control-label" style="text-transform:Capitalize;">email</label>  
                                        <div class="col-md-9">
                                            <input type="email" name="email" value="" id="email" placeholder="email" maxlength="255" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-md-3 control-label" style="text-transform:Capitalize;">dirección</label>   
                                        <div class="col-md-9">
                                            <input type="text" name="address" value="" id="address" placeholder="dirección" maxlength="255" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="col-md-3 control-label" style="text-transform:Capitalize;">ciudad</label> 
                                        <div class="col-md-9">
                                            <input type="text" name="city" value="" id="city" placeholder="ciudad" maxlength="100" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="col-md-3 control-label" style="text-transform:Capitalize;">país</label>    
                                        <div class="col-md-9">
                                            <select name="country"  id="country" placeholder="país" class="form-control" >
                                                <?php foreach ($paises as $pais) {
                                                    echo '<option value="'.$pais['name'].'"';
                                                    if($pais['name']=='Argentina'){ 
                                                        echo "selected"; 
                                                    }
                                                    echo ' >'.$pais['name'].'</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-md-3 control-label" style="text-transform:Capitalize;">teléfono</label>  
                                        <div class="col-md-9">
                                            <input type="text" name="phone" value="" id="phone" placeholder="teléfono" maxlength="100" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-actions">     
                                        <div class="row">       
                                            <div class="col-md-offset-3 col-md-9">
                                                <input type="submit" name="Submit" value="Agregar nuevo" class="btn blue">
                                            </div>  
                                        </div>
                                    </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>