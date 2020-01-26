<!DOCTYPE html>

<html lang="<?= $lang;?>">
	<head>

		<?php

			$meta = array(
		        array('name' => 'robots', 'content' => $robots),
		        array('name' => 'title', 'content' => $title),
		        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
		    );

		?>

		<?=  meta($meta); ?>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

		<title><?= $title; ?></title>

		<?php $this->load->view('templates/'.basename(dirname(__FILE__)).'/css/css') ?>

	</head>

	<body <?php if(isset($reference)): ?>id="<?= $reference ?>"<?php endif ?>>

        <div class="page-lock">

            <div class="page-logo">

                <a class="brand" href="#">
                <!--<img style="margin-left: 15%;width: 362px;" width="170" src="<?= base_url('assets/pages/img/'.$project->getLogolog()) ?>" alt="logo">-->
                 <img style="margin-left: 26%;width: 261px;" width="170" src="<?= base_url('assets/apps/img/cabecera_web_eicbi-01.png') ?>" alt="logo">
                 </a>

            </div>

            <?php $this->load->view($view) ?>

            <div class="page-footer-custom"> <?php date('Y') ?> © <?= $project->getNombre() ?>. Desarrollado por DUGAGE. </div>

        </div>

        <?php $this->load->view('templates/'.basename(dirname(__FILE__)).'/js/js') ?>

	</body>

</html>
