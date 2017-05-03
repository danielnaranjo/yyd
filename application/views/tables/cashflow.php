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
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <table class="table table-striped table-hover table-bordered" id="sample_2">
                            <thead>
                                <tr>
                                    <th> Unidad </th>
                                    <th> Propietario </th>
                                    <th> Fecha Venta</th>
                                    <th> Total </th>
                                    <th> Pagado </th>
                                    <!--<th> Forma de pago </th>-->
                                    <th> Pendiente </th>

                                    <?
                                        $meses = [
                                            '',//null
                                            'Ene','Feb','Mar','Abr',
                                            'May','Jun','Jul','Ago',
                                            'Sep','Oct','Nov','Dic'
                                            ];
                                        $iniciodeobra=8; // Mes de inicio: Agosto = 8
                                        $genMes = 0; // Genera la cantidad de <td> para los montos
                                        $iniciodeconstruccion=16;// Original 16
                                        $fechadeentrega=19;// Original 18
                                    ?>
                                    <? for($i=$iniciodeconstruccion; $i<=$fechadeentrega; $i++) { ?>

                                        <? if($i==$iniciodeconstruccion) { // Desde Ago 2016 ?>

                                            <? for($j=$iniciodeobra; $j<=12; $j++) { $genMes++; // Mitad año 2016 ?>
                                                <th style="display:none;"> <?= $meses[$j] .'-'. $i?> </th>
                                            <? }  ?>

                                        <? } else { // Hasta Dic 2018 ?>

                                            <? for($j=1; $j<=12; $j++) { $genMes++; // Todo 2017/18 ?>
                                                <th> <?= $meses[$j] .'-'. $i?> </th>
                                            <? } ?>

                                        <? }  ?>

                                    <? }  ?>
                                    <th> Entrega </th>
                                </tr>
                            </thead>
                            <tbody>
                            <? $moneda="$";?>
                            <?php foreach($result as $r) {?>
                                <tr>
                                    <td>
                                        <a class="edit" href="<?=site_url()?>/client/profile/<?=$r['client_id']?>">
                                            <?php echo $r['unidad'] ?>
                                        </a>
                                    </td>
                                    <td> <?php echo $r['propietario'] ?> </td>
                                    <td> <?php echo $r['fecha'] ?> </td>
                                    <td> <?php echo $moneda.number_format($r['precio'],2); ?> </td>
                                    <td id="pagado_<?=$r['unidad']?>"> 0<?php // echo $moneda.number_format($r['total'],2); ?> </td>
                                    <!--<td> N/A<?php //echo $r['registered'] ?> </td>-->
                                    <td id="pendiente_<?=$r['unidad']?>">
                                    <?php
                                        $resta=$r['precio']-$r['total'];
                                        echo $moneda.number_format($resta,2);
                                    ?>
                                    </td>
                                    <?/* for($x=0; $x<$genMes; $x++) { ?>
                                        <td id="<?=$r['unidad'] ?>">
                                            -
                                        </td>
                                    <? } */?>
                                    <? for($i=$iniciodeconstruccion; $i<=$fechadeentrega; $i++) { ?>

                                        <? if($i==$iniciodeconstruccion) { // Desde Ago 2016 ?>

                                            <? for($j=$iniciodeobra; $j<=12; $j++) { $genMes++; // Mitad año 2016 ?>
                                                <td style="display:none;" id="<?=$r['unidad'] ?>-<?=$j ?>-20<?=$i ?>"> </td>
                                            <? }  ?>

                                        <? } else { // Hasta Dic 2018 ?>

                                            <? for($j=1; $j<=12; $j++) { $genMes++; // Todo 2017/18 ?>
                                                <td id="<?=$r['unidad'] ?>-<?=$j ?>-20<?=$i ?>"> </td>
                                            <? } ?>

                                        <? }  ?>

                                    <? }  ?>
                                    <td> <?//=$r['propietario'] ?> </td>
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
<script>
var getFlow = function(){
    $.getJSON('<?=site_url() ?>/transaction/bymonth', function(d) {
        for(var i = 0; i < d.length; i++){
            $('#'+d[i].u+'-'+d[i].m+'-20'+d[i].a ).html('<strong>'+d[i].t+'</strong>');
        };
        getMethods();
        getPaid();
    });
}
var getMethods = function(){
    $.getJSON('<?=site_url() ?>/transaction/invoicesbymonth', function(d) {
        for(var i = 0; i < d.length; i++){
            $('#'+d[i].u+'-'+d[i].m+'-20'+d[i].a ).append('<br>'+d[i].t);
        };
    });
}
var getPaid = function(){
    $.getJSON('<?=site_url() ?>/transaction/paid', function(d) {
        for(var i = 0; i < d.length; i++){
            $('#pagado_'+d[i].u).html(d[i].t);
        };
    });
}
window.onload = function(){
    toastr.info('Por favor, espere..','Cargando Cashflow');
    console.log('Loaded!');
    getFlow();
    $('#sample_2_paginate .btn').on('click', function(){
        getFlow();
        console.log('cliked!');
    })
}
</script>
