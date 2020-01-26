<?= validation_errors(); ?>

<?php if(isset($errorUsuario)): ?>

    <?= $errorUsuario ?>

<?php endif ?>

<div class="page-body">

    <img class="page-lock-img" src="<?= base_url('assets/pages/media/profile/avatar.png') ?>" alt="avatar">

    <div class="page-lock-info">

        <h1>Introduce tu email</h1>

        <span class="email"></span>

        <span class="locked"> </span>

        <form class="form-inline" method="post">

            <div class="input-group input-medium">

                <input value="<?= set_value('email'); ?>" name="email" class="form-control" placeholder="Email" type="text">

                <span class="input-group-btn">

                    <button name="submit-login" type="submit" class="btn green icn-only">

                        <i class="m-icon-swapright m-icon-white"></i>

                    </button>

                </span>

            </div>

        </form>

    </div>

</div>