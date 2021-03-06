        <!-- Alert-->
        <div id="alert-list-cart"></div>
        <!-- Shopping Cart-->
        <div class="table-responsive shopping-cart">
          <table class="table">
            <thead>
              <tr>
                <th>Descripción</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Subtotal</th>
                <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Quitar</a></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                @session_start();
                if (isset($_SESSION['Ecommerce-PedidoKey'])) {
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
                      <img src="<?php echo $Img ?>" alt="<?php echo $row->ProductoDescripcion; ?>" width="100" height="50">
                    </a>
                    <div class="product-info">
                      <h4 class="product-title">
                        <a href="../Productos/index.php?codigo=<?php echo $row->ProductoCodigo ?>"><?php echo $row->ProductoDescripcion; ?></a>
                      <!-- </h4><span><em>Size:</em> 10.5</span><span><em>Color:</em> Dark Blue</span> -->
                    </div>
                  </div>
                </td>
                <td class="text-center"><?php echo $row->DetalleCantidad; ?></td>
                <td class="text-center text-lg text-medium">$<?php echo number_format($row->DetalleSubtotal); ?></td>
                <td class="text-center">
                  <a class="remove-from-cart" data-toggle="tooltip" title="Eliminar articulo" productokey="<?php echo $row->Detallekey ?>" onclick="deleteProductoCarrito(this)"><i class="icon-cross"></i></a>
                </td>
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
                  }
                }else{
              ?>
              <td colspan="5">
                <div class="alert alert-danger alert-dismissible fade show text-center" style="margin-bottom: 30px;">
                  <span class="alert-close" data-dismiss="alert"></span>&nbsp;&nbsp;¡Aún no hay productos en el carrito!
                </div>
              </td>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="shopping-cart-footer">
          <?php 
             $pedidoSubtotal = 0;
             $pedidoIva = 0;
             $pedidoTotal = 0;
             if(isset($_SESSION['Ecommerce-PedidoKey'])){ 
              if (!class_exists('PedidoController')) {
                include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Pedido.Controller.php';
              }
               $PedidoController = new PedidoController();
               $Pedido = $PedidoController->GetBy();
               $pedidoSubtotal = $Pedido->SubTotal;
               $pedidoIva = $Pedido->Iva;
               $pedidoTotal = $Pedido->Total;
             }
          ?>
          <div class="column text-lg">
            Subtotal: <span class="text-medium">$<?php echo $pedidoSubtotal; ?></span><br>
            Iva: <span class="text-medium">$<?php echo $pedidoIva; ?></span><br>
            Total: <span class="text-medium">$<?php echo $pedidoTotal; ?></span>
          </div>
        </div>
        <div class="shopping-cart-footer">
          <div class="column"><!-- <a class="btn btn-primary" href="#">Update Cart</a> --><a class="btn btn-success" href="../Checkout/">Terminar</a></div>
        </div>
        