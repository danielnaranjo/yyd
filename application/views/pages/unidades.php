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
                        <table class="table table-striped table-hover table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th> Unidad </th>
                                    <th> Total </th>

                                    <th> No disponibles </th>
                                    <th> Disponibles </th>
                                    <!--<th> free </th>-->
                                    <th> Reservadas </th>
                                    <th> Vendidas </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $t=0;
                                $n=0;
                                $af=0;
                                $re=0;
                                $s=0;
                                foreach($result as $r) {
                            ?>
                                <tr>
                                    <td> <?php echo $r['type'] ?> </td>
                                    <td> <?php echo $r['total']; $t +=$r['total']; ?> </td>

                                    <td> <?php echo $r['none']; $n +=$r['none']; ?> </td>
                                    <td> <?php echo $r['available']+$r['free']; $af +=$r['available']+$r['free']; ?> </td>
                                    <!--<td> <?php echo $r['free'] ?> </td>-->
                                    <td> <?php echo $r['reserved']; $re +=$r['reserved']; ?> </td>
                                    <td> <?php echo $r['sold']; $s +=$r['sold']; ?> </td>
                                </tr>
                                <? } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>  </td>
                                    <td> <?php echo $t ?> </td>
                                    <td> <?php echo $n ?> </td>
                                    <td> <?php echo $af ?> </td>
                                    <!--<td> <?php echo $r['free'] ?> </td>-->
                                    <td> <?php echo $re ?> </td>
                                    <td> <?php echo $s ?> </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
            <div class="col-md-3">
                <a href="<?php echo site_url() ?>/transaction/download/unities">
                    <i class="fa fa-download"></i>
                     Descargar CSV
                </a>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->