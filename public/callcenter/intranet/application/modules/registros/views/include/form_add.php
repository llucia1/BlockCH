<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-week-start="1" data-date-language="es">

                <input name="fRegistro" value="<?= date('d-m-Y') ?>" type="text" class="form-control" readonly>

                <span class="input-group-btn">

                    <button class="btn default" type="button">

                        <i class="fa fa-calendar"></i>

                    </button>

                </span>

            </div>

        </div>

        <?php if ($rol != 4): ?>

            <div class="form-group">

                <label>Operario</label>

                <select name="usuario" class="form-control">

                    <?php foreach($getUsuarios as $usuario): ?>

                        <option value="<?= $usuario->getId() ?>"><?= $usuario->getNombre() ?> <?= $usuario->getApellidos() ?></option>

                    <?php endforeach ?>

                </select>

            </div>


        <?php endif ?>

        <div class="form-group">

            <label><span style="color:red">*</span>Razón social</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="empresa" value="<?= set_value('empresa'); ?>" class="form-control" placeholder="Nombre de la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Número de empleados</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="numEmpleados" value="<?= set_value('numEmpleados'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Sector</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="sector" value="<?= set_value('sector'); ?>" class="form-control" placeholder="Sector o actividad de la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label><span style="color:red">*</span>Teléfono</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </span>

                <input name="telefono" value="<?= set_value('telefono'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Administrador</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="administrador" value="<?= set_value('administrador'); ?>" class="form-control" placeholder="Persona que consta como administrador de la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Persona de contacto</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="perContacto" value="<?= set_value('perContacto'); ?>" class="form-control" placeholder="Persona con la que contactar al comunicarnos con la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>CIF</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="cif" value="<?= set_value('cif'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Dirección</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="direccion" value="<?= set_value('direccion'); ?>" class="form-control" placeholder="Dirección fiscal de la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Dirección Centro de Trabajo</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="direccionCentro" value="<?= set_value('direccionCentro'); ?>" class="form-control" placeholder="Dirección Completa del centro de trabajo" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Provincia</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="provincia" value="<?= set_value('provincia'); ?>" class="form-control" placeholder="Provincia de la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Población</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="poblacion" value="<?= set_value('poblacion'); ?>" class="form-control" placeholder="Población de la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>CP</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="cp" value="<?= set_value('cp'); ?>" class="form-control" placeholder="Código postal de la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Correo Electrónico</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </span>

                <input name="email" value="<?= set_value('email'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Web</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-globe"></i>
                </span>

                <input name="web" value="<?= set_value('web'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Convenio</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="convenio" value="<?= set_value('convenio'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>CNAE</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="cnae" value="<?= set_value('cnae'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div style="padding-left:0;" class="form-group col-md-6">

            <label>Nueva creación</label>

            <div class="input-group col-md-12">

               <select name="nueva" class="form-control md-select">
                    
                    <option selected="" value="0">No</option>
                    <option value="1">Si</option>
                
               </select>

            </div>

        </div>

        <div style="padding-right:0;" class="form-group col-md-6">

            <label>Fecha creación</label>

            <div class="input-group col-md-12">

               <input name="fCrea" value="<?= set_value('fCrea'); ?>" class="form-control" id="mask_date2" type="text">

            </div>

        </div>

        <div style="padding-left:0;" class="form-group col-md-6">

            <label>PYME</label>

            <div class="input-group col-md-12">

               <select name="pyme" class="form-control md-select">
                    
                    <option selected="" value="0">No</option>
                    <option value="1">Si</option>
                
               </select>

            </div>

        </div>

        <div style="padding-right:0;" class="form-group col-md-6">

            <label>Código Cuenta Cotización</label>

            <div class="input-group col-md-12">

               <input name="cuentaCotizacion" value="<?= set_value('cuentaCotizacion'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Comentario</label>

            <textarea class="form-control" rows="3" value="<?= set_value('comentario'); ?>" name="comentario"></textarea>

        </div>

        <div class="form-group">

            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>