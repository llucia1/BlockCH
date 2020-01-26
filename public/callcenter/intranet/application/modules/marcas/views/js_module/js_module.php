<script src="<?= base_url('assets/assets_private/global/scripts/datatable.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/assets_private/global/plugins/datatables/datatables.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/assets_private/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/assets_private/pages/scripts/table-datatables-managed.min.js') ?>" type="text/javascript"></script>

<?php if ($this->uri->segment(2) == 'edit'): ?>

	<script src="<?= base_url('assets/assets_private/global/plugins/ckeditor/ckeditor.js') ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {CKEDITOR.replace("body");});
	</script>
	
<?php endif ?>
<script src="<?= base_url('assets/assets_private/actions/pages_actions.js') ?>" type="text/javascript"></script>