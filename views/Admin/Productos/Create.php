<?php 

  if (!class_exists("CategoriaController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Catalogos/Categoria.Controller.php';
  }if (!class_exists("ProveedorController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Catalogos/Proveedor.Controller.php';
  }if (!class_exists("UnidadMedidaController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Catalogos/UnidadMedida.Controller.php';
  }
  

  if (isset($_POST['ProductoKey'])) {
    if (!class_exists('ProductoController')) {
      include $_SERVER['DOCUMENT_ROOT'].'/models/Productos/Producto.Controller.php';
    }
    $Action = 'update';
    $ProductoKey = $_POST['ProductoKey'];

    $ProductoController = new ProductoController();
    $ProductoController->filter = "WHERE t06_pk01 = ".$_POST['ProductoKey']." ";
    $ProductoController->order = "";
    $ResultProductoController = $ProductoController->get(false)->records[0];
  }else{
    if (!class_exists('ProductoModel')) {
      include $_SERVER['DOCUMENT_ROOT'].'/models/Productos/Producto.Model.php';
    }
    $Action = 'create';
    $ProductoKey = 0;
    
    $ProductoModel = new Producto();
    $ResultProductoController = $ProductoModel;
  }

 ?>
 <div class="accordion" id="accordion1" role="tablist">
  <div class="card">
    <div class="card-header" role="tab">
      <h6><a href="#collapseOne" data-toggle="collapse">Img Principal</a></h6>
    </div>
    <div class="collapse" id="collapseOne" data-parent="#accordion1" role="tabpanel">
      <div class="card-body">
          <div class="col-sm-12">
            <div class="file-loading">
              <input type="file" id="producto-img-principal" name="producto-img-principal">
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab">
      <h6><a class="collapsed" href="#collapseTwo" data-toggle="collapse">Información</a></h6>
    </div>
    <div class="collapse show" id="collapseTwo" data-parent="#accordion1" role="tabpanel">
      <div class="card-body">
        <form class="row" id="form-producto">
          <input class="form-control form-control-rounded" type="hidden" id="Action" name="Action" value="<?php echo $Action; ?>">
          <input class="form-control form-control-rounded" type="hidden" id="ActionProducto" name="ActionProducto" value="true">
          <input class="form-control form-control-rounded" type="hidden" id="ProductoKey" name="ProductoKey" value="<?php echo $ProductoKey; ?>">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Codigo">Código</label>
              <input class="form-control form-control-rounded" type="text" id="Codigo" name="Codigo" value="<?php echo $ResultProductoController->Codigo ?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Descripcion">Descripción</label>
              <input class="form-control form-control-rounded" type="text" id="Descripcion" name="Descripcion" value="<?php echo $ResultProductoController->Descripcion ?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Ancho">Ancho</label>
              <input class="form-control form-control-rounded" type="text" id="Ancho" name="Ancho" value="<?php echo $ResultProductoController->Ancho ?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Alto">Alto</label>
              <input class="form-control form-control-rounded" type="text" id="Alto" name="Alto" value="<?php echo $ResultProductoController->Alto ?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Grosor">Grosor</label>
              <input class="form-control form-control-rounded" type="text" id="Grosor" name="Grosor" value="<?php echo $ResultProductoController->Grosor ?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Existencia">Existencia</label>
              <input class="form-control form-control-rounded" type="text" id="Existencia" name="Existencia" value="<?php echo $ResultProductoController->Existencia ?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Precio">Precio</label>
              <input class="form-control form-control-rounded" type="text" id="Precio" name="Precio" value="<?php echo $ResultProductoController->Precio ?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="UnidadMedidaKey">Unidad Medida</label>
              <select class="form-control form-control-rounded" id="UnidadMedidaKey" name="UnidadMedidaKey">
                <?php 
                    $UnidadMedidaController = new UnidadMedidaController();
                    $UnidadMedidaController->filter = "";
                    $UnidadMedidaController->order  = "";
                    $ResultUnidadMedidaController = $UnidadMedidaController->get(false);
                    foreach ($ResultUnidadMedidaController->records as $key => $UnidadMedida) {
                      $Selected = $UnidadMedida->UnidadMedidaKey == $ResultProductoController->UnidadMedidaKey ? 'selected' : '';
                 ?>
                <option value="<?php echo $UnidadMedida->UnidadMedidaKey ?>" <?php echo $Selected ?>><?php echo $UnidadMedida->Descripcion ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="CategoriaKey">Familia</label>
              <select class="form-control form-control-rounded" id="CategoriaKey" name="CategoriaKey">
                <?php 
                    $CategoriaController = new CategoriaController();
                    $CategoriaController->filter = "";
                    $CategoriaController->order  = "";
                    $ResultCategoriaController = $CategoriaController->get(false);
                    foreach ($ResultCategoriaController->records as $key => $Categoria) {
                      $Selected = $Categoria->CategoriaKey == $ResultProductoController->CategoriaKey ? 'selected' : '';
                 ?>
                <option value="<?php echo $Categoria->CategoriaKey ?>" <?php echo $Selected ?>><?php echo $Categoria->Descripcion ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="ProveedorKey">Proveedor</label>
              <select class="form-control form-control-rounded" id="ProveedorKey" name="ProveedorKey">
                <?php 
                    $ProveedorController = new ProveedorController();
                    $ProveedorController->filter = "";
                    $ProveedorController->order  = "";
                    $ResultProveedorController = $ProveedorController->get(false);
                    foreach ($ResultProveedorController->records as $key => $Proveedor) {
                      $Selected = $Proveedor->ProveedorKey == $ResultProductoController->ProveedorKey ? 'selected' : '';
                 ?>
                <option value="<?php echo $Proveedor->ProveedorKey ?>" <?php echo $Selected ?>><?php echo $Proveedor->Descripcion ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-12 text-right">
            <button class="btn btn-outline-primary" type="button" onclick="nuevoRegistroProducto(this)">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php 
  unset($CategoriaController);
  unset($ResultCategoriaController);
  unset($ProveedorController);
  unset($ResultProveedorController);
  unset($ProductoController);
  unset($ProductoModel);
  unset($ResultProductoController);
 ?>