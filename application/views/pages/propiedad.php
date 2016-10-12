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

            <?php if($this->session->userdata('level')==0) { ?>
            <div class="actions pull-right">
                <div class="btn-group">
                    <a class="btn green-haze" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
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
            </div>
            <? } ?>

        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="blog-page blog-content-2">
            <div class="row">
                <div class="col-lg-9">
                    <div class="blog-single-content bordered blog-container">
                        <div class="blog-single-img" style="max-height: 600px;overflow-y: hidden;">
                            <p>Loading..</p>
                        </div>
                        <div class="blog-single-desc">
                            <p><?php echo $result['description']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="blog-single-sidebar bordered blog-container">
                        <div class="blog-single-sidebar-recent">
                            <h3 class="blog-sidebar-title uppercase">Ubicación</h3>
                            <ul>
                                <li>
                                    <a href="#"><?php echo $result['address']?></a>
                                </li>
                                <li>
                                    <a href="#"><?php echo $result['city']?> <?php echo $result['province']?></a>
                                </li>
                                <li>
                                    <a href="#"><?php echo $result['country']?></a>
                                </li>
                                <li>
                                    <a href="#"><?php echo $result['phone']?></a>
                                </li>
                                <li>
                                    <a href="#"><?php echo $result['email']?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="blog-single-sidebar-tags">
                            <h3 class="blog-sidebar-title uppercase">
                                Amerities
                                <a href="<?php echo site_url() ?>/property_amenities/by/<?php echo $result['property_id']?>"><i class="fa fa-pencil"></i></a>
                            </h3>
                            <ul class="blog-post-tags">
                                <?php  foreach($features as $feat) { ?>
                                <li class="uppercase">
                                    <a href="javascript:;"><?php echo $feat['name'] ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="blog-single-sidebar-ui">
                            <h3 class="blog-sidebar-title uppercase">
                                Fotografias
                                <a href="<?php echo site_url() ?>/property_photo/by/<?php echo $result['property_id']?>"><i class="fa fa-pencil"></i></a>
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