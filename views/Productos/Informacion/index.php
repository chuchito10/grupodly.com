<!-- Product Tabs-->
<div class="row padding-top-3x mb-3">
  <div class="col-lg-10 offset-lg-1">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab" role="tab">Descripción</a></li>
      <li class="nav-item"><a class="nav-link" href="#reviews" data-toggle="tab" role="tab">Comentarios</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="description" role="tabpanel">
        <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Productos/Informacion/descripcion.php'; ?>
      </div>
      <div class="tab-pane fade" id="reviews" role="tabpanel">
        <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Productos/Informacion/comentarios.php'; ?>
      </div>
    </div>
  </div>
</div> 