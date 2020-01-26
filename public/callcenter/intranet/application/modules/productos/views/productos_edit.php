<div class="page-content">

	<div class="page-head">

		<?= $this->load->view('include/page_head') ?>

	</div>

	<?= $this->load->view('include/page_breadcrumb') ?>

	<div class="row">

		<div class="col-md-9">

			<div class="portlet light bordered">

				<div class="portlet-title">

					<?php $this->load->view('include/actions_edit') ?>

				</div>

				<div class="portlet-body form">

					<form enctype="multipart/form-data" role="form" action="" method="post">

						<div class="form-body">

							<?php $this->load->view('include/form') ?>

						</div>

						<div class="form-actions">

					<div class="row">

						<div class="col-md-12">

							<button name="submit_form" class="btn dark" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

						</div>

					</div>

				</div>

					</form>

				</div>

			</div>

		</div>

		<?php $this->load->view('include/options') ?>

		<?php $this->load->view('include/attachments') ?>

	</div>

</div>
