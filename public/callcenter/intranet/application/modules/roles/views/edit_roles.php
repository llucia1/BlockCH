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

                    <?= $this->load->view('include/form_edit') ?>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet light bordered">

                <h3>Módulos</h3>

                <form action="<?= site_url('roles/setPermissions/'.$getRow->getId()) ?>" role="form" method="post">

                    <div class="form-body">

                        <?php foreach ($getModules as $key => $value): ?>

                            <label style="width: 20%;"><input <?php if(in_array($value->getId(), $permissions)) echo 'checked' ?> name="module[]" class="checkbox-inline" type="checkbox" value="<?= $value->getId() ?>"> <?= $value->getNombre() ?></label>
      
                        <?php endforeach ?>

                        <hr/>
                        <div class="form-group">

                            <button name="submit-permissions" class="btn green" type="submit">Guardar</button>

                        </div>

                    <div>

                </form>

            </div>

        </div>

    </div>

</div>
