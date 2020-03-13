<?php 
  $CategoriaController = new CategoriaController();
  $CategoriaController->filter = "";
  $CategoriaController->order = "";
  $ResultCategoriaController = $CategoriaController->get(false);

  $ProductoController = new ProductoController();
?>
<!-- Widget Categories-->
<section class="widget widget-categories">
  <h3 class="widget-title">Categorias</h3>
  <ul>
    <?php if ($ResultCategoriaController->count > 0):                  
        foreach ($ResultCategoriaController->records as $key => $row): ?>
    <li class="has-children <?php echo $row->CategoriaKey == $_GET['id'] ? 'expanded' : '' ?>"><a href="../Categorias/index.php?id=<?php echo $row->CategoriaKey ?>"><?php echo $row->Descripcion ?></a>
      <ul>
      <?php 
        $ProductoController->filter = "WHERE t07_pk01 = ".$row->CategoriaKey." ";
        $ProductoController->order = "";
        $ResultProductoController = $ProductoController->get(false);
        if ($ResultProductoController->count > 0):
        foreach ($ResultProductoController->records as $key => $col): 
      ?>
        <li><a href="#"><?php echo $col->Descripcion ?></li>
      <?php endforeach ?>
      <?php endif ?>
      </ul>
    </li>
    <?php endforeach ?>
     <?php else: ?>
      <h3>no hay categorias</h3>
    <?php endif ?>
  </ul>
</section>
<?php 
  unset($CategoriaController);
  unset($ResultCategoriaController);
  unset($ProductoController);
  unset($ResultProductoController);
 ?>