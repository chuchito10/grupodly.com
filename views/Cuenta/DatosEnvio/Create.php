<?php 
  if (!class_exists('DatosEnvio')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Cliente/Cuenta/DatosEnvio.php';
  }
    $DatosEnvio = new DatosEnvio();
  if (isset($_POST['DatosEnvioKey'])) {
    $obj = (object)$DatosEnvio->get("WHERE t02_pk01 = ".$_POST['DatosEnvioKey']." ", "", false)->records[0];
    $Action = 'update';
  }else{
    $obj = $DatosEnvio;
    $Action = 'create';
  }
 ?>
<form class="row" id="form-datos-envio">
  <input class="form-control" type="hidden" id="DatosEnvioKey" name="DatosEnvioKey" value="<?php echo $_POST['DatosEnvioKey'] ?>">
  <input class="form-control" type="hidden" id="ActionDatosEnvio" name="ActionDatosEnvio" value="true">
  <input class="form-control" type="hidden" id="Action" name="Action" value="<?php echo $Action ?>">
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioNombre['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioNombre['type'] ?>" id="<?php echo $obj->DatosEnvioNombre['name'] ?>" name="<?php echo $obj->DatosEnvioNombre['name'] ?>" value="<?php echo $obj->DatosEnvioNombre['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioApellido['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioApellido['type'] ?>" id="<?php echo $obj->DatosEnvioApellido['name'] ?>" name="<?php echo $obj->DatosEnvioApellido['name'] ?>" value="<?php echo $obj->DatosEnvioApellido['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioCelular['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioCelular['type'] ?>" id="<?php echo $obj->DatosEnvioCelular['name'] ?>" name="<?php echo $obj->DatosEnvioCelular['name'] ?>" value="<?php echo $obj->DatosEnvioCelular['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioTelefono['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioTelefono['type'] ?>" id="<?php echo $obj->DatosEnvioTelefono['name'] ?>" name="<?php echo $obj->DatosEnvioTelefono['name'] ?>" value="<?php echo $obj->DatosEnvioTelefono['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioCalle['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioCalle['type'] ?>" id="<?php echo $obj->DatosEnvioCalle['name'] ?>" name="<?php echo $obj->DatosEnvioCalle['name'] ?>" value="<?php echo $obj->DatosEnvioCalle['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioNumeroExt['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioNumeroExt['type'] ?>" id="<?php echo $obj->DatosEnvioNumeroExt['name'] ?>" name="<?php echo $obj->DatosEnvioNumeroExt['name'] ?>" value="<?php echo $obj->DatosEnvioNumeroExt['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioNumeroInt['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioNumeroInt['type'] ?>" id="<?php echo $obj->DatosEnvioNumeroInt['name'] ?>" name="<?php echo $obj->DatosEnvioNumeroInt['name'] ?>" value="<?php echo $obj->DatosEnvioNumeroInt['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioCP['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioCP['type'] ?>" id="<?php echo $obj->DatosEnvioCP['name'] ?>" name="<?php echo $obj->DatosEnvioCP['name'] ?>" value="<?php echo $obj->DatosEnvioCP['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioEstado['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioEstado['type'] ?>" id="<?php echo $obj->DatosEnvioEstado['name'] ?>" name="<?php echo $obj->DatosEnvioEstado['name'] ?>" value="<?php echo $obj->DatosEnvioEstado['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioMunicipio['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioMunicipio['type'] ?>" id="<?php echo $obj->DatosEnvioMunicipio['name'] ?>" name="<?php echo $obj->DatosEnvioMunicipio['name'] ?>" value="<?php echo $obj->DatosEnvioMunicipio['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioColonia['label'] ?> <strong class="text-danger text-lg">*</strong></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioColonia['type'] ?>" id="<?php echo $obj->DatosEnvioColonia['name'] ?>" name="<?php echo $obj->DatosEnvioColonia['name'] ?>" value="<?php echo $obj->DatosEnvioColonia['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosEnvioReferencia['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosEnvioReferencia['type'] ?>" id="<?php echo $obj->DatosEnvioReferencia['name'] ?>" name="<?php echo $obj->DatosEnvioReferencia['name'] ?>" value="<?php echo $obj->DatosEnvioReferencia['value'] ?>">
    </div>
  </div>
  <div class="col-12 text-center text-sm-right">
    <button class="btn btn-primary btn-block margin-bottom-none" type="button" onclick="nuevoRegistroDatosEnvio()">Enviar</button>
  </div>
</form>
<?php 
  unset($DatosEnvio);
  unset($obj);
 ?>