<div class="tab-pane fade" id="Reportes">
    
    <div class="row">

	    
		<div class="portlet light">

		    <?= validation_errors(); ?>

		    <div class="portlet-title">

		        <h3>Reportes</h3>

		    </div>

		    <form action="<?= site_url('clientes/set_reporte/'.$id) ?>" role="form" method="post">

			    <div class="portlet-body flip-scroll">

			        <div class="row">

			            <div class="col-md-12">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label><span style="color:red">*</span>Tipo de reporte</label>
			  
			                        <select name="tipo-reporte" class="form-control">
										
										<?php foreach ($getEstadosSeguimiento as $key => $estado): ?>
                
							                <option value="<?= $estado->getId() ?>"><?= $estado->getNombre()?></option>

							            <?php endforeach ?>

			                        </select>

			                    </div>

			                </div>

			            </div>
			            
			            <div class="col-md-12">

				            <div class="form-body">

			                    <div class="form-group">

			                        <label><span style="color:red">*</span>Reporte</label>

			                        <textarea name="text-reporte" class="form-control"></textarea>

			                    </div>

			                </div>

			             </div>

			             <div class="col-md-12">

				            <div class="form-group">

			                    <button name="submit-reporte" class="btn green" type="submit">Reportar</button>

			                </div>

			            </div>

			        </div>

			    </div>

		    </form>
			
			<?php if($getReports): ?>

			    <div class="portlet-title">
					<h4>Listado de reportes</h4>
				</div>

				<div class="mt-comments">

				<?php foreach ($getReports as $key => $report): ?>

					<div class="mt-comment">

						<div class="mt-comment-img">
		                	
		                	<?php if($report->getIdusuario()->getImg() != null): ?>

						        <img width="45" class="page-lock-img" src="<?= base_url('assets/pages/media/users/'.$report->getIdusuario()->getImg()) ?>" alt="avatar">

						    <?php else: ?>

						        <img width="45" class="page-lock-img" src="<?= base_url('assets/pages/media/profile/avatar.png') ?>" alt="avatar">

						    <?php endif ?>

		                </div>

		                <div class="mt-comment-body">

		                	<div class="mt-comment-info">
		                        <span class="mt-comment-author"><?= $report->getIdusuario()->getNombre() ?> <?= $report->getIdusuario()->getApellidos() ?></span>
		                        <span class="mt-comment-date"><?= $report->getFreporte()->format('d/m/Y H:i') ?></span>
		                    </div>

		                    <div class="mt-comment-text"> 
		                    	<?= $report->getComentario() ?> 
		                    </div>

		                </div>

					</div>

					<?php endforeach ?>

				</div>

			<?php endif ?>

		</div>


    </div>

</div>