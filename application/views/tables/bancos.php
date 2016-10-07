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
                    <span><?php echo $title ?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $title ?></h3>
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
                                    <th> Banco </th>
                                    <th> Cuenta / CBU / Account </th>
                                    <th> País </th>
                                    <th> Divisa </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($result as $r) {?>
                                <tr>
                                    <td> <?php echo $r['name'] ?> </td>
                                    <td> <?php echo $r['account'] ?> <?php echo $r['swift'] ?></td>
                                    <td> <?php echo $r['country'] ?> </td>
                                    <td> <?php echo $r['currency'] ?> </td>
                                    <td>
                                        <a class="edit" href="javascript:;">Ver instrucciones</a><?php  if($this->session->userdata('level')!=2) { ?> | 
                                        <a class="edit" href="<? echo site_url()?>/bank/action/edit/<? echo $r['bank_id']?>">Editar</a> | 
                                        <a class="delete" href="javascript:;">Borrar</a><? } ?>
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