<div class="col-md-3">

	<div class="portlet light bordered">

		<div class="portlet-title">

			<div class="caption font-dark">

                <i class="fa fa-file font-dark"></i>

                <span class="caption-subject bold uppercase"> ARCHIVOS</span>

            </div>

            <div class="actions">

            	<a id="open-file" cmd="attachments<?= $id ?>"  href="#" data-toggle="modal" class="btn btn-circle btn-icon-only btn-default open-file">

                    <i class="fa fa-plus"></i>

                </a>

                <form enctype="multipart/form-data" name="form-attachments<?= $id ?>" action="<?= site_url(strtolower ($page.'/upload_attachment/'.$id)) ?>" method="post">

                	<input id="attachments<?= $id ?>" multiple="multiple" cmd="attachments<?= $id ?>" name="attachments<?= $id ?>[]" style="display:none" type="file">

                </form>


            </div>

		</div>

		<div class="portlet-body todo-project-list-content" style="height: auto;">

            <div class="table-scrollable">

            	<table class="table table-bordered table-hover">

            		<thead>

            			<tr>
							<th> Nombre </th>
							<th></th>
							<th></th>
						</tr>

            		</thead>

            		<tbody>

            			<?php if ($attachments): ?>

							<?php foreach ($attachments as $key => $value): ?>

								<tr>

		            				<td> <?= $value->attached ?> </td>

		            				<td align="center">

		            					<a href="#attachments_modal_<?= $value->id ?>" data-toggle="modal" class="btn btn-circle btn-icon-only btn-default">

						                    <i class="fa fa-eye"></i>

						                </a>

		            				</td>

									<?php $data_modal['id_attached'] = $value->id ?>
									<?php $data_modal['attached'] = $value->attached ?>
									<?php $this->load->view('include/modal/attachments_modal',$data_modal) ?>

		            				<td align="center">

		            					<a href="<?= site_url($param.'/delete_attachment/'.$id.'/'.$value->id) ?>" class="btn btn-circle btn-icon-only btn-default">

						                    <i class="fa fa-trash"></i>

						                </a>

		            				</td>

		            			</tr>

							<?php endforeach ?>

						<?php endif ?>

            		</tbody>

            	</table>

            </div>

        </div>

	</div>

</div>
