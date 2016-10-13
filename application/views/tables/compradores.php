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
                    <a href="<?php echo site_url() ?>/property/all">Propiedades</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?php echo site_url() ?>/property/see/<?php echo $result['property_id']?>"><?php echo $result['name']?></a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Visitas</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $result['name']?></h3>
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
                                    <th> Nombre </th>
                                    <th> Apellido </th>
                                    <th> Fecha de visita </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($visits as $r) {?>
                                <tr>
                                    <td> <?php echo $r['firstname'] ?> </td>
                                    <td> <?php echo $r['lastname'] ?> </td>
                                    <td> <? echo $r['registered'] ?></td>
                                    <td>
                                        <a href="<?php echo site_url() ?>/client/profile/<?php echo $r['client_id'] ?>" class="view">Ver perfil</a>
                                    </td>
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
