<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet light bordered">

                <?= $this->load->view('include/portlet_title') ?>

                <div class="portlet-body flip-scroll">
                    <?php if($getResult): ?>

                        <?= $this->load->view('include/table') ?>

                    <?php else: ?>

                        <div class="alert alert-warning" role="alert">Esta sección no tiene datos para mostrar.</div>

                    <?php endif ?>


                </div>

            </div>

        </div>

    </div>

</div>
