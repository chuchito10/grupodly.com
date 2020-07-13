<?php 
  @session_start();
  if (isset($_SESSION['Ecommerce-PedidoPagar']) && $_SESSION['Ecommerce-PedidoPagar']) {
   header('Location: ../Checkout');
  }else{
 ?>
 <html> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Head.php'; ?>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Header.php'; ?>       
        <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Content-->
      <!-- Main Slider-->
      <section class="hero-slider" style="background-image: url(../../public/img/Home/main-bg.jpg);">
        <div class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
          <div class="item">
            <div class="container padding-top-3x">
              <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                  <div class="from-bottom">
                    <img class="d-block mx-auto" src="../../public/img/Home/Texto1.png" alt="">
                  </div>
                </div>
                        <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto"  src="../../public/img/Home/Imagen1.png" alt=""></div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="container padding-top-3x">
                      <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                  <div class="from-bottom">
                    <img class="d-block mx-auto" src="../../public/img/Home/Texto2.png" alt="">
                  </div>
                </div>
                        <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="../../public/img/Home/Imagen2.png" alt=""></div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="container padding-top-3x">
                      <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                  <div class="from-bottom">
                    <img class="d-block mx-auto" src="../../public/img/Home/Texto3.png" alt="">
                  </div>
                </div>
                <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="../../public/img/Home/Imagen3.png" alt=""></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Top Categories-->
      <section class="container padding-top-3x">
        <h3 class="text-center mb-30">Top Categorias</h3>
        <div class="row">
          <?php 
            if (!class_exists("ProductoController")) {
              include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Productos/Producto.Controller.php';
            }

            $ProductoController = new ProductoController();
            $ProductoController->filter = "";
            $ProductoController->order = " ORDER BY RAND() LIMIT 3";
            $ResultProductoController = $ProductoController->get();

          foreach ($ResultProductoController->records as $key => $row): 
            $Imgpath = '../../public/img/Productos/'.$row->Img.'.jpg';
            $Img = file_exists($Imgpath) ? $Imgpath : $_SESSION['Ecommerce-ImgNotFound'];
          ?>
          <div class="col-md-4 col-sm-6">
            <div class="card mb-30"><a class="card-img-tiles" href="../Categorias/">
                <div class="inner">
                  <div class="main-img"><img src="<?php echo $Img ?>" alt="Category"></div>
                  <div class="thumblist">
                    <img src="<?php echo $Img ?>" alt="Category">
                    <img src="<?php echo $Img ?>" alt="Category">
                  </div>
                </div></a>
              <div class="card-body text-center">
                <h4 class="card-title"><?php echo $row->CategoriaDescripcion ?></h4>
                <p class="text-muted">Starting from $49.99</p><a class="btn btn-outline-primary btn-sm" href="../Categorias/index.php?id=<?php echo $row->ProductoKey ?>">Ver Productos</a>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
        <div class="text-center"><a class="btn btn-outline-secondary margin-top-none" href="../Categorias/index.php?id=1">Todas Categorias</a></div>
      </section>
      <!-- Promo #1-->
      <section class="container-fluid padding-top-3x">
        <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-6 mb-30">
            <div class="rounded bg-faded position-relative padding-top-3x padding-bottom-3x"><span class="product-badge text-danger" style="top: 24px; left: 24px;"><!--Limited Offer--></span>
              <div class="text-center">
                <h3 style="color:#764148" class="h2 text-normal mb-1">Nuevo</h3>
                <h3 class="h2 text-normal mb-1"></h3>
                <h2 class="h2  text-bold mb-2 text-danger">Productos más vendidos</h2>
                <h4 style="color:#764148" class="h3 text-normal mb-4">Producto a precio rebajado</h4>
                <div class="countdown mb-3" data-date-time="12/30/2019 12:00:00">
                  <div class="item" >
                   <div class="days" style="background-color:#764148; color:white;">00</div><span class="days_ref" style="color:#764148">Días</span> 
                  </div>
                  <div class="item">
                    <div class="hours" style="background-color:#764148; color:white;">00</div><span class="hours_ref" style="color:#764148">Horas</span> 
                  </div>
                  <div class="item">
                    <div class="minutes" style="background-color:#764148; color:white;">00</div><span class="minutes_ref" style="color:#764148">Minutos</span> 
                  </div>
                  <div class="item">
                    <div class="seconds" style="background-color:#764148; color:white;">00</div><span class="seconds_ref" style="color:#764148">Segundos</span> 
                  </div>
                </div><br><a class="btn btn-danger margin-bottom-none" href="#">Ver Ofertas</a> 
              </div>
            </div>
          </div>
          <div class="col-xl-5 col-lg-6 mb-30" style="min-height: 270px;">
            <div class="img-cover rounded" style="background-image: url(../../public/img/Banners/Jaladeras.jpg);"></div>
          </div>
        </div>
      </section>
      <!-- Promo #2-->
      <section class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-xl-10 col-lg-12">
            <div class="fw-section rounded padding-top-4x padding-bottom-4x" style="background-image: url(../../public/img/Banners/mapadly.jpg);"><span class="overlay rounded" style="opacity: .2;"></span>
              <div class="text-center">
                <h3 class="display-4 text-normal text-white text-shadow mb-1">&nbsp;<br/></h3>
                <h3 class="display-4 text-normal text-white text-shadow mb-1">&nbsp;<br/></h3>
                <h2 class="display-2 text-bold text-white text-shadow">&nbsp;<br/></h2>
                <h4 class="d-inline-block h2 text-normal text-white text-shadow border-default border-left-0 border-right-0 mb-4">&nbsp;</h4><br>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Featured Products Carousel-->
      <section class="container padding-top-3x padding-bottom-3x">
        <h3 class="text-center mb-30">Productos Destacados</h3>
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
          <?php 
            $ProductoController = new ProductoController();
            $ProductoController->filter = "";
            $ProductoController->order = " ORDER BY RAND() LIMIT 8";
            $ResultProductoController = $ProductoController->get();

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
      </section>
      <!-- Product Widgets-->
      <section class="container padding-bottom-2x">
        <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="widget widget-featured-products">
              <h3 class="widget-title">Más vendidos</h3>
              <?php 
                $ProductoController = new ProductoController();
                $ProductoController->filter = "";
                $ProductoController->order = " ORDER BY RAND() LIMIT 4";
                $ResultProductoController = $ProductoController->get();

              foreach ($ResultProductoController->records as $key => $row): 
                $Imgpath = '../../public/img/Productos/'.$row->Img.'.jpg';
                $Img = file_exists($Imgpath) ? $Imgpath : $_SESSION['Ecommerce-ImgNotFound'];
              ?>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><img src="<?php echo $Img ?>" alt="Product"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><?php echo $row->Descripcion ?></a></h4><span class="entry-meta">$<?php echo $row->Precio ?></span>
                </div>
              </div>
              <?php endforeach ?>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="widget widget-featured-products">
              <h3 class="widget-title">Nuevos</h3>
              <?php 
                $ProductoController = new ProductoController();
                $ProductoController->filter = "";
                $ProductoController->order = " ORDER BY RAND() LIMIT 4";
                $ResultProductoController = $ProductoController->get();

              foreach ($ResultProductoController->records as $key => $row): 
                $Imgpath = '../../public/img/Productos/'.$row->Img.'.jpg';
                $Img = file_exists($Imgpath) ? $Imgpath : $_SESSION['Ecommerce-ImgNotFound'];
              ?>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><img src="<?php echo $Img ?>" alt="Product"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><?php echo $row->Descripcion ?></a></h4><span class="entry-meta">$<?php echo $row->Precio ?></span>
                </div>
              </div>
              <?php endforeach ?>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="widget widget-featured-products">
              <h3 class="widget-title">Mejor valorados</h3>
              <?php 
                $ProductoController = new ProductoController();
                $ProductoController->filter = "";
                $ProductoController->order = " ORDER BY RAND() LIMIT 4";
                $ResultProductoController = $ProductoController->get();

              foreach ($ResultProductoController->records as $key => $row): 
                $Imgpath = '../../public/img/Productos/'.$row->Img.'.jpg';
                $Img = file_exists($Imgpath) ? $Imgpath : $_SESSION['Ecommerce-ImgNotFound'];
              ?>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><img src="<?php echo $Img ?>" alt="Product"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="../Productos/index.php?codigo=<?php echo $row->Codigo ?>"><?php echo $row->Descripcion ?></a></h4><span class="entry-meta">$<?php echo $row->Precio ?></span>
                </div>
              </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>
      </section>
      <!-- Popular Brands-->
      <section class="bg-faded padding-top-3x padding-bottom-3x">
        <div class="container">
          <h3 class="text-center mb-30 pb-2">Marcas Populares</h3>
          <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:6}} }">
            <?php 
            if (!class_exists("FileController")) {
              include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/File/File.Controller.php';
            }
              $FileController = new FileController();
              $FileController->filter = "WHERE t11_f004 = 'LOGO.MARCAS' ";
              $FileController->order = "";
              $FileController = $FileController->get(false);
              foreach ($FileController->records as $key => $File) {
           ?>
            <img class="d-block w-110 opacity-75 m-auto" src="<?php echo $File->Path ?>" alt="<?php echo $File->Descripcion ?>">
          <?php } ?>
          </div>
        </div>
      </section>
      <!-- Services-->
      <section class="container padding-top-3x padding-bottom-2x">
        <div class="row">
          <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="../../public/plantilla/img/services/01.png" alt="Shipping">
            <h6>Free Worldwide Shipping</h6>
            <p class="text-muted margin-bottom-none">Free shipping for all orders over $100</p>
          </div>
          <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="../../public/plantilla/img/services/02.png" alt="Money Back">
            <h6>Money Back Guarantee</h6>
            <p class="text-muted margin-bottom-none">We return money within 30 days</p>
          </div>
          <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="../../public/plantilla/img/services/03.png" alt="Support">
            <h6>24/7 Customer Support</h6>
            <p class="text-muted margin-bottom-none">Friendly 24/7 customer support</p>
          </div>
          <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="../../public/plantilla/img/services/04.png" alt="Payment">
            <h6>Secure Online Payment</h6>
            <p class="text-muted margin-bottom-none">We posess SSL / Secure Certificate</p>
          </div>
        </div>
      </section>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Scripts.php'; 
    ?>
  </body>
</html>
<?php   
  unset($ProductoController);
  unset($ResultProductoController);
  }
 ?>