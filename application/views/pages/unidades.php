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
                                    <th> Vendidas </th>
                                    <th> Reservadas </th>
                                    <th> Disponibles </th>
                                    <th> No disponibles </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($result as $r) {?>
                                <tr>
                                    <td> <?php echo $r['type'] ?> </td>
                                    <td> <?php echo $r['total'] ?> </td>
                                    <td> <?php echo $r['none'] ?> </td>
                                    <td> <?php echo $r['free'] ?> </td>
                                    <td> <?php echo $r['reserved'] ?> </td>
                                    <td> <?php echo $r['sold'] ?> </td>
                                </tr>
                                <? } ?>
                            </tbody>
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