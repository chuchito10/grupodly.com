<?php 

  if (!class_exists('ClienteController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Cliente/Cliente.Controller.php';
  }

  $ClienteController = new ClienteController();
  $ClienteController->filter = "WHERE t01_pk01 = ".$_SESSION['Ecommerce-ClienteKey']." ";
  $ClienteController->order = "";
  $response = $ClienteController->get(false);
  if ($response->count > 0) {
    $Cliente = $response->records[0];
?>
<div class="padding-top-2x mt-2 hidden-lg-up"></div>
<div id="alert-registro-actualizacion"></div>
<form class="row" id="form-registro">
  <input class="form-control" type="hidden" id="ActionCliente" name="ActionCliente" value="true">
  <input class="form-control" type="hidden" id="Action" name="Action" value="create">
  <input class="form-control" type="hidden" id="ClienteKey" name="ClienteKey" value="<?php echo $_SESSION['Ecommerce-ClienteKey']; ?>">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="reg-fn">Nombre</label>
      <input class="form-control" type="text" id="Nombre" name="Nombre" value="<?php echo $Cliente->Nombre; ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="reg-ln">Apellido</label>
      <input class="form-control" type="text" id="Apellido" name="Apellido" value="<?php echo $Cliente->Apellido; ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="reg-email">Correo eléctronico</label>
      <input class="form-control" type="email" id="Correo" name="Correo" value="<?php echo $Cliente->Correo; ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="reg-phone">Número de telefono</label>
      <input class="form-control" type="text" id="Telefono" name="Telefono" value="<?php echo $Cliente->Telefono; ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="reg-pass">Contraseña</label>
      <input class="form-control" type="password" id="ClientePassword" name="ClientePassword" value="<?php echo $Cliente->Password; ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="reg-pass-confirm">Confirmar contraseña</label>
      <input class="form-control" type="password" id="ClientePasswordConfirm" name="ClientePasswordConfirm" value="<?php echo $Cliente->Password; ?>">
    </div>
  </div>
  <div class="col-12 text-center text-sm-right">
    <hr class="mt-2 mb-3">
    <button class="btn btn-primary margin-bottom-none" type="button" onclick="Registro(this)">Actualizar</button>
  </div>
</form>
<?php } 

  unset($Cliente);
  unset($response);
?>