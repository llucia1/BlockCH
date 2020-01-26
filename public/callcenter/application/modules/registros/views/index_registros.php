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
                    
                    <div id="footer-table">
                        
                        <div class="col-md-6"></div>
                        <div class="col-md-6 paginator">
                            
                            <?= $start + 1 ?> a <?= $next ?> de <?= $totalRecord ?>
                            
                            <?php if($start > 0): ?>

                            <a href="<?= site_url($path.'/'.$previous.'/'.$start2) ?>" class="btn btn-default btn-pagination bnt-previous"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>

                            <?php endif ?>
                            
                            <a href="<?= site_url($path.'/'.$next.'/'.$start2.$searcher_param) ?>" class="btn btn-pagination btn-default bnt-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>

                        </div>

                    </div>
                    

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->load->view('include/modals/registros_modal') ?>
<?= $this->load->view('include/modals/reasignar_modal') ?>
