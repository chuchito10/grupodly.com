<?php 
  @session_start();
  if ($_SESSION['Ecommerce-PedidoTotal'] <= 0) {
    header('Location: ../Carrito');
  }else if(!isset($_SESSION['Ecommerce-ClienteKey'])){
    $_SESSION['Ecommerce-PedidoPagar'] = true;
    header('Location: ../Login');
  }else{
    $_SESSION['Ecommerce-PedidoPagar'] = false;
 ?>
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
        <div class="row">
          <!-- Checkout Adress-->
          <div class="offset-lg-1 col-lg-10 col-md-12">
            <div class="checkout-steps">
              <a class="process" id="process-4" number="4" onclick="addViewCheckout(this)">
                <span class="angle"></span>4. Resumen
              </a>
              <a class="process" id="process-3" number="3" onclick="addViewCheckout(this)">
                <span class="angle"></span>3. Pago
              </a>
              <a class="process" id="process-2" number="2" onclick="addViewCheckout(this)">
                <span class="angle"></span>2. Otro
              </a>
              <a class="process active" id="process-1" number="1" onclick="addViewCheckout(this)">
                <span class="angle"></span>1. Datos de envió
              </a>
            </div>

            <div id="PartialCheckout-1" class="PartialCheckout">
              <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Checkout/datos_envio.php'; ?>
            </div>
            <div id="PartialCheckout-2" class="PartialCheckout" style="display: none">
              <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Checkout/otro.php'; ?>
            </div>
            <div id="PartialCheckout-3" class="PartialCheckout" style="display: none">
              <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Checkout/pago.php'; ?>
            </div>
            <div id="PartialCheckout-4" class="PartialCheckout" style="display: none">
              <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Checkout/resumen.php'; ?>
            </div>
          </div>
        </div>
      </div>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Scripts.php'; 
    ?>
    <script type="text/javascript" src="../../public/plugins/OpenPay/js/jquery.min.js"></script>
    <script type="text/javascript" src="../../public/plugins/OpenPay/js/openpay.v1.min.js"></script>
    <script type='text/javascript' src="../../public/plugins/OpenPay/js/openpay-data.v1.min.js"></script>
    <script type="text/javascript" src="../../public/scripts/Checkout/index.js?id=<?php echo rand() ?>"></script>
  </body>
</html>
<?php 
  unset($DatosEnvioController);
  unset($DatosFacturacion);
  unset($response);
  }
 ?>