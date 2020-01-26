<?php if ($this->uri->segment(3) == 'edit'): ?>

	<script src="<?= base_url('assets/global/scripts/datatable.js') ?>" type="text/javascript"></script>
	<script src="<?= base_url('assets/global/plugins/datatables/datatables.min.js') ?>" type="text/javascript"></script>
	<script src="<?= base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') ?>" type="text/javascript"></script>
	<script src="<?= base_url('assets/pages/scripts/table-datatables-managed.min.js') ?>" type="text/javascript"></script>

	<script src="<?= base_url('assets/global/plugins/ckeditor/ckeditor.js') ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {CKEDITOR.replace("body");});
	</script>
	<script src="<?= base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') ?>" type="text/javascript"></script>

	<script>
	window.onload = function () {
	     var tree = document.getElementById("menu_arbol");
	     var lists = [ menu_arbol ];
	     for (var i = 0; i < tree.getElementsByTagName("ul").length; i++)
	          lists[lists.length] = tree.getElementsByTagName("ul")[i];
	     for (var i = 0; i < lists.length; i++) {
	          var item = lists[i].lastChild;
	          while (!item.tagName || item.tagName.toLowerCase() != "li")
	          item = item.previousSibling;
	          item.className += " cierre";
	     }
	};
	</script>

	<script>
	$('#attr_0').DataTable();
	$('#attr_1').DataTable();
	</script>

<?php endif ?>