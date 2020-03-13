<?php 
  if (!class_exists('ProductoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Productos/Producto.Controller.php';
  }
  $ProductoController = new ProductoController();
  $ProductoController->filter = "";
  $ProductoController->order = "ORDER BY t06_pk01 ASC";
  $ResultProductoController = $ProductoController->get(false);
 ?>
<div class="mt-2 mb-3">
  <button class="btn btn-primary margin-bottom-none" type="button" onclick="mostrarFormProducto()">Nuevo</button>
  <!-- <hr class="mt-2 mb-3"> -->
</div>
<div class="table-responsive-sm shopping-cart">
  <table class="table" id="TableProductos">
    <thead>
      <tr>
        <th>#</th>
        <th class="text-center">Codigo</th>
        <th>Descripcion</th>
        <th class="text-center">Existencia</th>
        <th class="text-center">Precio</th>
        <th class="text-center">Editar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ResultProductoController->records as $key => $row): ?>
      <tr>
        <td><?php echo $key+1; ?></td>
        <td class="text-center"><?php echo $row->Codigo ?></td>
        <td><?php echo $row->Descripcion ?></td>
        <td class="text-center"><?php echo $row->Existencia ?></td>
        <td class="text-center">$<?php echo $row->Precio ?></td>
        <td class="text-center">
          <button class="btn btn-sm btn-warning" codigo="<?php echo $row->Codigo ?>" productokey="<?php echo $row->ProductoKey ?>" onclick="EditarFormProducto(this)">editar</button>
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<?php 
  unset($ProductoController);
  unset($ResultProductoController);
 ?>