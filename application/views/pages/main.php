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
                    <span>Broker</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Proyectos disponibles</h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <?php foreach($property as $p) {?>
                <div class="col-md-4">
                    <div class="mt-widget-4 bg-grey-gallery bg-font-grey-gallery">
                        <div class=""><!-- mt-img-container -->
                            <a href="<?php echo site_url()?>/property/see/<?php echo $p['property_id'] ?>">
                                <img src="<?php echo base_url()?>/upload/<?php echo $p['photo'] ?>" class="img-responsive" />
                            </a>
                        </div>
                        <div class="grey-gallery" style="padding: 10px 20px !important;">
                            <p>
                                <?php echo $p['name'] ?>. <?php echo $p['country'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->    