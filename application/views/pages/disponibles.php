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
                    <a href="<?php echo site_url() ?>/property/see/<?php echo @$result[0]['property_id']?>"><?php echo @$result[0]['name']?></a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Unidades disponibles</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"><?php echo @$result[0]['name']?></h3>
        <!-- END PAGE TITLE-->

        <!-- END PAGE HEADER-->
        <?php if(count($result)>0) { ?>
        <div class="portfolio-content portfolio-1">
            <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> Todas
                    <div class="cbp-filter-counter"></div>
                </div>
                <?php foreach($types as $t) { ?>
                <div data-filter=".<?php echo strtolower($t['type']) ?>" class="cbp-filter-item btn dark btn-outline uppercase"> <?php echo $t['type'] ?>
                    <div class="cbp-filter-counter"></div>
                </div>
                <?php } ?>
            </div>
            <div id="js-grid-juicy-projects" class="cbp">
                <?php foreach($result as $r) { ?>
                <div class="cbp-item <?php echo strtolower($r['type']) ?>"> <!-- filtrar por catetgorias -->
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            <img src="<?php echo base_url() ?>/upload/16-great-room.jpg" alt=""> </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                    <a href="#" class="btn blue uppercase">DETALLE</a>
                                    <a href="#" class="btn blue uppercase">RESERVAR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php echo $r['type'] ?></div>
                    <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center"><?php echo $r['number'] ?></div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>
                    <small>* Imagenes ilustrativas</small>
                </p>
            </div>
        </div>
        <? } else { ?>
            <p>No hay unidades disponibles</p>
        <? } ?>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->