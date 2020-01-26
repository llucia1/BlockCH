    <?= validation_errors(); ?>

    <div class="form-body">
        
        <div class="form-group">

            <label>Campaña</label>

            <div class="input-group col-md-12">

                <input disabled name="name" value="<?= $getRegistro->getCampaign()->getName() ?>" class="form-control md-text" type="text">

            </div>

        </div>

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

                <select table="registros" field="gender" key="<?= $id ?>" name="last_name" class="form-control md-select">

                    <option></option>
                    <option <?php if( $getRegistro->getGender() == 'Hombre') echo 'selected' ?> value="M">H</option>
                    <option <?php if( $getRegistro->getGender() == 'Mujer') echo 'selected' ?> value="F">M</option>

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

                <input table="registros" field="bird_date" key="<?= $id ?>" name="bird_date" value="<?= $getRegistro->getBirdDate()->format('d/m/Y') ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Edad actuarial</label>

            <div class="input-group col-md-12">
                
                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="modality" key="<?= $id ?>" name="age" class="form-control md-text age" value="<?= $getRegistro->getAge() ?>" type="text">

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

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="province" key="<?= $id ?>" name="province" value="<?= $getRegistro->getProvince() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Población</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="city" key="<?= $id ?>" name="city" value="<?= $getRegistro->getCity() ?>" class="form-control md-text" type="text">

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

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="way" key="<?= $id ?>" name="way" value="<?= $getRegistro->getWay() ?>" class="form-control md-text" type="text">

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

            <label>Email</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="email" key="<?= $id ?>" name="email" value="<?= $getRegistro->getEmail() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Cuenta Corriente</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="checkingAccount" key="<?= $id ?>" name="checking_account" value="<?= $this->encryption->decrypt($getRegistro->getCheckingAccount()) ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Modalidad</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="modality" key="<?= $id ?>" name="modality" value="<?= $getRegistro->getModality() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Periocidad</label>

            <div class="input-group col-md-12">

               <select table="registros" field="periodicity" key="<?= $id ?>" class="form-control md-select">

                    <option></option>
                    <option <?php if( $getRegistro->getPeriodicity() == 'Anual') echo 'selected' ?> value="Anual">Anual</option>
                    <option <?php if( $getRegistro->getPeriodicity() == 'Semestral') echo 'selected' ?> value="Semestral">Semestral</option>
                    <option <?php if( $getRegistro->getPeriodicity() == 'Trimestral') echo 'selected' ?> value="Trimestral">Trimestral</option>
                    <option <?php if( $getRegistro->getPeriodicity() == 'Único') echo 'selected' ?> value="Único">Único</option>

               </select>

            </div>

        </div>

        <div class="form-group">

            <label>Nueva Periocidad</label>

            <div class="input-group col-md-12">

            <select table="registros" field="new_periodicity" key="<?= $id ?>" class="form-control md-select">
                <option></option>
                <option <?php if( $getRegistro->getNewPeriodicity() == 'Anual') echo 'selected' ?> value="Anual">Anual</option>
                <option <?php if( $getRegistro->getNewPeriodicity() == 'Semestral') echo 'selected' ?> value="Semestral">Semestral</option>
                <option <?php if( $getRegistro->getNewPeriodicity() == 'Trimestral') echo 'selected' ?> value="Trimestral">Trimestral</option>
                <option <?php if( $getRegistro->getNewPeriodicity() == 'Único') echo 'selected' ?> value="Único">Único</option>
            </select>

            </div>

        </div>

        <div class="form-group">

            <label>Vencimiento</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>

                <input table="registros" field="renovation" key="<?= $id ?>" name="renovation" value="<?= $getRegistro->getRenovation()->format('d/m/Y') ?>" class="form-control md-text" type="text">

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

            <label>Cob. Actual</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="actual_cob" key="<?= $id ?>" name="actual_cob" value="<?= $getRegistro->getActualCob() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Prima OPC1</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="prima_opc1" key="<?= $id ?>" name="prima_opc1" value="<?= $getRegistro->getPrimaOpc1() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Cob. OPC1</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="cob_opc1" key="<?= $id ?>" name="cob_opc1" value="<?= $getRegistro->getCobOpc1 () ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Ahorro. € OPC1</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="ahorroeu_opc1" key="<?= $id ?>" name="ahorroeu_opc1" value="<?= $getRegistro->getAhorroeuOpc1() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Ahorro % OPC1</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="ahorropercent_opc1" key="<?= $id ?>" name="ahorropercent_opc1" value="<?= $getRegistro->getAhorropercentOpc1() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Prima OPC2</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="Prima_opc2" key="<?= $id ?>" name="Prima_opc2" value="<?= $getRegistro->getPrimaOpc2() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Ahorro. € OPC2</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="ahorroeu_opc2" key="<?= $id ?>" name="ahorroeu_opc2" value="<?= $getRegistro->getAhorroeuOpc2() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Ahorro % OPC2</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="ahorropercent_opc2" key="<?= $id ?>" name="ahorropercent_opc2" value="<?= $getRegistro->getAhorropercentOpc2() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Nº Prestamo</label>

            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="ahorropercent_opc2" key="<?= $id ?>" name="lending_number " value="<?= $getRegistro->getLendingNumber() ?>" class="form-control md-text" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Selección Médica</label>
            
            <div class="input-group col-md-12">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input table="registros" field="selec_ries" key="<?= $id ?>" name="selec_ries " value="<?= $getRegistro->getSelecRies() ?>" class="form-control md-text" type="text">

            </div>

        </div>
        

    </div>

</form>

<?php if( $rol == 4): ?>
    
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

<?php endif ?>