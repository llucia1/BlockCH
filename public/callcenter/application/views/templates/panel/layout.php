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

	<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo" <?php if(isset($reference)): ?>id="<?= $reference ?>"<?php endif ?>>

        <?php $this->load->view('templates/'.basename(dirname(__FILE__)).'/include/header') ?>

        <div class="clearfix"> </div>

        <div class="page-container">

            <div class="page-sidebar-wrapper">

                <div class="page-sidebar navbar-collapse collapse">

                    <?php $this->load->view('templates/'.basename(dirname(__FILE__)).'/include/nav') ?>

                </div>

            </div>

            <div class="page-content-wrapper">

                <?php $this->load->view($view) ?>

                <?php $this->load->view('modals/main_modal') ?>

            </div>

        </div>

        <?php $this->load->view('templates/'.basename(dirname(__FILE__)).'/include/footer') ?>

        <?php $this->load->view('templates/'.basename(dirname(__FILE__)).'/js/js') ?>

	</body>

</html>