<?php 
  if (!class_exists("DatosEnvio")) {
    include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Cliente/DatosEnvio.Controller.php';
  }

  $DatosEnvioController = new DatosEnvioController();
  $DatosEnvioController->filter   = "WHERE t01_pk01 = ".$_SESSION['Ecommerce-ClienteKey']." ";
  $DatosEnvioController->orderBy  = "";
  $response = $DatosEnvioController->get(false);
 ?>
<div class="mt-2 mb-3">
  <button class="btn btn-primary margin-bottom-none" type="button" onclick="mostrarFormDatosEnvio()">Nuevo</button>
  <!-- <hr class="mt-2 mb-3"> -->
</div>
<div class="table-responsive shopping-cart">
  <table class="table" id="TableDatosEnvio">
    <thead>
      <tr>
        <th>Nombre</th>
        <th class="text-center">Apellido</th>
        <th class="text-center">Celular</th>
        <th class="text-center">Calle</th>
        <th class="text-center">Código Postal</th>
        <th class="text-center">Editar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($response->records as $key => $row): ?>
      <tr>
        <td><?php echo $row->Nombre ?></td>
        <td><?php echo $row->Apellido ?></td>
        <td><?php echo $row->Celular ?></td>
        <td><?php echo $row->Calle ?></td>
        <td><?php echo $row->CodigoPostal ?></td>
        <td><button class="btn btn-sm btn-warning" DatosEnvioKey="<?php echo $row->DatosEnvioKey ?>" onclick="EditarFormDatosEnvio(this)">editar</button></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<?php 
  unset($DatosEnvioController);
  unset($response);
 ?>