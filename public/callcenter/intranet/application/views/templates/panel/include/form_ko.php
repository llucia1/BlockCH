<h4>KO</h4>

    <div class="mt-radio-list">

        <label class="mt-radio mt-radio-outline">
            <input data-key="<?= $id ?>" class="gestion-ko" name="gestion-ko" value="No interesa" type="radio"> No interesa
            <span></span>
        </label>

        <label class="mt-radio mt-radio-outline">
            <input data-key="<?= $id ?>" class="gestion-ko" name="gestion-ko"  value="Cobertura" type="radio"> Cobertura
            <span></span>
        </label>

        <label class="mt-radio mt-radio-outline">
            <input data-key="<?= $id ?>" class="gestion-ko" name="gestion-ko"  value="Oferta" type="radio"> Oferta
            <span></span>
        </label>

        <label class="mt-radio mt-radio-outline">
            <input data-key="<?= $id ?>" class="gestion-ko" name="gestion-ko"  value="Deuda" type="radio"> Deuda

            <span></span>

        </label>

        <label class="mt-radio mt-radio-outline">
            <input data-key="<?= $id ?>" class="gestion-ko" name="gestion-ko"  value="Permanencia" type="radio"> Permanencia
            <span></span>
        </label>

        <label class="mt-radio mt-radio-outline">
            <input data-key="<?= $id ?>" class="gestion-ko" name="gestion-ko"  value="Penalización" type="radio"> Penalización
            <span></span>
        </label>

        <label class="mt-radio mt-radio-outline">
            <input data-key="<?= $id ?>" class="gestion-ko" name="gestion-ko"  value="Final" type="radio"> Final
            <span></span>
        </label>
        
        <div style="display: none;" class="months-ko" >

            <h5>Selecciona meses <span class="title-ko"></span></h5>

            <select data-key="<?= $id ?>" class="form-control select-months-ko">

                <option value="0"></option>
                
                <?php for ($i=1; $i <= 12 ; $i++): ?>
                    
                    <option value="<?= $i*30 ?>"><?= $i ?></option>

                <?php endfor ?>

            </select>

        </div>

        <div style="display: none; margin-top: 10px;" class="form-group btn-go-ko">
            <button class="btn green go-ko" name="go-ko" type="button">Pasar ko</button>
        </div>

    </div>