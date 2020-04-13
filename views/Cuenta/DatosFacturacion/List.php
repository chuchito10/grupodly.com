<?php 
  if (!class_exists("DatosFacturacion")) {
    include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Cliente/DatosFacturacion.Controller.php';
  }

  $DatosFacturacionController = new DatosFacturacionController();
  $DatosFacturacionController->filter   = "WHERE t01_pk01 = ".$_SESSION['Ecommerce-ClienteKey']." ";
  $DatosFacturacionController->orderBy  = "";
  $response = $DatosFacturacionController->get(false);
 ?>
<div class="mt-2 mb-3">
  <button class="btn btn-primary margin-bottom-none" type="button" onclick="mostrarFormDatosFacturacion()">Nuevo</button>
  <!-- <hr class="mt-2 mb-3"> -->
</div>
<div class="table-responsive shopping-cart">
  <table class="table" id="TableDatosFacturacion">
    <thead>
      <tr>
        <th>Razón Social</th>
        <th class="text-center">RFC</th>
        <th class="text-center">Calle</th>
        <th class="text-center">Código Postal</th>
        <th class="text-center">Editar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($response->records as $key => $row): ?>
      <tr>
        <td><?php echo $row->RazonSocial ?></td>
        <td><?php echo $row->RFC ?></td>
        <td><?php echo $row->Calle ?></td>
        <td><?php echo $row->CodigoPostal ?></td>
        <td><button class="btn btn-sm btn-warning" DatosFacturacionKey="<?php echo $row->DatosFacturacionKey ?>" onclick="editarFormDatosFacturacion(this)">editar</button></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<?php 
  unset($DatosFacturacion);
  unset($response);
 ?>