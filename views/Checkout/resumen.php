<h4>Revise su orden</h4>
<hr class="padding-bottom-1x">
<?php @session_start(); if (isset($_SESSION['Ecommerce-PedidoKey'])) { ?>
<div class="table-responsive shopping-cart">
  <table class="table">
    <thead>
      <tr>
        <th>Descripción</th>
        <th class="text-center">Cantidad</th>
        <th class="text-center">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if (!class_exists('DetalleController')) {
          include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Detalle.Controller.php';
        }
        $DetalleController = new DetalleController();
        $ResultDetalleController = (object)$DetalleController->getDetallePedido(false);
        // print_r($ResultDetalleController);

        if ($ResultDetalleController->count > 0) {
          foreach ($ResultDetalleController->records as $key => $row){ 
            $Imgpath = '../../public/img/Productos/'.$row->ProductoImg.'.jpg';
            $Img = file_exists($Imgpath) ? $Imgpath : $_SESSION['Ecommerce-ImgNotFound'];
      ?>
      <tr>
        <td>
          <div class="product-item">
            <a class="product-thumb" href="../Productos/index.php?codigo=<?php echo $row->ProductoCodigo ?>">
              <img src="<?php echo $Img ?>" alt="Product">
            </a>
            <div class="product-info">
              <h4 class="product-title">
                <a href="../Productos/index.php?codigo=<?php echo $row->ProductoCodigo ?>"><?php echo $row->ProductoDescripcion; ?></a>
              <!-- </h4><span><em>Size:</em> 10.5</span><span><em>Color:</em> Dark Blue</span> -->
            </div>
          </div>
        </td>
        <td class="text-center"><?php echo $row->DetalleCantidad; ?></td>
        <td class="text-center text-lg text-medium">$<?php echo $row->DetalleSubtotal; ?></td>
      </tr>
      <?php 
          } 
        }else{
      ?>
      <td colspan="5">
        <div class="alert alert-danger alert-dismissible fade show text-center" style="margin-bottom: 30px;">
          <span class="alert-close" data-dismiss="alert"></span>&nbsp;&nbsp;¡Error al procesar la información acerca del pedido. Favor de recargar, si el problema persiste por favor contactanos!
        </div>
      </td>
      <?php 
          }?>
    </tbody>
  </table>
</div>
<div class="shopping-cart-footer">
  <?php 
    if (isset($_SESSION['Ecommerce-PedidoKey'])) {
      $obj = $ResultDetalleController->records[0];
      $obj->PedidoTotal > 0 ? $_SESSION['Ecommerce-PedidoTotal'] = $obj->PedidoTotal : 0;
  ?>
  <div class="column text-lg">
    Subtotal: <span class="text-medium">$<?php echo $obj->PedidoSubtotal; ?></span><br>
    Iva: <span class="text-medium">$<?php echo $obj->PedidoIva; ?></span><br>
    Total: <span class="text-medium">$<?php echo $obj->PedidoTotal; ?></span>
  </div>
  <?php }else{ ?>
  <div class="column text-lg">
    Subtotal: <span class="text-medium">0</span><br>
    Iva: <span class="text-medium">0</span><br>
    Total: <span class="text-medium">0</span>
  </div>
  <?php } ?>
</div>
<div class="row padding-top-1x mt-3">
  <div class="col-sm-4">
    <h5>Datos Envió:</h5>
    <ul class="list-unstyled">
      <li><span class="text-muted">Cliente:</span><?php echo $_SESSION['Ecommerce-ClienteNombre'] ?></li>
      <li><span class="text-muted">Dirección:</span> <span id="resumen-datosEnvio-direccion"></span></li>
      <li><span class="text-muted">Celular:</span> <span id="resumen-datosEnvio-celular"></span></li>
    </ul>
  </div>
  <div class="col-sm-4">
    <h5>Datos Facturación:</h5>
    <ul class="list-unstyled">
      <li><span class="text-muted">Cliente:</span><?php echo $_SESSION['Ecommerce-ClienteNombre'] ?></li>
      <li><span class="text-muted">Dirección:</span> <span id="resumen-datosFacturacion-direccion"></span></li>
      <li><span class="text-muted">RFC:</span> <span id="resumen-datosFacturacion-RFC"></span></li>
    </ul>
  </div>
  <div class="col-sm-4">
    <h5>Método de pago:</h5>
    <ul class="list-unstyled">
      <li><span class="text-muted">Tarjeta:</span><span id="resumen-numero-tarjeta"></span></li>
    </ul>
  </div>
</div>
<?php }else{ ?>
  <div class="alert alert-danger alert-dismissible fade show text-center" style="margin-bottom: 30px;">
    <span class="alert-close" data-dismiss="alert"></span>&nbsp;&nbsp;¡Error no hay una order como tal, por favor contactanos!
  </div>
<?php } ?>
<div class="checkout-footer">
  <div class="column">
    <a class="btn btn-outline-secondary" number="3" onclick="addViewCheckout(this)">
      <i class="icon-arrow-left"></i>
      <span class="hidden-xs-down">&nbsp;Pago</span>
    </a>
  </div>
  <div class="column">
    <button type="button" class="btn btn-danger" onclick="PagarPedido(this)">Pagar</button>
  </div>
</div>