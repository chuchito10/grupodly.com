 <?php 
 @session_start();
 if (isset($_SESSION['Ecommerce-PedidoKey'])) {
  if (!class_exists('DetalleController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Detalle.Controller.php';
  }
  $DetalleController = new DetalleController();
  $ResultDetalleController = $DetalleController->getDetallePedido(false);

    $obj = $ResultDetalleController->records[0];
?>
<a href="../Carrito/"></a><i class="icon-bag"></i><span class="count"><?php echo $ResultDetalleController->count; ?></span><span class="subtotal">$<?php echo $obj->PedidoSubtotal; ?></span>
<div class="toolbar-dropdown">
  <?php foreach ($ResultDetalleController->records as $key => $row): ?>
  <div class="dropdown-product-item"><span class="dropdown-product-remove"><i class="icon-cross"></i></span><a class="dropdown-product-thumb" href="../Productos/index.php?codigo=<?php echo $row->ProductoCodigo ?>"><img src="../../public/img/Productos/<?php echo $row->ProductoImg ?>.jpg" alt="Product"></a>
    <div class="dropdown-product-info"><a class="dropdown-product-title" href="../Productos/index.php?codigo=<?php echo $row->ProductoCodigo ?>"><?php echo $row->ProductoDescripcion ?></a><span class="dropdown-product-details"><?php echo $row->DetalleCantidad; ?> x $<?php echo $row->ProductoPrecio; ?></span></div>
  </div>
  <?php endforeach ?>
  <div class="toolbar-dropdown-group">
    <div class="column"><span class="text-lg">Total:</span></div>
    <div class="column text-right"><span class="text-lg text-medium">$<?php echo $obj->PedidoSubtotal; ?>&nbsp;</span></div>
  </div>
  <div class="toolbar-dropdown-group">
    <div class="column"><a class="btn btn-sm btn-block btn-secondary" href="../Carrito/">Ver carrito</a></div>
    <div class="column"><a class="btn btn-sm btn-block btn-success" href="../Checkout/">Finalizar</a></div>
  </div>
</div>
<?php 
  }else{
?>
<a href="../Carrito/"></a><i class="icon-bag"></i><span class="count">0</span><span class="subtotal">0</span>
<div class="toolbar-dropdown">
  <div class="toolbar-dropdown-group">
    <div class="column"><span class="text-lg">Total:</span></div>
    <div class="column text-right"><span class="text-lg text-medium">0&nbsp;</span></div>
  </div>
  <div class="toolbar-dropdown-group">
    <div class="column"><a class="btn btn-sm btn-block btn-secondary" href="../Carrito/">Ver carrito</a></div>
  </div>
</div>
<?php } 

  unset($DetalleController);
  unset($ResultDetalleController);
  unset($obj);
?>