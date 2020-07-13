<?php 
  if (!class_exists('DatosFacturacionController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Cliente/DatosFacturacion.Controller.php';
  }
  $DatosFacturacionController = new DatosFacturacionController();
  $DatosFacturacionController->filter = isset($_POST['DatosFacturacionKey']) ? "WHERE t03_pk01 = '".$_POST['DatosFacturacionKey']."' " : "WHERE t03_pk01 = 0 "; 
  $key = isset($_POST['DatosFacturacionKey']) ? $_POST['DatosFacturacionKey'] : 0 ;
  $DatosFacturacion = $DatosFacturacionController->getBy();
?>
<form class="row" id="form-datos-facturacion">
  <input class="form-control" type="hidden" id="DatosFacturacionKey" name="DatosFacturacionKey" value="<?php echo $key ?>">
  <input class="form-control" type="hidden" id="Action" name="Action" value="create">
  <input class="form-control" type="hidden" id="ActionDatosFacturacion" name="ActionDatosFacturacion" value="true">
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">RazonSocial</label>
      <input class="form-control" type="text" id="RazonSocial" name="RazonSocial" value="<?php echo $DatosFacturacion->RazonSocial ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Tipo</label>
      <input class="form-control" type="text" id="Tipo" name="Tipo" value="<?php echo $DatosFacturacion->Tipo ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">RFC</label>
      <input class="form-control" type="text" id="RFC" name="RFC" value="<?php echo $DatosFacturacion->RFC ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Calle</label>
      <input class="form-control" type="text" id="Calle" name="Calle" value="<?php echo $DatosFacturacion->Calle ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">NumeroExterior</label>
      <input class="form-control" type="text" id="NumeroExterior" name="NumeroExterior" value="<?php echo $DatosFacturacion->NumeroExterior ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">NumeroInterior</label>
      <input class="form-control" type="text" id="NumeroInterior" name="NumeroInterior" value="<?php echo $DatosFacturacion->NumeroInterior ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">CodigoPostal</label>
      <input class="form-control" type="text" id="CodigoPostal" name="CodigoPostal" value="<?php echo $DatosFacturacion->CodigoPostal ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Estado</label>
      <input class="form-control" type="text" id="Estado" name="Estado" value="<?php echo $DatosFacturacion->Estado ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Municipio</label>
      <input class="form-control" type="text" id="Municipio" name="Municipio" value="<?php echo $DatosFacturacion->Municipio ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn">Colonia</label>
      <input class="form-control" type="text" id="Colonia" name="Colonia" value="<?php echo $DatosFacturacion->Colonia ?>">
    </div>
  </div>
  <div class="col-12 text-center text-sm-right">
    <button class="btn btn-primary btn-block margin-bottom-none" type="button" onclick="nuevoRegistroDatosFacturacion()">Enviar</button>
  </div>
</form>
<?php 
  unset($DatosFacturacion);
 ?>