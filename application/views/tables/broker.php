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
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <button id="sample_editable_1_new" class="btn green"> Agregar nuevo
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <td> name </td>
                                    <td> number </td>
                                    <td> price </td>
                                    <td> comission </td>
                                    <td> date </td>
                                    <td> amount </td>
                                    <td> split </td>
                                    <td> name </td>
                                    <td> surname </td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($result as $r) {?>
                                <tr>
                                    <td> <?php echo $r['property'] ?> </td>
                                    <td> <?php echo $r['number'] ?> </td>
                                    <td> <?php echo $r['price'] ?> </td>
                                    <td> <?php echo $r['comission'] ?> </td>
                                    <td> <?php echo $r['date'] ?> </td>
                                    <td> <?php echo $r['amount'] ?> </td>
                                    <td> <?php echo $r['split'] ?> </td>
                                    <td> <?php echo $r['name'] ?> </td>
                                    <td> <?php echo $r['surname'] ?> </td>
                                </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
            <div class="col-md-3">
                <a href="<?php echo site_url() ?>/transaction/download/brokers">
                    <i class="fa fa-download"></i>
                     Descargar CSV
                </a>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->