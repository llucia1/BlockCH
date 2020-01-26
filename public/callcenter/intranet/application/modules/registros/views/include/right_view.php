<form role="form" method="post">

    <div style="text-align: center" class="mt-step-title uppercase font-grey-cascade time-call"><h2><span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span></h2></div>

    <div class="form-body">

        <div class="form-group">

            <label>Estado</label>

            <input class="form-control" disabled="" name="estado" value="<?= $getRegistro->getIdestado()->getNombre() ?>" type="text">

        </div>

    </div>

</form>