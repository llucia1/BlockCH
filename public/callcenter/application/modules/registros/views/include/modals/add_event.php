<div class="form-group">

    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-week-start="1" data-date-language="es">

        <input name="fEvent" value="<?= date('d-m-Y') ?>" type="text" class="form-control" readonly>

        <span class="input-group-btn">

            <button class="btn default" type="button">

                <i class="fa fa-calendar"></i>

            </button>

        </span>

    </div>

</div>

<div class="form-group">

        <label>Hora</label>

        <div class="input-group">

            <input name="hEvent" value="<?= date("H:i:s") ?>" type="text" class="form-control timepicker timepicker-24">

            <span class="input-group-btn">

                <button class="btn default" type="button">

                    <i class="fa fa-clock-o"></i>

                </button>

            </span>

        </div>

    </div>



<div class="form-group">

    <label>Asignar evento a</label>

    <select name="usuario" class="form-control">

        <?php foreach($getComerciales as $comercial): ?>

            <option value="<?= $comercial->getId() ?>"><?= $comercial->getNombre() ?> <?= $comercial->getApellidos() ?></option>

        <?php endforeach ?>

    </select>

</div>