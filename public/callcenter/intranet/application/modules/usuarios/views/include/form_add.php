<form enctype="multipart/form-data" role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Color</label>

            <div class="input-group col-md-12">

                <input name="color" type="hidden" id="hidden-input" class="form-control demo" value="#C1C1C3"> 

            </div>

            <div class="clearfix margin-top-10">

                <span class="label label-danger">NOTA!</span> Es importante asignar un color único ya que este sirve para identificar al usuario en secciones como el calendario.

            </div>

        </div>

        <div class="form-group">

            <label>Nombre</label>

            <div class="input-group">

                <span class="input-group-addon">

                    <i class="fa fa-pencil"></i>

                </span>

                <input name="nombre" value="<?= set_value('nombre'); ?>" class="form-control" placeholder="Nombre del usuario" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Apellidos</label>

            <div class="input-group">

                <span class="input-group-addon">

                    <i class="fa fa-pencil"></i>

                </span>

                <input name="apellidos" value="<?= set_value('apellidos'); ?>" class="form-control" placeholder="Apelldos del usuario" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Fecha de nacimiento</label>

            <div class="input-group">

                <span class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                </span>

                <input id="mask_date" name="fnacimiento" value="<?= set_value('fnacimiento'); ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Rol</label>

            <select name="rol" class="form-control">

                <option value="">Selecciona un Rol</option>

                <?php foreach($roles as $rol): ?>

                    <option value="<?= $rol->getId() ?>"><?= $rol->getRol() ?></option>

                <?php endforeach ?>

            </select>

        </div>

        <div class="form-group">

            <label>Imagen</label>

            <div class="input-group">

                <input name="image" id="exampleInputFile" type="file">

            </div>

            <div class="clearfix margin-top-10">

                <span class="label label-danger">NOTA!</span> El formato de la imagen jpg/gif/png. Tamaño 200px × 200px píxeles y un peso máximo de 200KB.

            </div>

        </div>

        <div class="form-group">

            <label>Email</label>

            <div class="input-group">

                <span class="input-group-addon">

                    <i class="fa fa-envelope"></i>

                </span>

                <input name="email" value="<?= set_value('email'); ?>" class="form-control" placeholder="nombre@dominio.com" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Contraseña</label>

            <div class="input-group">

                <span class="input-group-addon">

                    <i class="fa fa-lock"></i>

                </span>

                <input name="pass" value="" class="form-control pass" type="text">

            </div>

        </div>

        <div class="form-group">

            <button class="btn btn-circle red btn-sm get-pass" type="button">Generar contraseña segura</button>

        </div>


        <div class="form-group">

            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>