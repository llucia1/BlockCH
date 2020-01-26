<?= validation_errors(); ?>

<?php if(isset($errorUsuario)): ?>

    <?= $errorUsuario ?>

<?php endif ?>

<div class="page-body">

    <?php if($this->session->userdata['image'] != null): ?>

        <img class="page-lock-img" src="<?= base_url('assets/pages/media/users/'.$this->session->userdata['image']) ?>" alt="avatar">

    <?php else: ?>

        <img class="page-lock-img" src="<?= base_url('assets/pages/media/profile/avatar.png') ?>" alt="avatar">

    <?php endif ?>
    

    <div class="page-lock-info">

        <h1><?= $this->session->userdata['nombre'] ?></h1>

        <span class="email"> <?= $this->session->userdata['email'] ?> </span>

        <span class="locked"> <i class="fa fa-lock" aria-hidden="true"></i> Locked </span>

        <form class="form-inline" method="post">

            <div class="input-group input-medium">

                <input name="pass" class="form-control" placeholder="Password" type="password">

                <span class="input-group-btn">

                    <button name="submit-login" type="submit" class="btn green icn-only">

                        <i class="m-icon-swapright m-icon-white"></i>

                    </button>

                </span>

            </div>

        </form>

    </div>

</div>