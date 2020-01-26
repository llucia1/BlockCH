<form method="post" class="form-inline" role="form">

    <div class="form-body">

        <div style="margin-right: 10px;" class="form-group">

            <label>Nombre</label>

            <div class="input-group">

                <input name="name" value="" class="form-control" placeholder="Nombre del campo" type="text">

            </div>

        </div>

        <div style="margin-right: 10px;" class="form-group">

            <label>Tipo de campo</label>

            <select name="type" class="form-control">

                <option value="header">Cabecera</option>
                <option value="text">Texto</option>
                <option value="textarea">Área de texto</option>
                <option value="boolean">Decisión Si/No</option>
                <option value="select">Selector</option>

            </select>

        </div>

        <div style="margin-right: 10px;" class="form-group">

            <label>Opciones</label>

            <div style="width: 448px;" class="input-group">

                <input name="select" value="" class="form-control" placeholder="Opciones para el selector separado por comas" type="text">

            </div>

        </div>

        <div class="form-group">

            <button name="submitAddField" class="btn green" type="submit"><i class=" icon-plus " ></i> Crear</button>

        </div>

    </div>

</form>