<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="row">

        <div class="col-md-12">

            <div class="profile-sidebar">

                <?= $this->load->view('include/profile_sidebar') ?>

            </div>

            <div class="portlet profile-content light bordered">

                <?= $this->load->view('include/portlet_title') ?>

                <div class="portlet-body flip-scroll">

                    <?= $this->load->view('include/form_edit') ?>

                </div>

                <?php if($getRow->getIdrol()->getId() == 7): ?>
                    
                    <?= $this->load->view('include/team') ?>

                <?php endif ?>
                
            </div>

        </div>

    </div>

</div>