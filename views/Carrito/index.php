 <html> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Head.php'; ?>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Header.php'; ?>    
    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Carrito</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="../Home/">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Carrito</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-1">
        <div id="ListProductosCarrito">
          <?php include 'List.php'; ?>
        </div>

        <!-- Related Products Carousel-->
        <h3 class="text-center padding-top-2x mt-2 padding-bottom-1x">You May Also Like</h3>
        <!-- Carousel-->
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
          <?php 
            if (!class_exists("ProductoController")) {
              include $_SERVER["DOCUMENT_ROOT"].'/models/Productos/Producto.Controller.php';
            }

            $ProductoController = new ProductoController();
            $ProductoController->filter = "";
            $ProductoController->order = " ORDER BY RAND() LIMIT 6";
            $ResultProductoController = $ProductoController->get(false);

          foreach ($ResultProductoController->records as $key => $row): 
            $Imgpath = '../../public/img/Productos/'.$row->Img.'.jpg';
            $Img = file_exists($Imgpath) ? $Imgpath : $_SESSION['Ecommerce-ImgNotFound'];
          ?>
          <!-- Product-->
          <div class="grid-item">
            <div class="product-card">
              <!-- <div class="product-badge text-danger">22% Off</div> --><a class="product-thumb" href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><img src="<?php echo $Img ?>" alt="Product"></a>
              <h3 class="product-title"><a href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><?php echo $row->Descripcion ?></a></h3>
              <input type="hidden" class="form-control" id="ProductoKey-<?php echo $row->Codigo ?>" name="ProductoKey-<?php echo $row->Codigo ?>" value="<?php echo $row->ProductoKey ?>">
              <input type="hidden" class="form-control" id="ProductoCantidad-<?php echo $row->Codigo ?>" name="ProductoCantidad-<?php echo $row->Codigo ?>" value="1">
              <h4 class="product-price">
                $<?php echo $row->Precio ?>
              </h4>
              <div class="product-buttons">
                <button class="btn btn-outline-primary btn-sm" code="<?php echo $row->Codigo ?>" onclick="agregarToCarrito(this)"><i class="icon-bag"></i> Añadir carrito</button>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Scripts.php'; 
    ?>
  </body>
</html>