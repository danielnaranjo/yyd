<?
/* variables */
$nivel = $this->session->userdata('level');
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
                    <a href="<?php echo site_url() ?>/client/all">Compradores</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span><?php echo $result[0]['lastname'].', '. $result[0]['firstname'] ?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"><?php echo @$property[0]['name'] ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="<?php echo base_url() ?>upload/avatar.png" class="img-responsive" alt="">
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> <?php echo $result[0]['firstname'].' '. $result[0]['lastname'] ?> </div>
                            <div class="profile-usertitle-job"> <?php echo @$info[0]['country'] ?> </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->

                    </div>
                    <!-- END PORTLET MAIN -->
                    <!-- PORTLET MAIN -->
                    <div class="portlet light ">
                        <!-- STAT -->
                        <? if(count($unity)>0) { ?>
                        <div class="row list-separated profile-stat">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="uppercase profile-stat-title"> <?php echo $unity[0]['number'] ?> </div>
                                <div class="uppercase profile-stat-text"> Unidad </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="uppercase profile-stat-title"> <?php echo $unity[0]['square'] ?> </div>
                                <div class="uppercase profile-stat-text"> Pies </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="uppercase profile-stat-title"> <?php echo $parking ?> </div>
                                <div class="uppercase profile-stat-text"> Parking </div>
                            </div>
                        </div>
                        <? } else {?>
                        <div>
                            <div class="margin-top-20 margin-bottom-30 profile-desc-text">
                                <a href="#" class="btn btn-default btn-block">Agregar unidad</a>
                            </div>
                        </div>
                        <? } ?>
                        <!-- END STAT -->
                        <? if(count($info)>0) { ?>
                        <div>
                            <h4 class="profile-desc-title">Información</h4>
                            <span class="profile-desc-text">
                                <!-- descripcion -->
                            </span>
                            <div class="margin-top-20 profile-desc-text">
                                <?php echo $info[0]['address'] ?>. <?php echo $info[0]['city'].', '.$info[0]['country'] ?>
                            </div>
                            <div class="margin-top-20 profile-desc-text">
                                <?php echo auto_link($info[0]['phone']) ?>
                            </div>
                            <div class="margin-top-20 profile-desc-text">
                                <?php echo mailto($info[0]['email'], 'Contactar') ?>
                            </div>
                        </div>
                        <? } ?>
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <?php if($nivel!=2) {?>
                        <div class="col-md-6">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <span class="caption-subject font-blue-madison bold uppercase">Transacciones</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable table-scrollable-borderless">
                                        <table class="table table-hover table-light">
                                            <thead>
                                                <tr class="uppercase">
                                                    <th> BROKER </th>
                                                    <th> MONTO </th>
                                                    <th> TRANSACCION </th>
                                                    <th> FECHA </th>
                                                </tr>
                                            </thead>
                                            <?php foreach($transactions as $m) {?>
                                            <tr>
                                                <td> <?php echo $m['lastname'] ?> </td>
                                                <td> <?php echo $m['amount'] ?> </td>
                                                <td> <a data-toggle="modal" href="#basic" class="primary-link"><?php echo $m['number'] ?></a> </td>
                                                <td> <?php echo $m['date'] ?> </td>
                                            </tr>
                                            <?php } ?>
                                            <?php if(count($transactions)==0) { ?>
                                            <tr>
                                                <td colspan="4">
                                                    No hay transacciones
                                                </td>
                                            </tr>
                                            <?php }  ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                        <?php }  ?>
                        <div class="col-md-6">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">ACTIVIDAD</span>
                                        <a href="<?php echo site_url() ?>/client/note/1"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                            <ul class="feeds">
                                            <?php if(count($notes)>0) { ?>
                                                <?php foreach ($notes as $n) { // columnas ?>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="">
                                                                    <i class="fa fa-check-square-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"><? echo $n['note'] ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 
                                                        <!-- convertir a moment() -->
                                                        <?php 
                                                            $fecha = mysql_to_unix($n['created']);
                                                            $now = time();
                                                            $units = 2;
                                                            echo timespan($fecha, $now, $units) . ' ago';
                                                            //echo timespan($fecha, $now) . ' ago';
                                                        ?> 
                                                        </div>
                                                    </div>
                                                </li>
                                                <? } ?>
                                            <? } else { ?>
                                                <li>No hay notas disponibles</li>
                                            <? } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                    <?php if($nivel!=2) {?>
                    </div>
                    <div class="row">
                    <? } ?>
                        <div class="col-md-6">
                            <div class="portlet light portlet-fit " >
                                <div class="portlet-title" <?php if($nivel==2) {?>style="padding: 15px 20px 5px 20px !important;"<? } ?>>
                                    <div class="caption">
                                        <span class="caption-subject bold font-green uppercase"> Visitas</span>
                                        <a class="pull-right" href="javascript:;" onclick="javascript:visit(<? echo $result[0]['client_id']?>,1)">
                                            <i class="fa fa-check" aria-hidden="true"></i> 
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="timeline">
                                        <!-- TIMELINE ITEM -->
                                        <?php foreach($visits as $v) {?>
                                        <div class="timeline-item">
                                            <div class="timeline-badge">
                                                <div class="timeline-icon">
                                                    <?php if($v['activity']==1){ ?>
                                                    <i class="icon-user-following font-grey-cascade"></i>
                                                    <?php } else if($v['activity']==2){ ?>
                                                    <i class="icon-user-following font-green"></i>
                                                    <?php } else if($v['activity']==3){ ?>
                                                    <i class="icon-globe font-green-haze"></i>
                                                    <?php } else if($v['activity']==4){ ?>
                                                    <i class="icon-docs font-red-intense"></i>
                                                    <?php } else { ?>
                                                    <i class="icon-user-following font-green-haze"></i>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="timeline-body-arrow"> </div>
                                                <div class="timeline-body-head">
                                                    <div class="timeline-body-head-caption">
                                                        <span class="timeline-body-alerttitle font-green-haze">
                                                           <?php
                                                                if($v['activity']==1){ 
                                                                    echo "Nuevo cliente";
                                                                } else if($v['activity']==2){ 
                                                                    echo "Propiedad agregada";
                                                                } else if($v['activity']==3){ 
                                                                    echo "Visita";
                                                                } else if($v['activity']==1){ 
                                                                    echo "Pago registrado";
                                                                } else {
                                                                    echo "Consulta a la cuenta";
                                                                }
                                                            ?>
                                                        </span>
                                                        <span class="timeline-body-time font-grey-cascade">
                                                            <?php 
                                                                //echo $v['timestamp'];
                                                                $fecha = mysql_to_unix($v['timestamp']);
                                                                $now = time();
                                                                $units = 2;
                                                                echo timespan($fecha, $now, $units);
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="timeline-body-content">
                                                    <span class="font-grey-cascade">
                                                        <!-- -->
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-- END TIMELINE ITEM -->

                                        <?php if(count($visits)==0) { ?>
                                        <div class="timeline-item">
                                            <div class="timeline-badge">
                                                <div class="timeline-icon">
                                                    <i class="icon-puzzle font-green-haze"></i>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="timeline-body-arrow"> </div>
                                                <div class="timeline-body-head">
                                                    <div class="timeline-body-head-caption">
                                                        <span class="timeline-body-alerttitle font-green-haze">No tiene propiedades</span>
                                                        <span class="timeline-body-time font-grey-cascade"><?php echo date('d-m-Y') ?></span>
                                                    </div>
                                                </div>
                                                <div class="timeline-body-content">
                                                    <span class="font-grey-cascade">
                                                        <!-- -->
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php  } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>


<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Transacción</h4>
            </div>
            <div class="modal-body">
                <!-- BEGIN CONTENT  -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->

                    <!-- END PAGE HEADER-->
                    <div class="invoice">
                        <div class="row invoice-logo">
                            <div class="col-xs-6 col-xs-offset-6">
                                <p> #5652256 / 28 Feb 2013
                                    <span class="muted"> Consectetuer adipiscing elit </span>
                                </p>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-xs-4">
                                <h3>Client:</h3>
                                <ul class="list-unstyled">
                                    <li> John Doe </li>
                                    <li> Mr Nilson Otto </li>
                                    <li> FoodMaster Ltd </li>
                                    <li> Madrid </li>
                                    <li> Spain </li>
                                    <li> 1982 OOP </li>
                                </ul>
                            </div>
                            <div class="col-xs-4">
                                <h3>About:</h3>
                                <ul class="list-unstyled">
                                    <li> Drem psum dolor sit amet </li>
                                    <li> Laoreet dolore magna </li>
                                    <li> Consectetuer adipiscing elit </li>
                                    <li> Magna aliquam tincidunt erat volutpat </li>
                                    <li> Olor sit amet adipiscing eli </li>
                                    <li> Laoreet dolore magna </li>
                                </ul>
                            </div>
                            <div class="col-xs-4 invoice-payment">
                                <h3>Payment Details:</h3>
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>V.A.T Reg #:</strong> 542554(DEMO)78 </li>
                                    <li>
                                        <strong>Account Name:</strong> FoodMaster Ltd </li>
                                    <li>
                                        <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
                                    <li>
                                        <strong>Account Name:</strong> FoodMaster Ltd </li>
                                    <li>
                                        <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Item </th>
                                            <th class="hidden-xs"> Description </th>
                                            <th class="hidden-xs"> Quantity </th>
                                            <th class="hidden-xs"> Unit Cost </th>
                                            <th> Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> 1 </td>
                                            <td> Hardware </td>
                                            <td class="hidden-xs"> Server hardware purchase </td>
                                            <td class="hidden-xs"> 32 </td>
                                            <td class="hidden-xs"> $75 </td>
                                            <td> $2152 </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="well">
                                    <address>
                                        <strong>Loop, Inc.</strong>
                                        <br/> 795 Park Ave, Suite 120
                                        <br/> San Francisco, CA 94107
                                        <br/>
                                        <abbr title="Phone">P:</abbr> (234) 145-1810 </address>
                                    <address>
                                        <strong>Full Name</strong>
                                        <br/>
                                        <a href="mailto:#"> first.last@email.com </a>
                                    </address>
                                </div>
                            </div>
                            <div class="col-xs-8 invoice-block">
                                <ul class="list-unstyled amounts">
                                    <li>
                                        <strong>Sub - Total amount:</strong> $9265 </li>
                                    <li>
                                        <strong>Discount:</strong> 12.9% </li>
                                    <li>
                                        <strong>VAT:</strong> ----- </li>
                                    <li>
                                        <strong>Grand Total:</strong> $12489 </li>
                                </ul>
                                <br/>
                                <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Imprimir
                                    <i class="fa fa-print"></i>
                                </a>
                                <a class="btn btn-lg green hidden-print margin-bottom-5"> Enviar
                                    <i class="fa fa-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
function visit(c,p){
    $.ajax({
        url: "<? echo site_url() ?>/client/visited",
        method: "POST",
        data: { client_id: c, property_id: p }
    }).done(function(data) {
        console.log('data', data);
        toastr.success('Visita registrada!');
    });
}
</script>