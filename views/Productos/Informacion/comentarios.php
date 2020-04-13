<?php 
  if (!class_exists('ComentariosController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Productos/Comentarios.Controller.php';
  }
  $ComentariosController = new ComentariosController();
  $ResultComentariosController = $ComentariosController->getProductoComentarios($ResultProducto->ProductoKey, false);
  // print_r($ResultComentariosController);
 
  foreach ($ResultComentariosController->records as $key => $row): ?>
  <div class="comment">
  <div class="comment-author-ava"><img src="../../public/plantilla/img/reviews/01.jpg" alt="Review author"></div>
  <div class="comment-body">
    <div class="comment-header d-flex flex-wrap justify-content-between">
      <h4 class="comment-title"><?php echo $row->Titulo ?></h4>
      <div class="mb-2">
          <div class="rating-stars">
            <i class="icon-star filled"></i>
            <i class="icon-star filled"></i>
            <i class="icon-star filled"></i>
            <i class="icon-star"></i>
            <i class="icon-star"></i>
          </div>
      </div>
    </div>
    <p class="comment-text"><?php echo $row->Descripcion ?>
  </div>
</div>
 <?php endforeach ?>
<!-- Review Form-->
<h5 class="mb-30 padding-top-1x">Leave Review</h5>
<form class="row" id="form-reviews">
  <input class="form-control form-control-rounded" type="hidden" id="Action" name="Action" value="create">
  <input class="form-control form-control-rounded" type="hidden" id="ActionComentarios" name="ActionComentarios" value="true">
  <input class="form-control form-control-rounded" type="hidden" id="ProductoKey" name="ProductoKey" value="<?php echo $ResultProducto->ProductoKey ?>">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="Titulo">Titulo</label>
      <input class="form-control form-control-rounded" type="text" id="Titulo" name="Titulo">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="TotalEstrellas">Rating</label>
      <select class="form-control form-control-rounded" id="TotalEstrellas" name="TotalEstrellas">
        <option value="5">5 Stars</option>
        <option value="4">4 Stars</option>
        <option value="3">3 Stars</option>
        <option value="2">2 Stars</option>
        <option value="1">1 Star</option>
      </select>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <label for="review_text">Comentario</label>
      <textarea class="form-control form-control-rounded" id="Descripcion" name="Descripcion" rows="8"></textarea>
    </div>
  </div>
  <div class="col-12 text-right">
    <button class="btn btn-outline-primary" type="button" onclick="nuevoComentarioProducto(this)">Submit Review</button>
  </div>
</form>
<?php 
  unset($ComentariosController);
  unset($ResultComentariosController);
 ?>