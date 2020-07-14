 <?php 
  @session_start();
  if (!class_exists('DetalleController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Detalle.Controller.php';
  }if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Pedido.Controller.php';
  }
  $DetalleController = new DetalleController();
  $ResultDetalleController = $DetalleController->getDetallePedido();
  
  $pedidoSubtotal = 0;
  if(isset($_SESSION['Ecommerce-PedidoKey'])){ 
    $PedidoController = new PedidoController();
    $Pedido = $PedidoController->GetBy();
    $pedidoSubtotal = $Pedido->SubTotal;
  }
?>

<a href="../Carrito/"></a><i class="icon-bag"></i><span class="count"><?php echo $ResultDetalleController->count; ?></span><span class="subtotal">$<?php echo $pedidoSubtotal; ?></span>

  <div class="toolbar-dropdown">
    <?php if($ResultDetalleController->count > 0){  ?>
      <?php foreach ($ResultDetalleController->records as $key => $row): ?>
      <div class="dropdown-product-item"><span class="dropdown-product-remove"><i class="icon-cross"></i></span><a class="dropdown-product-thumb" href="../Productos/index.php?codigo=<?php echo $row->ProductoCodigo ?>"><img src="../../public/img/Productos/<?php echo $row->ProductoImg ?>.jpg" alt="Product"></a>
        <div class="dropdown-product-info"><a class="dropdown-product-title" href="../Productos/index.php?codigo=<?php echo $row->ProductoCodigo ?>"><?php echo $row->ProductoDescripcion ?></a><span class="dropdown-product-details"><?php echo $row->DetalleCantidad; ?> x $<?php echo $row->ProductoPrecio; ?></span></div>
      </div>
      <?php endforeach ?>
    <?php } ?>

    <div class="toolbar-dropdown-group">
      <div class="column"><span class="text-lg">Subtotal:</span></div>
      <div class="column text-right"><span class="text-lg text-medium">$<?php echo $pedidoSubtotal; ?>&nbsp;</span></div>
    </div>
    <div class="toolbar-dropdown-group">
      <div class="column"><a class="btn btn-sm btn-block btn-secondary" href="../Carrito/">Ver carrito</a></div>
      <?php if($ResultDetalleController->count > 0){  ?>
      <div class="column"><a class="btn btn-sm btn-block btn-success" href="../Checkout/">Finalizar</a></div>
      <?php } ?>
    </div>
  </div>
<?php 
  unset($DetalleController);
  unset($ResultDetalleController);
  unset($obj);
?>

