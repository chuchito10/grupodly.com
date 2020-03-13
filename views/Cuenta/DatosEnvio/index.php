<div id="List-DatosEnvio">
	<?php include $_SERVER['DOCUMENT_ROOT'].'/views/Cuenta/DatosEnvio/List.php'; ?>
</div>

 <!-- center Modal-->
<div class="modal" id="modal-datos-envio" tabindex="-1" role="dialog" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Datos de envio</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body" >
				<div id="alert-datos-envio"></div>
				<div id="modal-body-datos-envio"></div>
			</div>
		</div>
	</div>
</div>