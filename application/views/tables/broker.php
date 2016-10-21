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
                                    <th style="text-transform: capitalize;" > <? echo traducir('property') ?> </th>
                                    <th style="text-transform: capitalize;" > <? echo traducir('number') ?> </th>
                                    <th style="text-transform: capitalize;" > <? echo traducir('price') ?> </th>
                                    <!--<th style="text-transform: capitalize;" > <? echo traducir('comission') ?> </th>-->
                                    <th style="text-transform: capitalize;" > <? echo traducir('date') ?> </th>
                                    <th style="text-transform: capitalize;" > <? echo traducir('amount') ?> </th>
                                    <th style="text-transform: capitalize;" > <? echo traducir('split') ?> </th>
                                    <th style="text-transform: capitalize;" > <? echo traducir('firstname') ?> </th>
                                    <th style="text-transform: capitalize;" > <? echo traducir('lastname') ?> </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $price=0;
                                $amount=0;
                                $split=0;
                                foreach($result as $r) {
                            ?>
                                <tr>
                                    <td> <?php echo $r['property'] ?> </td>
                                    <td> <?php echo $r['number'] ?> </td>
                                    <td> USD $<?php echo $r['price']; $price +=$r['price']; ?> </td>
                                    <!--<td> <?php echo $r['comission'] ?> </td>-->
                                    <td> <?php echo $r['date'] ?> </td>
                                    <td> USD $<?php echo $r['amount']; $amount +=$r['amount']; ?> </td>
                                    <td> USD $<?php echo $r['split']; $split +=$r['split']; ?> </td>
                                    <td> <?php echo $r['name'] ?> </td>
                                    <td> <?php echo $r['surname'] ?> </td>
                                </tr>
                                <? } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>  </td>
                                    <td>  </td>
                                    <td> USD $<?=$price ?> </td>
                                    <td>  </td>
                                    <td> USD $<?=$amount ?> </td>
                                    <td> USD $<?=$split ?> </td>
                                    <td>  </td>
                                    <td>  </td>
                                </tr>
                            </tfoot>
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