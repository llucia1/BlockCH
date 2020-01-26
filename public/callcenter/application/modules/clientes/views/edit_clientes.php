<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet light bordered">

                <div class="portlet-title">

                    <?php if($getRow->getCuentasseguimiento()): ?>

                        <?php foreach ($getRow->getCuentasseguimiento() as $key => $seguimiento): ?>
                            
                            <?php if($seguimiento->getActual() == 1): ?>
                                
                                <button style="float: right;" class="btn btn-danger mt-sweetalert" data-title="Sweet Alerts" data-message="Beautiful popup alerts" data-allow-outside-click="true" data-confirm-button-class="btn-danger"><?= $seguimiento->getTipo() ?></button>

                            <?php endif ?>

                        <?php endforeach ?>


                    <?php else: ?>

                    <button style="float: right;" class="btn btn-default mt-sweetalert" data-title="Sweet Alerts" data-message="Beautiful popup alerts" data-allow-outside-click="true" data-confirm-button-class="btn-default">Sin seguiminento</button>


                <?php endif ?>

                </div>

                <?= $this->load->view('include/link_tab') ?>

                
                <div class="tab-content">

                    <?= $this->load->view('include/form_edit/detalle_cliente_tab') ?>
                    <?= $this->load->view('include/form_edit/info_detallada_tab') ?>

                    <?php if($rol == 1 OR $rol == 8): ?>

                        <?= $this->load->view('include/form_edit/seguimiento_estado_tab') ?>

                    <?php endif ?>

                    <?= $this->load->view('include/form_edit/documentacion_tab') ?>
                    <?= $this->load->view('include/form_edit/reportes_tab') ?>

                    <?php if($rol == 1 OR $rol == 8): ?>

                        <?= $this->load->view('include/form_edit/agendar_tab') ?>

                    <?php endif ?>

                </div>

        </div>

    </div>

</div>
<?= $this->load->view('modals/attach_modal') ?>