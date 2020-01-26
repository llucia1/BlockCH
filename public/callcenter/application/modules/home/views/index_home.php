<div class="page-content">
	
	<div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="row">

    <!-- EVENTOS PENDIENTES -->

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

            <div class="dashboard-stat2 bordered">

                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="<?= count($eventos) ?>"><?= count($eventos) ?></span>
                            <small class="font-green-sharp"></small>
                        </h3>
                        <small>EVENTOS PENDIENTES</small>
                    </div>
                    <div class="icon">
                        <i class="icon-calendar"></i>
                    </div>
                </div>

                <div class="progress-info">

                    <?php if(count($eventos) > 0): ?>
                        
                        <h3 style="color:#f36a5a" class="font-red-sharp">

                            <i class="icon-bell"></i> Tienes eventos pendientes

                        </h3>
                        
                    <?php else: ?>

                        <h3 style="color:#2ab4c0" class="font-red-sharp">

                            <i class="icon-like"></i> No tienes tareas pendientes

                        </h3>

                    <?php endif ?>

                </div>

            </div>

        </div>

        <!-- TAREAS PENDIENTES -->

    	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

            <div class="dashboard-stat2 bordered">

                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="<?= count($tareas) ?>"><?= count($tareas) ?></span>
                            <small class="font-green-sharp"></small>
                        </h3>
                        <small>TAREAS PENDIENTES</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thumb-tack"></i>
                    </div>
                </div>

                <div class="progress-info">

                    <?php if(count($tareas) > 0): ?>
						
						<h3 style="color:#f36a5a" class="font-red-sharp">

                    		<i class="icon-bell"></i> Tienes tareas pendientes

                    	</h3>
						
					<?php else: ?>

						<h3 style="color:#2ab4c0" class="font-red-sharp">

                    		<i class="icon-like"></i> No tienes tareas pendientes

                    	</h3>

                    <?php endif ?>

                </div>

            </div>

        </div>

    </div>

</div>

