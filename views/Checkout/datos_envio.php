<!-- --------------------------------------------- Datos de envió ----------------------------------------- -->

<h4>Datos de envió</h4>
<hr class="padding-bottom-1x">
<?php 
  if (!class_exists("DatosEnvio")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Cliente/DatosEnvio.Controller.php';
  }

  $DatosEnvioController = new DatosEnvioController();
  $DatosEnvioController->filter   = "WHERE t01_pk01 = ".$_SESSION['Ecommerce-ClienteKey']." ";
  $DatosEnvioController->orderBy  = "";
  $response = $DatosEnvioController->get(false);
 ?>
<div class="table-responsive shopping-cart">
  <table class="table" id="TableDatosEnvio">
    <thead>
      <tr>
        <th></th>
        <th>Dirección</th>
        <th class="text-center">Código Postal</th>
        <th class="text-center">Contacto</th>
        <th class="text-center">Celular</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($response->records as $key => $row): 
          $check = $key == 0 ? 'checked': '';
      ?>
      <tr>
        <td>
          <div class="custom-control custom-radio">
            <input class="custom-control-input datosEnvio" type="radio" id="radio-<?php echo $row->DatosEnvioKey ?>" name="radioDatosEnvio" value="<?php echo $row->DatosEnvioKey ?>" <?php echo $check ?>>
            <label class="custom-control-label" for="radio-<?php echo $row->DatosEnvioKey ?>"></label>
          </div>
        </td>
        <td>
          <span class="text-gray-dark"> <?php echo $row->Municipio.' '.$row->Estado ?> </span><br>
          <span class="text-muted text-sm" id="datosEnvio-direccion-<?php echo $row->DatosEnvioKey ?>"> 
            <?php echo $row->Calle.' No Ext: '.$row->NumeroExterior.' No Int. '.$row->NumeroInterior.' Col. '.$row->Colonia ?> 
          </span> 
          <span class="text-muted text-sm" id="datosEnvio-referencia-<?php echo $row->DatosEnvioKey ?>"><?php echo $row->Referencia ?></span>
        </td>
        <td class="text-center" id="datosEnvio-codigoPostal-<?php echo $row->DatosEnvioKey ?>"><?php echo $row->CodigoPostal ?></td>
        <td class="text-center"><?php echo $_SESSION['Ecommerce-ClienteNombre'] ?></td>
        <td class="text-center" id="datosEnvio-celular-<?php echo $row->DatosEnvioKey ?>"><?php echo $row->Celular ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<!-- --------------------------------------------- Datos de facturación ----------------------------------------- -->

<h4>Datos de facturación</h4>
<hr class="padding-bottom-1x">
<?php 
  if (!class_exists("DatosFacturacion")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Cliente/DatosFacturacion.Controller.php';
  }

  $DatosFacturacionController = new DatosFacturacionController();
  $DatosFacturacionController->filter   = "WHERE t01_pk01 = ".$_SESSION['Ecommerce-ClienteKey']." ";
  $DatosFacturacionController->orderBy  = "";
  $response = $DatosFacturacionController->get(false);
 ?>
<div class="table-responsive shopping-cart">
  <table class="table" id="TableDatosFacturacion">
    <thead>
      <tr>
        <th></th>
        <th>Dirección</th>
        <th class="text-center">RFC</th>
        <th class="text-center">Código Postal</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($response->records as $key => $row): 
          $check = $key == 0 ? 'checked': '';
      ?>
      <tr>
        <td>
          <div class="custom-control custom-radio">
            <input class="custom-control-input datosFacturacion" type="radio" id="radio-<?php echo $row->DatosFacturacionKey ?>" name="radioDatosFacturacion" value="<?php echo $row->DatosFacturacionKey ?>" <?php echo $check ?>>
            <label class="custom-control-label" for="radio-<?php echo $row->DatosFacturacionKey ?>"></label>
          </div>
        </td>
        <td>
          <span class="text-gray-dark"> <?php echo $row->Municipio.' '.$row->Estado ?> </span><br>
          <span class="text-muted text-sm" id="datosFacturacion-direccion-<?php echo $row->DatosFacturacionKey ?>"> 
            <?php echo $row->Calle.' No Ext: '.$row->NumeroExterior.' No Int. '.$row->NumeroInterior.' Col. '.$row->Colonia ?> 
          </span> 
        </td>
        <td class="text-center" id="datosFacturacion-RFC-<?php echo $row->DatosFacturacionKey ?>"><?php echo $row->RFC ?></td>
        <td class="text-center" id="datosFacturacion-codigoPostal-<?php echo $row->DatosFacturacionKey ?>"><?php echo $row->CodigoPostal ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<div class="checkout-footer">
  <div class="column">
    <a class="btn btn-outline-secondary" href="../Carrito/"><i class="icon-arrow-left"></i>
      <span class="hidden-xs-down">&nbsp;Regresar al carrito</span>
    </a>
  </div>
  <div class="column">
    <a class="btn btn-primary" number="2" onclick="addViewCheckout(this)">
      <span class="hidden-xs-down">Continuar&nbsp;</span><i class="icon-arrow-right"></i>
    </a>
  </div>
</div>