<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>
    
    <?php if( count($getRegsitersDuplicates) > 1 ): ?>

        <div class="m-heading-1 border-green m-bordered">
            
            <h3 style="margin-bottom: 1px;">Este cliente tiene mas productos asocioados a su cuenta</h3>
            Puedes acceder a su ficha o registro haciendo click en su nombre.

            <?php foreach ($getRegsitersDuplicates as $key => $value): ?>
                
                <?php if( $value->getId() != $getRegistro->getId()): ?>
                    <p> <strong>Registro <?= $value->getId() ?></strong>. <a target="_blank" href="<?= site_url('registros/view/'.$value->getId()) ?>"><?= $value->getName() ?> <?= $value->getFirstName() ?> <?= $value->getLastName() ?></a> | Prima: <?= $value->getPrima() ?> </p>
                <?php endif ?>

            <?php endforeach ?>
            

        </div>

    <?php endif ?>

    <div class="row">

        <div class="col-md-8">

            <div class="portlet light bordered">

                <?= $this->load->view('include/portlet_title') ?>

                <div class="portlet-body flip-scroll">
                    
                    <form role="form" method="post">

                        <?= $this->load->view('include/form_edit') ?>


                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="portlet light bordered">

                <div class="portlet-title">

                    <button id="btn-chronometre" data-user="<?= $getRegistro->getIdusuario()->getId() ?>" data-record="<?= $getRegistro->getId() ?>" style="width: 100%" class="btn grey-mint start" type="button"><i class=" icon-call-end "></i> Comenzar llamada</button>

                </div>

                <div class="portlet-body flip-scroll">

                    <?= $this->load->view('include/right_view') ?>

                </div>

                <div class="portlet-footer">
                    <hr/>
                    <a href="<?= site_url('login/timeout') ?>" style="width: 100%" class="btn green" ><i class="fa fa-coffee" aria-hidden="true"></i> Descanso</a>

                </div>

            </div>

        </div>

        <?php if($getRegistroLlamadas): ?>

            <div class="col-md-12">

                <div class="portlet light bordered">

                    <div class="portlet-body flip-scroll">

                        <?= $this->load->view('include/record_call') ?>

                    </div>

                </div>

            </div>

        <?php endif ?>

    </div>

</div>

<?= $this->load->view('include/modals/registrosllamadas_modal') ?>
<?= $this->load->view('include/modals/argumentario_modal') ?>
<?= $this->load->view('include/modals/send_info_modal') ?>