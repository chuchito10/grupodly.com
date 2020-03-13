<div id="list-ordenes">
	<?php include 'list.php'; ?>
</div>

 <!-- center Modal-->
<div class="modal" id="modal-detalle-pedido" tabindex="-1" role="dialog" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detalle Pedido</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body" >
				<div id="alert-detalle-pedido"></div>
				<div id="modal-body-detalle-pedido"></div>
			</div>
		</div>
	</div>
</div>