<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet profile-content light bordered">

                <?= $this->load->view('include/portlet_title') ?>

                <div class="portlet-body flip-scroll">
                    
                    <form>

                        <div class="form-group">

                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-week-start="1" data-date-language="es">

                                <input name="fRegistro" value="<?= $getRegistro->getFregistro()->format('d-m-Y') ?>" type="text" class="form-control" readonly>

                                <span class="input-group-btn">

                                    <button class="btn default" type="button">

                                        <i class="fa fa-calendar"></i>

                                    </button>

                                </span>

                            </div>

                        </div>

                        <div class="form-group">

                            <label>Operario</label>

                            <select table="registros" field="idUsuario" key="<?= $id ?>" name="usuario" class="form-control md-select">

                                <?php foreach($getUsuarios as $usuario): ?>

                                    <option <?php if($getRegistro->getIdusuario()->getId() == $usuario->getId()) echo 'selected' ?> value="<?= $usuario->getId() ?>"><?= $usuario->getNombre() ?> <?= $usuario->getApellidos() ?></option>

                                <?php endforeach ?>

                            </select>

                        </div>

                        <?= $this->load->view('include/form_edit') ?>

                </div>

            </div>

        </div>

        <?php if($getRegistroLlamadas): ?>

            <div class="col-md-12">

                <div class="portlet light bordered">

                    <div class="portlet-body flip-scroll">

                        <?= $this->load->view('include/record_call') ?>

                    </div>

                </div>

            </div>

        <?php endif ?>

    </div>

</div>