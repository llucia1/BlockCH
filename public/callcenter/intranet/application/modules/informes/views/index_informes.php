<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="m-heading-1 border-green m-bordered">

        <h3>Cómo funciona informes</h3>
        <p> Para crear un informe, selecciona un rango de fechas en el selector de calendario, selecciona el tipo de informe que deseas generar y el perfil del usuario, luego selecciona el usuario al que quieres que afecte. Puedes seleccionar todos para obtener un informe de todos los usuarios.</p>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet light bordered">

                <div style="float: right;" class="form-group">
                                                
                    <div class="col-md-4">

                        <div class="input-group input-large date-picker input-daterange" data-date="<?= date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">

                            <input value="<?= date('d-m-Y') ?>" id="from-report" type="text" class="form-control" name="from">

                            <span class="input-group-addon"> a </span>

                            <input value="<?= date('d-m-Y') ?>" id="to-report" type="text" class="form-control" name="to"> </div>
                        
                    </div>

                </div>

                <div class="portlet-body flip-scroll">
                       
                    <div class="row">

                        <div class="select-content col-md-12">
                            
                            <div class="col-md-3">

                                <div class="form-body">

                                    <div class="form-group">

                                        <label>Tipo de informe</label>

                                        <select id="tipoinforme" name="tipoinforme" class="form-control">
                                    
                                            <option value=""></option>
                                            <option value="TODOS LOS ESTADOS">TODOS LOS ESTADOS</option>
                                            <?php foreach ($getEstadosRegistros as $key => $value): ?>
                                                
                                                <option value="<?= $value->getNombre() ?>"><?= $value->getNombre() ?></option>

                                            <?php endforeach ?>
                                            
                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-body">

                                    <div class="form-group">

                                        <label>Perfil</label>

                                        <select id="rolReport" name="rolReport" class="form-control">
                                            
                                            <option value=""></option>

                                            <?php foreach ($getRoles as $key => $rol): ?>

                                                <option value="<?= $rol->getId() ?>"><?= $rol->getRol() ?></option>
                                            
                                            <?php endforeach ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-body">

                                   <div class="form-group">

                                        <label>Usuario</label>

                                        <select id="userReport" name="userReport" class="form-control">


                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="form-group">

                                    <button id="gen-info-per" style="margin-top: 23px;" name="submit" class="btn green" type="button">Generar</button>

                                </div>

                            </div>

                        </div>

                        <div id="report-table" class="col-md-12">
                            
                            

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
