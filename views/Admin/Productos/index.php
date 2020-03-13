<h6 class="text-muted text-normal text-uppercase">Catalogo Productos</h6>
<hr class="margin-bottom-1x">
<div id="ListCatalogoProductos">
  <?php include 'List.php'; ?>
</div>

 <!-- center Modal-->
<div class="modal" id="modal-producto" tabindex="-1" role="dialog" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Producto</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body" >
				<div id="alert-producto"></div>
				<div id="modal-body-producto"></div>
			</div>
		</div>
	</div>
</div>