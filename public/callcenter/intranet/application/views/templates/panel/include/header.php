<div class="page-header navbar navbar-fixed-top">

    <div class="page-header-inner ">

        <div class="page-logo">

            <a href="#">

                <!--<img style="margin: 17px -5px 0;" width="155" src="<?= base_url('assets/pages/img/logo-big.png') ?>" alt="logo" class="logo-default" /> -->
                <img style="margin: 17px -5px 0;" width="155" src="<?= base_url('assets/apps/img/cabecera_web_eicbi-01.png') ?>" alt="logo" class="logo-default" /> 
                
                </a>
            
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
            
        </div>

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

        <div class="page-top">

            <div class="top-menu">

                <ul class="nav navbar-nav pull-right">
                    
                    <?php if(isset($searcher)): ?>

                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark">

                            <?php $this->load->view('templates/panel/'.basename(dirname(__FILE__)).'/searcher') ?>

                        </li>

                    <?php endif ?>

                    <!--ALERT EVENTOS-->

                    <?php $eventos = $this->doctrine->em->getRepository("Entities\\Calendario")->getEventByDate($this->session->userdata('usuarioid'),date('Y'),date('m'),date('d')) ?>

                     <?php if(count($eventos) > 0): ?>

                        <li onclick="window.location='<?= site_url('calendario')?>'" class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-calendar"></i>
                                <span class="badge badge-danger"> <?= count($eventos) ?> </span>
                            </a>
                            
                        </li>

                    <?php endif ?>

                     <!--ALERT TAREAS-->
                    
                    <?php $tareas = $this->doctrine->em->getRepository("Entities\\Tareas")->getTareasByState($this->session->userdata('usuarioid'),0) ?>

                     <?php if(count($tareas) > 0): ?>

                        <li onclick="window.location='<?= site_url('tareas')?>'" class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-thumb-tack"></i>
                                <span class="badge badge-danger"> <?= count($tareas) ?> </span>
                            </a>
                            
                        </li>

                    <?php endif ?>

                    <li class="dropdown dropdown-user dropdown-dark">

                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> <?= $this->session->userdata['nombre'] ?> </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            <img alt="" class="img-circle" src="<?= base_url('assets/pages/media/users/'.$this->session->userdata['image']) ?>">
                        </a>

                    </li>

                    <li onclick="window.location='<?= site_url('login/logout')?>'" class="dropdown dropdown-extended quick-sidebar-toggler">

                            <span class="sr-only">Toggle Quick Sidebar</span>
                            <i class="icon-logout"></i>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>