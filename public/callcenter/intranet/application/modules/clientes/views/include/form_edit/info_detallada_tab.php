<div class="tab-pane fade" id="infoDetallada">
    
    <div class="row">

        <div class="portlet light">

          
            <div class="portlet-title">

                <h3>Información Detallada</h3>

            </div>

            <div class="portlet-body flip-scroll">

                <div class="row">

                    <div class="form-body">

                        <div class="form-group col-md-6">

                            <label>Operador</label>

                            <div class="input-group col-md-12">

                               <select table="cuentas" field="idOperador" key="<?= $id ?>" name="operador" class="form-control md-select">
                                    
                                    <option value="0">Selecciona un operador</option>

                                    <?php foreach ($getOpearadores as $key => $operador): ?>
                                        
                                        <option <?php if($getRow->getIdoperador()->getId() == $operador->getId()) echo 'selected' ?> value="<?= $operador->getId() ?>"><?= $operador->getValor() ?></option>

                                    <?php endforeach ?>

                                
                               </select>

                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            
                            <label>Líneas Móviles</label>

                            <div class="input-group col-md-12">

                                <input table="cuentas" field="lineasMovil" key="<?= $id ?>" name="lineasMovil" value="<?= $getRow->getLineasmovil() ?>" class="form-control md-text" type="text">

                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            
                            <label>Líneas Datos</label>

                            <div class="input-group col-md-12">

                                <input table="cuentas" field="lineasDatos" key="<?= $id ?>" name="lineasDatos" value="<?= $getRow->getLineasdatos() ?>" class="form-control md-text" type="text">

                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            
                            <label>ADSL</label>

                            <div class="input-group col-md-12">

                                <input table="cuentas" field="adsl" key="<?= $id ?>" name="adsl" value="<?= $getRow->getAdsl() ?>" class="form-control md-text" type="text">

                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            
                            <label>Conecta PYMES</label>

                            <div class="input-group col-md-12">

                                <input table="cuentas" field="conectaPymes" key="<?= $id ?>" name="conectaPymes" value="<?= $getRow->getConectapymes() ?>" class="form-control md-text" type="text">

                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            
                            <label>Tipo CPYME</label>

                            <div class="input-group col-md-12">

                                <input table="cuentas" field="tipoCpyme" key="<?= $id ?>" name="tipoCpyme" value="<?= $getRow->getTipocpyme() ?>" class="form-control md-text" type="text">

                            </div>

                        </div>

                        <div class="form-group col-md-6">

                            <label>Centralita</label>

                            <div class="input-group col-md-12">

                               <select table="cuentas" field="centralita" key="<?= $id ?>" name="centralita" class="form-control md-select">
                                    
                                    <option value=""></option>
                                    <option <?php if($getRow->getCentralita() == 1) echo 'selected' ?> value="1">Si</option>
                                    <option <?php if($getRow->getCentralita() == 0) echo 'selected' ?> value="0">No</option>
                                
                               </select>

                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            
                            <label>Nº Extensiones</label>

                            <div class="input-group col-md-12">

                                <input table="cuentas" field="centralitas" key="<?= $id ?>" name="centralitas" value="<?= $getRow->getCentralitas() ?>" class="form-control md-text" type="text">

                            </div>

                        </div>

                        <div class="form-group col-md-6">

                            <label>Permanencia</label>

                            <div class="input-group col-md-12">

                               <select table="cuentas" field="permanencia" key="<?= $id ?>" name="permanencia" class="form-control md-select">
                                    
                                    <option value=""></option>
                                    <option <?php if($getRow->getPermanencia() == 1) echo 'selected' ?> value="1">Si</option>
                                    <option <?php if($getRow->getPermanencia() == 0) echo 'selected' ?> value="0">No</option>
                                
                               </select>

                            </div>

                        </div>

                        <div class="form-group col-md-6">

                            <label>Tiempo permanencia en meses</label>

                            <div class="input-group col-md-12">

                                <input table="cuentas" field="tPermanencia" key="<?= $id ?>" name="tPermanencia" value="<?= $getRow->getTpermanencia() ?>" class="form-control md-text" type="text">

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <a href="<?= site_url('clientes/edit/'.$id.'#infoDetallada') ?>" class="btn green" type="button">Guardar</a>

                            </div>

                        </div>

                    </div>
                

                </div>

            </div>  
           

        </div>

    </div>

</div>