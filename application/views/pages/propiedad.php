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

            <?php if($this->session->userdata('level')!=2) { ?>
            <div class="actions pull-right">
                <div class="btn-group">
                    <a class="btn green-haze btn-outline" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-search"></i> Vista rapida
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <?php if($free>0) { ?>
                            <a href="<?php echo site_url() ?>/property/unities/<?php echo $result['property_id']?>">
                                <i class="fa fa-building"></i> Ver unidades disponibles
                            </a>
                            <? } else { ?>
                            <a href="javascript:;">
                                <i class="fa fa-building"></i> No unidades disponibles
                            </a>
                            <? } ?>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>/property/people/<?php echo $result['property_id']?>">
                                <i class="fa fa-user"></i> Ver compradores 
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>/property/visitors/<?php echo $result['property_id']?>">
                                <i class="fa fa-eye"></i> Ver visitantes
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
                            <img src="<?php echo base_url() ?>/upload/<?php echo $photos[0]['photo']?>" /> 
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
                            <h3 class="blog-sidebar-title uppercase">Amerities</h3>
                            <ul class="blog-post-tags">
                                <?php  foreach($features as $feat) { ?>
                                <li class="uppercase">
                                    <a href="javascript:;"><?php echo $feat['name'] ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="blog-single-sidebar-ui">
                            <h3 class="blog-sidebar-title uppercase">Fotografias</h3>
                            <div class="row ui-margin">
                                <?php foreach($photos as $photo) { ?>
                                <div class="col-xs-4 ui-padding">
                                    <a href="<?php echo base_url() ?>/upload/<?php echo $photo['photo'] ?>" target="_blank">
                                        <img src="<?php echo base_url() ?>/upload/<?php echo $photo['photo'] ?>" />
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