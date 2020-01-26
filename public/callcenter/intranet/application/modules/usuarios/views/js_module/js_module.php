<script src="<?= base_url('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript') ?>"></script>
<script src="<?= base_url('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript') ?>"></script>
<script src="<?= base_url('assets/pages/scripts/components-color-pickers.min.js" type="text/javascript') ?>"></script>
<?php if($this->session->userdata('endJob')): ?>

<script>
    alert('Todas las llamadas programadas para hoy han finalizado.');
</script>

<?php endif ?>

<script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" type="text/javascript') ?>"></script>