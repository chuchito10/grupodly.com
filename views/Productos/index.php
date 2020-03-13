 <html> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Head.php'; ?>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Header.php'; ?> 
<!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Single Product</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="../Home">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li><a href="#">Shop</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Single Product</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-1">
        <div class="row">
          <!-- Poduct Gallery-->
          <div class="col-md-6">
            <div class="product-gallery"><!-- <span class="product-badge text-danger">30% Off</span> -->
              <div class="gallery-wrapper">
                <div class="gallery-item video-btn text-center"><a href="#" data-toggle="tooltip" data-type="video" data-video="&lt;div class=&quot;wrapper&quot;&gt;&lt;div class=&quot;video-wrapper&quot;&gt;&lt;iframe class=&quot;pswp__video&quot; width=&quot;960&quot; height=&quot;640&quot; src=&quot;//www.youtube.com/embed/B81qd2v6alw?rel=0&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;&lt;/div&gt;&lt;/div&gt;" title="Watch video"></a></div>
              </div>
              <div class="product-carousel owl-carousel gallery-wrapper">
                <div class="gallery-item" data-hash="one"><a href="../../public/plantilla/img/shop/single/01.jpg" data-size="1000x667"><img src="../../public/plantilla/img/shop/single/01.jpg" alt="Product"></a></div>
                <div class="gallery-item" data-hash="two"><a href="../../public/plantilla/img/shop/single/02.jpg" data-size="1000x667"><img src="../../public/plantilla/img/shop/single/02.jpg" alt="Product"></a></div>
                <div class="gallery-item" data-hash="three"><a href="../../public/plantilla/img/shop/single/03.jpg" data-size="1000x667"><img src="../../public/plantilla/img/shop/single/03.jpg" alt="Product"></a></div>
                <div class="gallery-item" data-hash="four"><a href="../../public/plantilla/img/shop/single/04.jpg" data-size="1000x667"><img src="../../public/plantilla/img/shop/single/04.jpg" alt="Product"></a></div>
                <div class="gallery-item" data-hash="five"><a href="../../public/plantilla/img/shop/single/05.jpg" data-size="1000x667"><img src="../../public/plantilla/img/shop/single/05.jpg" alt="Product"></a></div>
              </div>
              <ul class="product-thumbnails">
                <li class="active"><a href="#one"><img src="../../public/plantilla/img/shop/single/th01.jpg" alt="Product"></a></li>
                <li><a href="#two"><img src="../../public/plantilla/img/shop/single/th02.jpg" alt="Product"></a></li>
                <li><a href="#three"><img src="../../public/plantilla/img/shop/single/th03.jpg" alt="Product"></a></li>
                <li><a href="#four"><img src="../../public/plantilla/img/shop/single/th04.jpg" alt="Product"></a></li>
                <li><a href="#five"><img src="../../public/plantilla/img/shop/single/th05.jpg" alt="Product"></a></li>
              </ul>
            </div>
          </div>
          <?php 
            if (!class_exists('ProductoController')) {
              include $_SERVER['DOCUMENT_ROOT'].'/models/Productos/Producto.Controller.php';
            }
            $ProductoController = new ProductoController();
            $ProductoController->filter = " WHERE t06_f001 = ".$_GET['codigo']." ";
            $ProductoController->order = " ";
            $ResultProducto = $ProductoController->get(false);
            if ($ResultProducto->count > 0) {
              $ResultProducto = $ResultProducto->records[0];
           ?>
          <!-- Product Info-->
          <div class="col-md-6">
            <?php 
              if (!class_exists('ComentariosController')) {
                include $_SERVER['DOCUMENT_ROOT'].'/models/Productos/Comentarios.Controller.php';
              }
              $ComentariosController = new ComentariosController();
              $ResultComentarios = $ComentariosController->getProductoComentarios($ResultProducto->ProductoKey, false);
              if ($ResultComentarios->count > 0 ) {
                $ResultComentarios = $ResultComentarios->records[0];
             ?>
             <div class="padding-top-2x mt-2 hidden-md-up"></div>
              <div class="rating-stars">
              <?php
                for ($i=0; $i < 5; $i++) { 
                  if ((int)$ResultComentarios->Ranking > $i) {                      
               ?>
                <i class="icon-star filled"></i>
               <?php }else{ ?>
                <i class="icon-star"></i>
                <?php }
                } ?>
              </div>
            <span class="text-muted align-middle">&nbsp;&nbsp; <?php echo $ResultComentarios->Ranking ?> | <?php echo $ResultComentarios->TotalComentarios ?> clientes comentaron</span>
            
          <?php }else{ ?>
            <div class="padding-top-2x mt-2 hidden-md-up"></div>
              <div class="rating-stars">
                <i class="icon-star"></i>
                <i class="icon-star"></i>
                <i class="icon-star"></i>
                <i class="icon-star"></i>
                <i class="icon-star"></i>
              </div>
            <span class="text-muted align-middle">&nbsp;&nbsp; 0 | 0</span>
          <?php } ?>

            <h2 class="padding-top-1x text-normal"><?php echo $ResultProducto->Descripcion ?></h2><span class="h2 d-block">
              <!-- <del class="text-muted text-normal">$68.00</del>&nbsp; --> $<?php echo $ResultProducto->Precio ?></span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta voluptatibus quos ea dolore rem, molestias laudantium et explicabo assumenda fugiat deserunt in, facilis laborum excepturi aliquid nobis ipsam deleniti aut? Aliquid sit hic id velit qui fuga nemo suscipit obcaecati. Officia nisi quaerat minus nulla saepe aperiam sint possimus magni veniam provident.</p>
            <form class="row margin-top-1x">
              <input type="hidden" class="form-control" id="ProductoKey-<?php echo $ResultProducto->Codigo ?>" name="ProductoKey-<?php echo $ResultProducto->Codigo ?>" value="<?php echo $ResultProducto->ProductoKey ?>">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="quantity">Cantidad</label>
                  <input type="text" class="form-control" id="ProductoCantidad-<?php echo $ResultProducto->Codigo ?>" name="ProductoCantidad-<?php echo $ResultProducto->Codigo ?>">
                </div>
              </div>
            </form>
            <!-- <div class="pt-1 mb-2"><span class="text-medium">SKU:</span> #21457832</div>
            <div class="padding-bottom-1x mb-2"><span class="text-medium">Categories:&nbsp;</span><a class="navi-link" href="#">Men’s shoes,</a><a class="navi-link" href="#"> Snickers,</a><a class="navi-link" href="#"> Sport shoes</a></div> -->
            <hr class="mb-3">
            <div class="d-flex flex-wrap justify-content-between">
              <!-- <div class="entry-share mt-2 mb-2"><span class="text-muted">Share:</span>
                <div class="share-links"><a class="social-button shape-circle sb-facebook" href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus" href="#" data-toggle="tooltip" data-placement="top" title="Google +"><i class="socicon-googleplus"></i></a></div>
              </div> -->
              <div class="sp-buttons mt-2 mb-2">
                <!-- <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button> -->
                <button class="btn btn-primary" code="<?php echo $ResultProducto->Codigo ?>" onclick="agregarToCarrito(this)"><i class="icon-bag"></i> Añadir carrito</button>
              </div>
            </div>
          </div>
        </div>
        <?php
           } 
           include $_SERVER['DOCUMENT_ROOT'].'/views/Productos/Informacion/index.php';
        ?>
        <!-- Related Products Carousel--
        <h3 class="text-center padding-top-2x mt-2 padding-bottom-1x">You May Also Like</h3>
        <!-- Carousel--
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
          <!-- Product--
          <div class="grid-item">
            <div class="product-card">
              <div class="product-badge text-danger">22% Off</div><a class="product-thumb" href="shop-single.html"><img src="../../public/plantilla/img/shop/products/09.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Rocket Dog</a></h3>
              <h4 class="product-price">
                <del>$44.95</del>$34.99
              </h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product--
          <div class="grid-item">
            <div class="product-card">
                <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i>
                </div><a class="product-thumb" href="shop-single.html"><img src="../../public/plantilla/img/shop/products/03.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Oakley Kickback</a></h3>
              <h4 class="product-price">$155.00</h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product--
          <div class="grid-item">
            <div class="product-card"><a class="product-thumb" href="shop-single.html"><img src="../../public/plantilla/img/shop/products/12.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Vented Straw Fedora</a></h3>
              <h4 class="product-price">$49.50</h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product--
          <div class="grid-item">
            <div class="product-card">
                <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i>
                </div><a class="product-thumb" href="shop-single.html"><img src="../../public/plantilla/img/shop/products/11.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Top-Sider Fathom</a></h3>
              <h4 class="product-price">$90.00</h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product--
          <div class="grid-item">
            <div class="product-card"><a class="product-thumb" href="shop-single.html"><img src="../../public/plantilla/img/shop/products/04.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Waist Leather Belt</a></h3>
              <h4 class="product-price">$47.00</h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product--
          <div class="grid-item">
            <div class="product-card">
              <div class="product-badge text-danger">50% Off</div><a class="product-thumb" href="shop-single.html"><img src="../../public/plantilla/img/shop/products/01.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Unionbay Park</a></h3>
              <h4 class="product-price">
                <del>$99.99</del>$49.99
              </h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Scripts.php'; 
    ?>
    <script type="text/javascript" src="../../public/scripts/Productos/reviews.js?id=<?php echo rand() ?>"></script>
  </body>
</html>
<?php 
  unset($ProductoController);
  unset($ResultProducto);
  unset($ComentariosController);
  unset($ResultComentarios);
 ?>