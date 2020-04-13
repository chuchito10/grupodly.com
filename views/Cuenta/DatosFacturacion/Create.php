<?php 
  if (!class_exists('DatosFacturacion')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Cliente/Cuenta/DatosFacturacion.php';
  }
    $DatosFacturacion = new DatosFacturacion();
  if (isset($_POST['DatosFacturacionKey'])) {
    $obj = (object)$DatosFacturacion->get("WHERE t03_pk01 = ".$_POST['DatosFacturacionKey']." ", "", false)->records[0];
    $Action = 'update';
  }else{
    $obj = $DatosFacturacion;
    $Action = 'create';
  }
 ?>
<form class="row" id="form-datos-facturacion">
  <input class="form-control" type="hidden" id="DatosFacturacionKey" name="DatosFacturacionKey" value="<?php echo $_POST['DatosFacturacionKey'] ?>">
  <input class="form-control" type="hidden" id="Action" name="Action" value="<?php echo $Action ?>">
  <input class="form-control" type="hidden" id="ActionDatosFacturacion" name="ActionDatosFacturacion" value="true">
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionRazonSocial['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionRazonSocial['type'] ?>" id="<?php echo $obj->DatosFacturacionRazonSocial['name'] ?>" name="<?php echo $obj->DatosFacturacionRazonSocial['name'] ?>" value="<?php echo $obj->DatosFacturacionRazonSocial['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionTipo['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionTipo['type'] ?>" id="<?php echo $obj->DatosFacturacionTipo['name'] ?>" name="<?php echo $obj->DatosFacturacionTipo['name'] ?>" value="<?php echo $obj->DatosFacturacionTipo['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionRFC['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionRFC['type'] ?>" id="<?php echo $obj->DatosFacturacionRFC['name'] ?>" name="<?php echo $obj->DatosFacturacionRFC['name'] ?>" value="<?php echo $obj->DatosFacturacionRFC['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionCalle['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionCalle['type'] ?>" id="<?php echo $obj->DatosFacturacionCalle['name'] ?>" name="<?php echo $obj->DatosFacturacionCalle['name'] ?>" value="<?php echo $obj->DatosFacturacionCalle['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionNumeroExt['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionNumeroExt['type'] ?>" id="<?php echo $obj->DatosFacturacionNumeroExt['name'] ?>" name="<?php echo $obj->DatosFacturacionNumeroExt['name'] ?>" value="<?php echo $obj->DatosFacturacionNumeroExt['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionNumeroInt['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionNumeroInt['type'] ?>" id="<?php echo $obj->DatosFacturacionNumeroInt['name'] ?>" name="<?php echo $obj->DatosFacturacionNumeroInt['name'] ?>" value="<?php echo $obj->DatosFacturacionNumeroInt['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionCP['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionCP['type'] ?>" id="<?php echo $obj->DatosFacturacionCP['name'] ?>" name="<?php echo $obj->DatosFacturacionCP['name'] ?>" value="<?php echo $obj->DatosFacturacionCP['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionEstado['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionEstado['type'] ?>" id="<?php echo $obj->DatosFacturacionEstado['name'] ?>" name="<?php echo $obj->DatosFacturacionEstado['name'] ?>" value="<?php echo $obj->DatosFacturacionEstado['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionMunicipio['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionMunicipio['type'] ?>" id="<?php echo $obj->DatosFacturacionMunicipio['name'] ?>" name="<?php echo $obj->DatosFacturacionMunicipio['name'] ?>" value="<?php echo $obj->DatosFacturacionMunicipio['value'] ?>">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="reg-fn"><?php echo $obj->DatosFacturacionColonia['label'] ?></label>
      <input class="form-control" type="<?php echo $obj->DatosFacturacionColonia['type'] ?>" id="<?php echo $obj->DatosFacturacionColonia['name'] ?>" name="<?php echo $obj->DatosFacturacionColonia['name'] ?>" value="<?php echo $obj->DatosFacturacionColonia['value'] ?>">
    </div>
  </div>
  <div class="col-12 text-center text-sm-right">
    <button class="btn btn-primary btn-block margin-bottom-none" type="button" onclick="nuevoRegistroDatosFacturacion()">Enviar</button>
  </div>
</form>
<?php 
  unset($DatosEnvio);
  unset($obj);
 ?>