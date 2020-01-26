<div aria-hidden="true" role="basic" tabindex="-1" id="imagesSliderModal<?= $id_attribute_value ?>" class="modal fade" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

								<a style="float:right" cmd="attachments_attr<?= $id_attribute_value ?>" class="btn btn-circle btn-icon-only btn-default open-file" href="#" id="open-file"><i class="fa fa-plus"></i></a>

								<form enctype="multipart/form-data" name="form-attachments_attr<?= $id_attribute_value ?>" action="<?= site_url(strtolower ($lang.'/'.$page.'/upload_attachment/'.$id.'/'.$id_attribute.'/'.$id_attribute_value)) ?>" method="post">

                	<input cmd="attachments_attr<?= $id_attribute_value ?>" name="attachments_attr<?= $id_attribute_value ?>" style="display:none" type="file">

                </form>

                <h4 style="float:left" class="modal-title">Slider</h4>

            </div>

            <div class="modal-body">

							<?php if($attachments_attr): ?>

								<div class="table-scrollable">

	                <table class="table table-bordered table-hover">

	                    <thead>
	                        <tr>
	                            <th> # </th>
	                            <th> Imagen </th>
	                            <th></th>
	                        </tr>
	                    </thead>

	                    <tbody>

												<?php foreach ($attachments_attr as $key => $value): ?>

	                        <tr>
	                            <td> <?= $value->id ?> </td>
	                            <td> <img width="75" whi src="<?= base_url('assets/attachments/'.$value->attached) ?>" /> </td>

															<td align="center">
                                  <a href="<?= site_url($lang.'/productos/delete_attachment/'.$id.'/'.$value->id) ?>" style="cursor:pointer;" class="btn btn-circle btn-icon-only btn-default impact-attribute" id="<?= $value->id ?>">
																			<i class="fa fa-trash"></i>
                                  </a>
                              </td>

	                        </tr>

												<?php endforeach ?>

	                    </tbody>

	                </table>

	            </div>

						<?php else: ?>

							<div class="alert alert-warning" role="alert">No tienes imágenes asociadas a este atributo.</div>

						<?php endif ?>

           	</div>

            <div class="modal-footer">

                <button data-dismiss="modal" class="btn dark btn-outline" type="button">Cerrar</button>

            </div>

        </div>

    </div>

</div>
