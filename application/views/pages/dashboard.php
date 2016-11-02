<?php
    $nivel = $this->session->userdata('level');
    if($this->uri->segment(3)==''){
        $Id = $this->session->userdata('property_id');
    } else {
        $Id = $this->uri->segment(3);
    }
?>
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
                    <span>Dashboard</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">
            <? echo $title; ?>
            <div class="actions pull-right">
                <div class="btn-group">
                    <a class="btn dark btn-outline" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-eye"></i> Ver Unidades
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="<?php echo site_url() ?>/property/unities/<?php echo $Id ?>">
                                <i class="fa fa-building"></i> Ver / Agregar Unidades
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
        
        <!-- BEGIN DASHBOARD STATS 1
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $visitors?>">0</span>
                        </div>
                        <div class="desc"> Visitantes </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $howmuch ?>">0</span>M$ </div>
                        <div class="desc"> Ventas </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $howmanysold ?>">0</span>
                        </div>
                        <div class="desc"> Unidades vendidas </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $manyfree ?>">0</span>
                        </div>
                        <div class="desc"> Unidades disponibles </div>
                    </div>
                </a>
            </div>
        </div>-->
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Visitas</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="visitantes" class="chart" style="height:300px;width:594px;"></div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-red-sunglo hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Ventas</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="ventas" style="height: 300px;"></div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Nacionalidades</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-microphone font-dark hide"></i>
                            <span class="caption-subject bold font-dark uppercase"> Proyecto<?php if($this->session->userdata('level')==2) { ?>s disponibles<? } ?></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                        <?php foreach($property as $p) {?>
                            <div class="col-md-4">
                                <div class="mt-widget-4">
                                    <div class="mt-img-container">
                                        <img src="<?php echo base_url()?>/upload/<?php echo $p['file'] ?>" />
                                    </div>
                                    <div class="mt-container bg-dark-opacity">
                                        <div class="mt-head-title"> <?php echo $p['name'] ?></div>
                                        <!--<div class="mt-footer-button">
                                            <a href="<?php echo site_url()?>/property/see/<?php echo $p['property_id'] ?>" class="btn btn-circle btn-danger btn-sm">
                                                <?php echo $p['country'] ?>
                                            </a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <?php //if($this->session->userdata('level')==1) { ?>
                            <div class="col-md-8" style="height: 390px">
                                <h3><?php echo $p['name'] ?></h3>
                                <p>
                                   <?php echo $p['description'] ?> 
                                </p>
                                <ul>
                                    <li><?php echo $p['address'] ?></li>
                                    <li><?php echo $p['city'] ?></li>
                                    <li><?php echo $p['province'] ?> <?php echo $p['country'] ?></li>
                                    <li><?php echo $p['phone'] ?> </li>
                                    <li><?php echo $p['email'] ?> </li>
                                </ul>
                                <p>
                                    <a href="<?php echo site_url()?>/property/see/<?php echo $p['property_id'] ?>" class="btn btn-circle btn-danger btn-sm">
                                        Ver proyecto completo
                                    </a>
                                </p>
                            </div>
                            <? //} ?>
                        <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- END CONTENT BODY -->
</div>

<?=json_encode($properties)?>

<script>
        /*
            ZOOM INICIAL (CENTRO), AKA EJ. PUNTA DEL ESTE
        */
        /*
            PARAM1, PARAM2
            LAT  CENTRO, LAT PAIS VISITANTES
            LONG  CENTRO, LONG PAIS VISITANTES
        */
        /*
            ID = uuid
            PAIS + TOTAL
            LAT PAIS VISITANTES
            LONG PAIS VISITANTES
            ESCALA X
        */
window.onload = function(){
    var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";
    <?php $location = explode(',',$properties[0]['location']); ?>
    var dataPoints = {
        "map": "worldLow",
        "zoomLevel": 6,
        "zoomLongitude": <?=$location[1]?>,
        "zoomLatitude": <?=$location[0]?>,
        "lines": [ 
        <? foreach ($visitor as $visit) { ?>
            {
                <?php 
                    echo ' "latitudes": [ '.$location[0].', '.$visit['lat'].' ],';
                    echo ' "longitudes": [ '.$location[1].', '.$visit['lng'].' ]';
                ?>
            },
        <? } ?>
        ],
        "images": [ 
            {
                "id": "<?=$properties[0]['property_id']?>",
                "svgPath": targetSVG,
                "title": "<?=$properties[0]['name']?>",
                "latitude": <?=$location[0]?>,
                "longitude": <?=$location[1]?>,
                "scale": 2
            },
            <? foreach ($visitor as $visit) { ?>
            {
                "svgPath": targetSVG,
                "title": "<?=$visit['country']?> <?=$visit['total']?>",
                "latitude": <?=$visit['lat']?>,
                "longitude": <?=$visit['lng']?>,
                "scale": 1
            },
            <? } ?>
        ]
    };
    //
    var dataValues = [<? foreach ($sales as $sale) { ?>
        {
        "date": "<?=$sale['date']?>",
        "value": <?=$sale['amount']?>
      },
    <? } ?>]
    //
    var dataVisits = [<? foreach ($visits as $visit) { ?>
        {
        "date": "<?=$visit['date']?>",
        "value": <?=$visit['value']?>
      },
    <? } ?>]
    //
    mapadevisitas(dataPoints,"chartdiv");
    mapadeventas(dataValues,"ventas");
    mapadevisitantes(dataVisits,"visitantes");
    
}//onLoad()
console.debug('dash',<?php echo json_encode($this->session->userdata)?>)
</script>