<div class="table-responsive shopping-cart">
  <table class="table" id="TablePedidos">
    <thead>
      <tr>
        <th class="text-center">#</th>
        <th class="text-center">Cantidad</th>
        <th class="text-center">Subtotal</th>
        <th class="text-center">Iva</th>
        <th class="text-center">Total</th>
        <th class="text-center">Detalle</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        @session_start();
        if (!class_exists('PedidoController')) {
          include $_SERVER['DOCUMENT_ROOT'].'/models/Pedido/Pedido.Controller.php';
        }
        $PedidoController = new PedidoController();
        $PedidoController->filter = "WHERE t01_pk01 = '".$_SESSION['Ecommerce-ClienteKey']."' AND t04_f004 = 1 ";
        $ResultPedidoController = (object)$PedidoController->List(false);

        if ($ResultPedidoController->count > 0) {
          foreach ($ResultPedidoController->records as $key => $Pedido){ 
              
      ?>
      <tr>
        <td class="text-center"><?php echo $key+1 ?></td>
        <td class="text-center"><?php echo $Pedido->Key ?></td>
        <td class="text-center">$<?php echo $Pedido->SubTotal; ?></td>
        <td class="text-center">$<?php echo $Pedido->Iva; ?></td>
        <td class="text-center">$<?php echo $Pedido->Total; ?></td>
        <td class="text-center">
          <span class="text-danger cursor-pointer" pedidokey="<?php echo $Pedido->Key ?>" onclick="detallePedido(this)"><i class="icon-bag"></i></span>
        </td>
      </tr>
      <?php 
          } 
        }else{
      ?>
      <td colspan="5">
        <div class="alert alert-danger alert-dismissible fade show text-center" style="margin-bottom: 30px;">
          <span class="alert-close" data-dismiss="alert"></span>&nbsp;&nbsp;¡Aún no tienes ordenes de compra, por favor realiza tu primera compra!
        </div>
      </td>
      <?php 
          } 
      ?>
    </tbody>
  </table>
</div>