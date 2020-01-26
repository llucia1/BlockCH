<div class="portlet-title">

    <?php if($this->uri->segment(2) != 'add'): ?>
        <a href="<?= site_url($path.'/add') ?>" class="btn green" type="button"><i class=" icon-plus "></i> Crear</a>
    <?php endif ?>

</div>
