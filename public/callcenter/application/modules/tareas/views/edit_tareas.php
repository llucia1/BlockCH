<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="row">

    <input name="goBackTo" id="goBackTo" type="hidden" value="tareas" />

    <?php if($getRow->getIdusuarioto()->getId() == 21): ?>

        <div class="col-md-12">

            <div class="portlet light bordered">
                
                <?= $this->load->view('include/documentacion') ?>

            </div>

        </div>

        <div class="col-md-12">

            <div class="portlet light bordered">
                
                <?= $this->load->view('include/side_left') ?>

            </div>

        </div>

    <?php elseif($getRow->getIdusuarioto()->getIdrol()->getId() == 3): ?>

        <div class="col-md-12">

            <div class="portlet light bordered">
                
                <?= $this->load->view('include/documentacion') ?>

            </div>

        </div>

        <div class="col-md-12">

            <div class="portlet light bordered">
                
                <?= $this->load->view('include/side_left') ?>

            </div>

        </div>

        <?= $this->load->view('modals/attach_modal') ?>

    <?php elseif($getRow->getIdusuarioto()->getIdrol()->getId() == 8): ?>

         <div class="col-md-7">

            <div class="portlet light bordered">
                
                <?= $this->load->view('include/side_left') ?>

            </div>

        </div>

        <div class="col-md-5">

            <div class="portlet light bordered">
                
                <?= $this->load->view('include/cierre') ?>

            </div>

        </div>


    <?php else: ?>

        <div class="col-md-7">

            <div class="portlet light bordered">
                
                <?= $this->load->view('include/side_left') ?>

            </div>

        </div>

        <div class="col-md-5">

            <div class="portlet light bordered">
                
                <?= $this->load->view('include/side_rigth') ?>

            </div>

        </div>

    <?php endif ?>


    </div>

</div>

<?= $this->load->view('include/modals/add_se_es_modal') ?>