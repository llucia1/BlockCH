<div aria-hidden="true" role="basic" tabindex="-1" id="categoriasModal" class="modal fade" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 style="float:left" class="modal-title">Categorías</h4><button style="float:right" onclick="window.location.reload()" class="btn btn-success" type="button"><i class="fa fa-refresh" aria-hidden="true"></i> Actualizar</button>

            </div>

            <div class="modal-body">

              <ul id="menu_arbol">

                <?php $id_product = $id ?>
							  <?php require_once('./assets/categories/categories_private.php') ?>

              </ul>

           	</div>

            <div class="modal-footer">

                <button onclick="window.location.reload()" class="btn btn-success" type="button"><i class="fa fa-refresh" aria-hidden="true"></i> Actualizar</button>
            </div>

        </div>

    </div>

</div>
