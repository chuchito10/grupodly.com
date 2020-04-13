<!-- Site Footer-->
<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <!-- Contact Info-->
        <section class="widget widget-light-skin">
          <h3 class="widget-title">CONTACTANOS</h3>
          <p class="text-white">Teléfono:44 24 76 08 82</p>
          <p class="text-white">Horarios</p>
          <ul class="list-unstyled text-sm text-white">
            <li><span class="opacity-50">L-V:</span>7:00 am - 9:00 pm</li>
            <li><span class="opacity-50">Sábado:</span>8:00 am - 6.00 pm</li>
            <li><span class="opacity-50">Domingo:</span>9:00 am - 3:30 pm</li>
          </ul>
          <p><a class="navi-link-light" href="#">support@unishop.com</a></p><a class="social-button shape-circle sb-facebook sb-light-skin" href="#"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter sb-light-skin" href="#"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram sb-light-skin" href="#"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus sb-light-skin" href="#"><i class="socicon-googleplus"></i></a>
        </section>
      </div>
      <div class="col-lg-3 col-md-6">
        <section class="widget widget-links widget-light-skin">
          <h3 class="widget-title">Categorias</h3>
          <ul>
            <?php 
              if (!class_exists("ProductoController")) {
                include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Productos/Producto.Controller.php';
              }

              $ProductoController = new ProductoController();
              $ProductoController->filter = "";
              $ProductoController->order = " ORDER BY RAND() LIMIT 5";
              $ResultProductoController = $ProductoController->get(false);

            foreach ($ResultProductoController->records as $key => $row): 
              $Imgpath = '../../public/img/Productos/'.$row->Img.'.jpg';
              $Img = file_exists($Imgpath) ? $Imgpath : $_SESSION['Ecommerce-ImgNotFound'];
            ?>
            <li><a href="../Categorias/index.php?id=<?php echo $row->ProductoKey ?>"><?php echo $row->CategoriaDescripcion ?></a></li>
            <?php endforeach ?>
          </ul>
        </section>
      </div>
      <div class="col-lg-3 col-md-6">
        <!-- About Us-->
        <section class="widget widget-links widget-light-skin">
          <h3 class="widget-title">ACERCA DE NOSOTROS</h3>
          <ul>
            <li><a href="#">Historia</a></li>
            <li><a href="#">Servicios</a></li>
          </ul>
        </section>
      </div>
      <div class="col-lg-3 col-md-6">
        <!-- Account / Shipping Info-->
        <section class="widget widget-links widget-light-skin">
          <h3 class="widget-title">INFORMACIÓN DE LA COMPRA</h3>
          <ul>
            <li><a href="#">Políticas de envíos</a></li>
            <li><a href="#">Política de devolución y reemplazo</a></li>
          </ul>
        </section>
      </div>
    </div>
    <hr class="hr-light mt-2 margin-bottom-2x">
    <div class="row">
      <div class="col-md-7 padding-bottom-1x">
        <!-- Payment Methods-->
        <div class="margin-bottom-1x" style="max-width: 615px;"><img src="../../public/plantilla/img/payment_methods.png" alt="Payment Methods">
        </div>
      </div>
      <div class="col-md-5 padding-bottom-1x">
        <div class="margin-top-1x hidden-md-up"></div>
        <!--Subscription-->
        <form class="subscribe-form" action="//rokaux.us12.list-manage.com/subscribe/post?u=c7103e2c981361a6639545bd5&amp;amp;id=1194bb7544" method="post" target="_blank" novalidate>
          <div class="clearfix">
            <div class="input-group input-light">
              <input class="form-control" type="email" name="EMAIL" placeholder="Your e-mail"><span class="input-group-addon"><i class="icon-mail"></i></span>
            </div>
            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true">
              <input type="text" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
            </div>
            <button class="btn btn-primary" type="submit"><i class="icon-check"></i></button>
          </div><span class="form-text text-sm text-white opacity-50">Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.</span>
        </form>
      </div>
    </div>
    <!-- Copyright-->
    <p class="footer-copyright">© All rights reserved. Made with &nbsp;<i class="icon-heart text-danger"></i><a href="http://rokaux.com/" target="_blank"> &nbsp;by rokaux</a></p>
  </div>
</footer>
</div>
<!-- Photoswipe container-->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
<div class="pswp__bg"></div>
<div class="pswp__scroll-wrap">
  <div class="pswp__container">
    <div class="pswp__item"></div>
    <div class="pswp__item"></div>
    <div class="pswp__item"></div>
  </div>
  <div class="pswp__ui pswp__ui--hidden">
    <div class="pswp__top-bar">
      <div class="pswp__counter"></div>
      <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
      <button class="pswp__button pswp__button--share" title="Share"></button>
      <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
      <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
      <div class="pswp__preloader">
        <div class="pswp__preloader__icn">
          <div class="pswp__preloader__cut">
            <div class="pswp__preloader__donut"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
      <div class="pswp__share-tooltip"></div>
    </div>
    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
    <div class="pswp__caption">
      <div class="pswp__caption__center"></div>
    </div>
  </div>
</div>
</div>
<!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
<!-- Backdrop-->
<div class="site-backdrop"></div>