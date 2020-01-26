<ul class="page-breadcrumb breadcrumb">

    <li>

        <a href="<?= site_url('/') ?>"><i class="icon-home"></i> Panel</a>

        <?php if(count($breadcrumb) > 0 ): ?>

            <?php foreach ($breadcrumb as $bc): ?>

                <i class="fa fa-circle"></i>

                <li><span class="active"> <?= $bc ?></span></li>

            <?php endforeach ?>

        <?php endif ?>

    </li>

</ul>

