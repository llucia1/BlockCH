<form role="form" method="post">

    <div class="form-body">

        <div class="form-group">

            <label>Nombre</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="name" key="<?= $id ?>" name="name" value="<?= $getRegistro->getName() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Primer apellido</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="first_name" key="<?= $id ?>" name="first_name" value="<?= $getRegistro->getFirstName() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Segundo apellido</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="last_name" key="<?= $id ?>" name="last_name" value="<?= $getRegistro->getLastName() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Sexo</label>

            <div class="input-group col-md-12">

                <select class="form-control">

                    <option></option>
                    <option value="M">H</option>
                    <option value="F">M</option>

                </select>

            </div>

        </div>

        <div class="form-group">

            <label>DNI</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="document_number" key="<?= $id ?>" name="document_number" value="<?= $getRegistro->getDocumentNumber() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Fecha de nacimiento</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>

                <input table="registros" field="bird_date" key="<?= $id ?>" name="bird_date" value="<?= $getRegistro->getBirdDate() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Edad actual</label>

            <div class="input-group col-md-12">

                <input disabled name="age" class="form-control age" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Ramo</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="branch" key="<?= $id ?>" name="branch" value="<?= $getRegistro->getBranch() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Periocidad</label>

            <div class="input-group col-md-12">

               <select class="form-control">

                    <option></option>
                    <option value="yearly">Anual</option>
                    <option value="biannual">Semestral</option>

               </select>

            </div>

        </div>

        <div class="form-group">

            <label>Nueva Periocidad</label>

            <div class="input-group col-md-12">

            <select class="form-control">

                <option></option>
                <option value="yearly">Anual</option>
                <option value="biannual">Semestral</option>

            </select>

            </div>

        </div>

        <div class="form-group">

            <label>Vencimiento</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>

                <input table="registros" field="renovation" key="<?= $id ?>" name="renovation" value="<?= $getRegistro->getRenovation() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Cuenta Corriente</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="checking_account" key="<?= $id ?>" name="checking_account" value="<?= $getRegistro->getCheckingAccount() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Prima</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="prima" key="<?= $id ?>" name="prima" value="<?= $getRegistro->getPrima() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Capital</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="capital" key="<?= $id ?>" name="capital" value="<?= $getRegistro->getCapital() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Teléfono</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="telephone" key="<?= $id ?>" name="telephone" value="<?= $getRegistro->getTelephone() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Provincia</label>

            <div class="input-group col-md-12">

                <select class="form-control">

                    <option></option>
                    <?php foreach ($provincias as $key => $provincia): ?>
                        <option value="<?= $provincia->getIdProvincia() ?>"><?= $provincia->getProvincia() ?></option>
                    <?php endforeach ?>

                </select>

            </div>

        </div>

        <div class="form-group">

            <label>Población</label>

            <div class="input-group col-md-12">

                <select class="form-control">

                    <option></option>
                    <option value="yearly">Anual</option>
                    <option value="biannual">Semestral</option>

                </select>

            </div>

        </div>

        <div class="form-group">

            <label>CP</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="zip" key="<?= $id ?>" name="zip" value="<?= $getRegistro->getZip() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Tipo de vía</label>

            <div class="input-group col-md-12">

                <select class="form-control">

                    <option></option>
                    <option value="yearly">Anual</option>
                    <option value="biannual">Semestral</option>

                </select>

            </div>

        </div>

        <div class="form-group">

            <label>Dirección</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="address" key="<?= $id ?>" name="address" value="<?= $getRegistro->getAddress() ?>" class="form-control md-text" placeholder="Persona que consta como administrador de la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Cob. Actual</label>

            <div class="input-group col-md-12">

                <select class="form-control">

                    <option></option>
                    <option value="yearly">F</option>
                    <option value="biannual">F+I+D</option>

                </select>

            </div>

        </div>

    </div>

</form>

<hr/>

<form action="<?= site_url('registros/setDataSecondaryForm/'.$id) ?>" role="form" method="post">

    <div class="row">

        <div class="form-body">

            <?= $secondForm ?>

            <div class="form-group col-md-12">

                <button name="submit" class="btn green" type="submit">Guardar</button>

            </div>

        </div>

    </div>

</form>