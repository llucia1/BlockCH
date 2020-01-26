
<div class="portlet light bordered">

    <div class="portlet-title">

        <h3>Información Detallada</h3>

    </div>

    <div class="portlet-body flip-scroll">

        <div class="row">
            

            <div class="form-body">

                <div class="form-group col-md-4">

                    <label>Operador</label>

                    <div class="input-group col-md-12">

                       <select name="operador" class="form-control">
                            
                            <option value="0">Selecciona un operador</option>

                            <?php foreach ($getOpearadores as $key => $operador): ?>
                                
                                <option value="<?= $operador->getId() ?>"><?= $operador->getValor() ?></option>

                            <?php endforeach ?>

                        
                       </select>

                    </div>

                </div>

                <div class="form-group col-md-4">

                    <label>Nº líneas móvil</label>

                    <div class="input-group col-md-12">

                       <select name="lineasMovil" class="form-control">
                            
                            <?php for ($i=0; $i <= 100 ; $i++): ?>

                                <option value="<?= $i ?>"><?= $i ?></option>

                            <?php endfor?>
                               
                            <option value="+100">+100</option>
                        
                       </select>

                    </div>

                </div>

                <div class="form-group col-md-4">

                    <label>Nº líneas Fijo</label>

                    <div class="input-group col-md-12">

                       <select name="lineasFijo" class="form-control">
                            
                            <?php for ($i=0; $i <= 100 ; $i++): ?>

                                <option value="<?= $i ?>"><?= $i ?></option>

                            <?php endfor?>
                               
                            <option value="+100">+100</option>
                        
                       </select>

                    </div>

                </div>

                <div class="form-group col-md-6">

                    <label>Centralita</label>

                    <div class="input-group col-md-12">

                       <select name="centralita" class="form-control">
                            
                            <option value=""></option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        
                       </select>

                    </div>

                </div>

                <div class="form-group col-md-6">

                    <label>Nº Centralitas</label>

                    <div class="input-group col-md-12">

                       <select name="centralitas" class="form-control">
                            
                            <?php for ($i=0; $i <= 100 ; $i++): ?>

                                <option value="<?= $i ?>"><?= $i ?></option>

                            <?php endfor?>
                               
                            <option value="+100">+100</option>
                        
                       </select>

                    </div>

                </div>

                <div class="form-group col-md-6">

                    <label>Permanencia</label>

                    <div class="input-group col-md-12">

                       <select name="permanencia" class="form-control">
                            
                            <option value=""></option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        
                       </select>

                    </div>

                </div>

                <div class="form-group col-md-6">

                    <label>Tiempo permanencia en meses</label>

                    <div class="input-group col-md-12">

                        <input name="tPermanencia" value="" class="form-control" type="text">

                    </div>

                </div>

            </div>
        

        </div>

    </div>

</div>