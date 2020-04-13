<div class="table-responsive shopping-cart">
  <table class="table" id="TableDetalle">
    <thead>
      <tr>
        <th class="text-center">#</th>
        <th class="text-center">Cantidad</th>
        <th class="text-center">Subtotal</th>
        <th class="text-center">Iva</th>
        <th class="text-center">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        @session_start();
        if (!class_exists('DetalleController')) {
          include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Detalle.Controller.php';
        }
        $DetalleController = new DetalleController();
        $DetalleController->filter = "WHERE t04_pk01 = '".$_POST['PedidoKey']."' ";
        $ResultDetalleController = $DetalleController->List(false);

        if ($ResultDetalleController->count > 0) {
          foreach ($ResultDetalleController->records as $key => $Detalle){ 
              
      ?>
      <tr>
        <td class="text-center"><?php echo $key+1 ?></td>
        <td class="text-center"><?php echo $Detalle->key ?></td>
        <td class="text-center">$<?php echo $Detalle->Subtotal; ?></td>
        <td class="text-center">$<?php echo $Detalle->Iva; ?></td>
        <td class="text-center">$<?php echo $Detalle->Total; ?></td>
      </tr>
      <?php 
          } 
        }
      ?>
    </tbody>
  </table>
</div>