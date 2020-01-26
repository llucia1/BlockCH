<script src="<?= base_url('assets/global/plugins/moment.min.js" type="text/javascript') ?>"></script>
<script src="<?= base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript') ?>"></script>
<script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript') ?>"></script>
<script src="<?= base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript') ?>"></script>
<script src="<?= base_url('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/global/plugins/clockface/js/clockface.js" type="text/javascript') ?>"></script>

<script src="<?= base_url('assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript') ?>"></script>

<?php if($this->session->userdata('endJob')): ?>

<script>
    alert('Todas las llamadas programadas para hoy han finalizado.');
</script>

<?php endif ?>

<script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" type="text/javascript') ?>"></script>