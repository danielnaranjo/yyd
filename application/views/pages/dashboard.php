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
        <h3 class="page-title"> <? echo $title; ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        
        <!-- BEGIN DASHBOARD STATS 1-->
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
        </div>
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
                        <div id="visitantes" class="chart"></div>
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
                                        <div class="mt-footer-button">
                                            <a href="<?php echo site_url()?>/property/see/<?php echo $p['property_id'] ?>" class="btn btn-circle btn-danger btn-sm">
                                                <?php echo $p['country'] ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($this->session->userdata('level')==1) { ?>
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
                            <? } ?>
                        <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- END CONTENT BODY -->
</div>


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

    function getCountryInfo(country){
        $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+country, function(response){
            return response.results[0].geometry.location;
        });
    }

    $.getJSON('<?=site_url()?>/administrator/getCountries', function(response){
        //console.log('response',response);
        var location = response.properties[0].location,
            property = response.properties[0].name, 
            local = location.split(',');
        console.log(property, local[0], local[1]);
        var dataPoints = {
            "map": "worldLow",
            "zoomLevel": 6,
            "zoomLongitude": local[1],
            "zoomLatitude": local[0],
            "lines": [ 
                {
                    "latitudes": [ local[0], local[0] ],//
                    "longitudes": [ local[1], local[1] ]//
                }
            ],
            "images": [ 
                {
                    "id": "1",
                    "svgPath": targetSVG,
                    "title": property,//
                    "latitude": local[0],//
                    "longitude": local[1],//
                    "scale": 1
                }
            ]
        };
/*
        for(var i = 0; i < response.visitor.length; i++){
            //getCountryInfo('Venezuela');
            //console.log(response.visitor[i].country, response.visitor[i].total);
            var country = response.visitor[i].country,
                total = response.visitor[i].total;
            $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+country, function(res){
                //console.log(country, total, res.results[0].geometry.location);
                dataPoints['lines']['latitudes']= parseInt(res.results[0].geometry.location.lat);
                dataPoints['lines']['latitudes']= -28.416097;
                dataPoints['lines']['longitudes']= parseInt(res.results[0].geometry.location.lng);
                dataPoints['lines']['longitudes']= -53.61667199999999;
                console.log(dataPoints.lines);
            });
        }
*/
        mapadevisitas(dataPoints);
    });//getJSON
}

</script>