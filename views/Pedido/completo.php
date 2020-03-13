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
            <h1>Checkout</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="../Home/">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Checkout</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2">
        <div class="card text-center">
          <div class="card-body padding-top-2x">
            <h3 class="card-title">¡Gracias por su orden!</h3>
            <p class="card-text">Su pedido se ha realizado y se procesará lo antes posible.</p>
            <!-- <p class="card-text">Make sure you make note of your order number, which is <span class="text-medium">34VB5540K83</span></p> -->
            <p class="card-text">En breve recibirá un correo electrónico con la confirmación de su pedido. 
              <u>Tu puedes ahora:</u>
            </p>
            <div class="padding-top-1x padding-bottom-1x"><a class="btn btn-outline-secondary" href="shop-grid-ls.html">Go Back Shopping</a><a class="btn btn-outline-primary" href="order-tracking.html"><i class="icon-location"></i>&nbsp;Track order</a></div>
          </div>
        </div>
      </div>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Scripts.php'; 
    ?>
  </body>
</html>