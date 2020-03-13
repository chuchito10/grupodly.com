<?php 
  $ProductoController = new ProductoController();
  $ProductoController->filter = "WHERE t07_pk01 = ".$_GET['id']." ";
  $ProductoController->order = "";
  $ResultProductoController = $ProductoController->get(false);
  if ($ResultProductoController->count > 0) {
    foreach ($ResultProductoController->records as $key => $row) {
 ?>
<!-- Product-->
<div class="grid-item">
  <div class="product-card">
    <a class="product-thumb" href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><img src="../../public/plantilla/img/shop/products/01.jpg" alt="Product"></a>
    <h3 class="product-title"><a href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><?php echo $row->Descripcion ?></a></h3>
    <input type="hidden" class="form-control" id="ProductoKey-<?php echo $row->Codigo ?>" name="ProductoKey-<?php echo $row->Codigo ?>" value="<?php echo $row->ProductoKey ?>">
    <input type="hidden" class="form-control" id="ProductoCantidad-<?php echo $row->Codigo ?>" name="ProductoCantidad-<?php echo $row->Codigo ?>" value="1">
    <h4 class="product-price">
      $<?php $row->Precio ?>
    </h4>
    <div class="product-buttons">
      <button class="btn btn-outline-primary btn-sm" code="<?php echo $row->Codigo ?>" onclick="agregarToCarrito(this)"><i class="icon-bag"></i> Añadir carrito</button>
    </div>
  </div>
</div>
<?php }} ?>