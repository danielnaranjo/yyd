<?php 
$nivel=$this->session->userdata('level');
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
                    <a href="<?php echo site_url() ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?php if($this->session->userdata('level')!=2) { ?><?php echo site_url() ?>/property/all<? } else { echo "javascript:;"; } ?>">Propiedades</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span><?php echo $result['name']?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">
            <?php echo $result['name']?> 

            
            <div class="actions pull-right">
                <?php if($this->session->userdata('level')==0) { ?>
                <div class="btn-group">
                    <a class="btn dark btn-outline" href="<? echo site_url()?>/property/action/edit/<?php echo $result['property_id']?>">
                        <i class="fa fa-pencil"></i>
                        Editar propiedad
                    </a>
                    <a class="btn dark btn-outline" href="<?php echo site_url() ?>/property_amenities/by/<?php echo $result['property_id']?>">
                        <i class="fa fa-building"></i> Amenities
                    </a>
                    <!--<a class="btn dark btn-outline" href="<?php echo site_url() ?>/property_parking/by/<?php echo $result['property_id']?>">
                        <i class="fa fa-car"></i> Parking
                    </a>-->
                    <a class="btn dark btn-outline" href="<?php echo site_url() ?>/property_photo/by/<?php echo $result['property_id']?>">
                        <i class="fa fa-eye"></i> Fotografias
                    </a>
                </div>
                <? } ?>
                <?php /*if($this->session->userdata('level')==0) { ?>
                <div class="btn-group">
                    <a class="btn dark btn-outline" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-pencil"></i> Agregar nueva 
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="<?php echo site_url() ?>/property_amenities/by/<?php echo $result['property_id']?>">
                                <i class="fa fa-building"></i> Amerities
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>/property_parking/by/<?php echo $result['property_id']?>">
                                <i class="fa fa-user"></i> Parking
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>/property_unity/by/<?php echo $result['property_id']?>">
                                <i class="fa fa-user"></i> Unidades
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>/property_photo/by/<?php echo $result['property_id']?>">
                                <i class="fa fa-eye"></i> Fotografias
                            </a>
                        </li>
                    </ul>
                </div>
                <? }*/ ?>
                <div class="btn-group">
                    <a class="btn dark btn-outline" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-eye"></i> Ver Unidades
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="<?php echo site_url() ?>/property/unities/<?php echo $result['property_id']?>">
                                <i class="fa fa-building"></i> Ver <?php if($nivel!=2) { ?>/ Agregar<?php } else { echo "Unidades"; } ?> 
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>/property/details/<?php echo $result['property_id']?>">
                                <i class="fa fa-user"></i> Detalles
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            

        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="blog-page blog-content-2">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-single-content bordered blog-container">
                        <div class="blog-single-img" style="max-height: 600px;overflow-y: hidden;">
                            <p>Loading..</p>
                        </div>
                        <div class="blog-single-desc">
                            <p><?php echo $result['description']?></p>
                            <?php if($result['floors']!='') { ?>
                            <p>Proyecto de <?php echo $result['floors']?> pisos y <?php echo $result['unities']?> unidades por piso. <?php if($result['parking']!='') { ?>Cuenta con <?php echo $result['parking']?> puestos de parking exclusivos.<?php } ?></p>
                            <?php } ?>
                        </div>
                        <div class="blog-single-desc">
                            <p>
                            <strong>Ubicación</strong><br>
                            <?php echo $result['address']?>. <?php echo $result['city']?> <?php echo $result['province']?>. <?php echo $result['country']?><br>
                            Teléfono(s): <?php echo $result['phone']?><br>
                            E-mail: <a href="mailto:<?php echo $result['email']?>"><?php echo $result['email']?></a><br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-single-sidebar bordered blog-container">
                        <div class="">
                            <h3 class="blog-sidebar-title uppercase">
                                Amenities
                                <?php if($nivel!=2) { ?><a href="<?php echo site_url() ?>/property_amenities/by/<?php echo $result['property_id']?>"><i class="fa fa-pencil"></i></a><? } ?>
                            </h3>
                            <ul>
                                <?php  foreach($features as $feat) { ?>
                                <li>
                                    <?php echo $feat['name'] ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="blog-single-sidebar-ui">
                            <h3 class="blog-sidebar-title uppercase">
                                Fotografias
                                <?php if($nivel!=2) { ?><a href="<?php echo site_url() ?>/property_photo/by/<?php echo $result['property_id']?>"><i class="fa fa-pencil"></i></a><?php } ?>
                            </h3>
                            <div class="row ui-margin">
                                <?php foreach($photos as $photo) { ?>
                                <div class="col-xs-4 ui-padding">
                                    <a href="<?php echo base_url() ?>upload/<?php echo $photo['file'] ?>" target="_blank">
                                        <img src="<?php echo base_url() ?>upload/<?php echo $photo['file'] ?>" />
                                    </a>
                                </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<script>
    setTimeout(function(){
        $.getJSON("<?php echo site_url() ?>/property/pictures/<?php echo $result['property_id']?>", function( data ) {
            if(data && data.length>0){
                $('.blog-single-img').html('<img src="<?php echo base_url() ?>upload/'+data[0].file+'" alt="" />');
            }
        })
    },300);
</script>