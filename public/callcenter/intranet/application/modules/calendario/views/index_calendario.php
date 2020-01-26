<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="row">
        
        <?php if($userList): ?>

        <div class="col-md-3">

            <div class="portlet light bordered">

            	<div class="portlet-title">

                	<span class="caption-subject bold uppercase font-dark">

                		<i class="icon-notebook"></i> Agenda

                	</span>

                </div>

                <div class="portlet-body flip-scroll">
                       
                    <?= $this->load->view('include/users') ?>

                </div>

            </div>

        </div>

        <?php else: ?>

            <input id="<?= $usuarioid ?>" type="hidden" name="comercial">

        <?php endif ?>

        <div class="<?php if($userList) echo 'col-md-9' ?><?php if(!$userList) echo 'col-md-12' ?>">

            <div class="portlet light bordered">

                <?= $this->load->view('include/portlet_title') ?>

                <div class="portlet-body flip-scroll">
                     
                     <div id="content-calendar">

                        <?= $calendar ?>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->load->view('include/modals/evento_edit') ?>
<?= $this->load->view('include/modals/eventos_add') ?>
<?= $this->load->view('include/modals/eventos_list') ?>