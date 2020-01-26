<div class="form-group">

    <label>Nombre</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input name="name" type="text" placeholder="Nombre del producto" value="<?= $get_row['name'] ?>" class="form-control">

	</div>

</div>

<div class="form-group">

    <label>Referencia</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input name="referencia" type="text" placeholder="Título del producto" value="<?= $get_row['referencia'] ?>" class="form-control">

	</div>

</div>

<div class="form-group">

    <label>Descripción</label>

    <textarea name="description" rows="3" class="form-control"><?= $get_row['description'] ?></textarea>

</div>

<div class="form-group">

    <label>Palabras clave</label>

    <textarea name="key_m" rows="3" placeholder="Lista de palabras clave" class="form-control"><?= $get_row['key_m'] ?></textarea>

</div>

<div class="form-group">

    <label>Cuerpo</label>

    <textarea name="body" id="body" rows="3" class="form-control"><?= $get_row['body'] ?></textarea>

</div>

<div class="form-group">

    <div data-provides="fileinput" class="fileinput fileinput-new">

        <?php if($get_row['main_image'] != null): ?>

            <div style="width: 200px;" class="fileinput-new thumbnail">
                <img alt="" src="<?= base_url('assets/productos/'.$get_row['main_image']) ?>">
            </div>

        <?php endif ?>

        <div data-provides="fileinput" class="fileinput fileinput-new">

            <span class="btn green btn-file">

                <span class="fileinput-new"> Selecciona un archivo </span>

                <span class="fileinput-exists"> Cambiar </span>

                <input type="file" name="fileinput"> </span>

            <span class="fileinput-filename"> </span> &nbsp;

            <a data-dismiss="fileinput" class="close fileinput-exists" href="javascript:;"> </a>

        </div>

    </div>

    <div class="clearfix margin-top-10">

        <span class="label label-danger">NOTA!</span> El tamaño de la imágen ha de ser de 1200x600 pixel y una resolución de 72 pixel por pulgada. Es aconsejable que el peso no sea superior a 120kb.

    </div>

</div>
