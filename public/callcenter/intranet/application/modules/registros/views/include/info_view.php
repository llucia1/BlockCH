<div class="row">

    <form role="form" method="post">
        
        <div class="form-body">

            <div class="form-group col-md-6">

                <label>Operador</label>

                <div class="input-group col-md-12">

                   <select table="registros" field="idOperador" key="<?= $id ?>" name="operador" class="form-control md-select">
                        
                        <option value="0">Selecciona un operador</option>

                        <?php foreach ($getOpearadores as $key => $operador): ?>
                            
                            <option <?php if($getRegistro->getIdoperador()->getId() == $operador->getId()) echo 'selected' ?> value="<?= $operador->getId() ?>"><?= $operador->getValor() ?></option>

                        <?php endforeach ?>

                    
                   </select>

                </div>

            </div>

            <div class="form-group col-md-6">
                
                <label>Líneas Móviles</label>

                <div class="input-group col-md-12">

                    <input table="registros" field="lineasMovil" key="<?= $id ?>" name="lineasMovil" value="<?= $getRegistro->getLineasmovil() ?>" class="form-control md-text" type="text">

                </div>

            </div>

            <div class="form-group col-md-6">
                
                <label>Líneas Datos</label>

                <div class="input-group col-md-12">

                    <input table="registros" field="lineasDatos" key="<?= $id ?>" name="lineasDatos" value="<?= $getRegistro->getLineasdatos() ?>" class="form-control md-text" type="text">

                </div>

            </div>

            <div class="form-group col-md-6">
                
                <label>ADSL</label>

                <div class="input-group col-md-12">

                    <input table="registros" field="adsl" key="<?= $id ?>" name="adsl" value="<?= $getRegistro->getAdsl() ?>" class="form-control md-text" type="text">

                </div>

            </div>

            <div class="form-group col-md-6">
                
                <label>Conecta PYMES</label>

                <div class="input-group col-md-12">

                    <input table="registros" field="conectaPymes" key="<?= $id ?>" name="conectaPymes" value="<?= $getRegistro->getConectapymes() ?>" class="form-control md-text" type="text">

                </div>

            </div>

            <div class="form-group col-md-6">
                
                <label>Tipo CPYME</label>

                <div class="input-group col-md-12">

                    <input table="registros" field="tipoCpyme" key="<?= $id ?>" name="tipoCpyme" value="<?= $getRegistro->getTipocpyme() ?>" class="form-control md-text" type="text">

                </div>

            </div>

            <div class="form-group col-md-6">

                <label>Centralita</label>

                <div class="input-group col-md-12">

                   <select table="registros" field="centralita" key="<?= $id ?>" name="centralita" class="form-control md-select">
                        
                        <option value=""></option>
                        <option <?php if($getRegistro->getCentralita() == 1) echo 'selected' ?> value="1">Si</option>
                        <option <?php if($getRegistro->getCentralita() == 0) echo 'selected' ?> value="0">No</option>
                    
                   </select>

                </div>

            </div>

            <div class="form-group col-md-6">
                
                <label>Nº Extensiones</label>

                <div class="input-group col-md-12">

                    <input table="registros" field="centralitas" key="<?= $id ?>" name="centralitas" value="<?= $getRegistro->getCentralitas() ?>" class="form-control md-text" type="text">

                </div>

            </div>

            <div class="form-group col-md-6">

                <label>Permanencia</label>

                <div class="input-group col-md-12">

                   <select table="registros" field="permanencia" key="<?= $id ?>" name="permanencia" class="form-control md-select">
                        
                        <option value=""></option>
                        <option <?php if($getRegistro->getPermanencia() == 1) echo 'selected' ?> value="1">Si</option>
                        <option <?php if($getRegistro->getPermanencia() == 0) echo 'selected' ?> value="0">No</option>
                    
                   </select>

                </div>

            </div>

            <div class="form-group col-md-6">

                <label>Tiempo permanencia en meses</label>

                <div class="input-group col-md-12">

                    <input table="registros" field="tPermanencia" key="<?= $id ?>" name="tPermanencia" value="<?= $getRegistro->getTpermanencia() ?>" class="form-control md-text" type="text">

                </div>

            </div>

        </div>

    </form>

</div>