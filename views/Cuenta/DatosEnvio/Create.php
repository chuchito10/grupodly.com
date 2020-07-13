<?php 
  if (!class_exists('DatosEnvioController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Cliente/DatosEnvio.Controller.php';
  }
  $DatosEnvioController = new DatosEnvioController();
  $DatosEnvioController->filter = isset($_POST['DatosEnvioKey']) ? "WHERE t02_pk01 = '".$_POST['DatosEnvioKey']."' " : "WHERE t02_pk01 = 0 "; 
  $key = isset($_POST['DatosEnvioKey']) ? $_POST['DatosEnvioKey'] : 0 ;
  $DatosEnvio = $DatosEnvioController->getBy();
?>
<form class="row" id="form-datos-envio">
  <input class="form-control" type="hidden" id="DatosEnvioKey" name="DatosEnvioKey" value="<?php echo $key ?>">
  <input class="form-control" type="hidden" id="ActionDatosEnvio" name="ActionDatosEnvio" value="true">
  <input class="form-control" type="hidden" id="Action" name="Action" value="create">
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Nombre <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="Nombre" name="Nombre" value="<?php echo $DatosEnvio->Nombre ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Apellido <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="Apellido" name="Apellido" value="<?php echo $DatosEnvio->Apellido ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Celular <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="Celular" name="Celular" value="<?php echo $DatosEnvio->Celular ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Telefono <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="Telefono" name="Telefono" value="<?php echo $DatosEnvio->Telefono ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Calle <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="Calle" name="Calle" value="<?php echo $DatosEnvio->Calle ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">NumeroExterior</label>
      <input class="form-control" type="text" id="NumeroExterior" name="NumeroExterior" value="<?php echo $DatosEnvio->NumeroExterior ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">NumeroInterior</label>
      <input class="form-control" type="text" id="NumeroInterior" name="NumeroInterior" value="<?php echo $DatosEnvio->NumeroInterior ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">CodigoPostal <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="CodigoPostal" name="CodigoPostal" value="<?php echo $DatosEnvio->CodigoPostal ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Estado <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="Estado" name="Estado" value="<?php echo $DatosEnvio->Estado ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Municipio <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="Municipio" name="Municipio" value="<?php echo $DatosEnvio->Municipio ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Colonia <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="text" id="Colonia" name="Colonia" value="<?php echo $DatosEnvio->Colonia ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Referencia</label>
      <input class="form-control" type="text" id="Referencia" name="Referencia" value="<?php echo $DatosEnvio->Referencia ?>">
    </div>
  </div>
  <div class="col-12 text-center text-sm-right">
    <button class="btn btn-primary btn-block margin-bottom-none" type="button" onclick="nuevoRegistroDatosEnvio()">Enviar</button>
  </div>
</form>
<?php 
  unset($DatosEnvio);
 ?>