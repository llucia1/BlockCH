<div class="profile-sidebar">

    <div class="portlet light profile-sidebar-portlet bordered">

        <div class="profile-userpic">

            <?php if($getRow->getImg() == null): ?>

                <img src="<?= base_url('assets/pages/media/profile/avatar.png') ?>" class="img-responsive" alt="">

            <?php else: ?>

                <img src="<?= base_url('assets/pages/media/users/'.$getRow->getImg()) ?>" class="img-responsive" alt="<?= $getRow->getImg() ?>">

            <?php endif ?>

        </div>

        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> <?= $getRow->getNombre() ?> <?= $getRow->getApellidos() ?> </div>
            <div class="profile-usertitle-job"> <?= $getRow->getIdrol()->getRol() ?> </div>
        </div>

        <div class="profile-userbuttons">

            <?php if($getRow->getEstado() == 1): ?>

                <button data-id="<?= $getRow->getId() ?>" data-value="0"  data-entity="Usuarios" data-field="estado" type="button" class="btn btn-circle red btn-sm md-boolean">Bloqueado</button>

            <?php else: ?>

                <button data-id="<?= $getRow->getId() ?>" data-value="1" data-entity="Usuarios" data-field="estado" type="button" class="btn btn-circle green btn-sm md-boolean">Desbloqueado</button>

            <?php endif ?>



        </div>

        <div class="profile-usermenu"></div>

    </div>

</div>