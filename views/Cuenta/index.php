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
            <h1>Mi cuenta</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="../Home/">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li><a href="#">Cuenta</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Mi cuenta</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2">
        <div class="row">
          <div class="col-lg-4">
            <aside class="user-info-wrapper">
              <div class="user-cover" style="background-image: url(../../public/plantilla/img/account/user-cover-img.jpg);">
                <!-- <div class="info-label" data-toggle="tooltip" title="You currently have 290 Reward Points to spend"><i class="icon-medal"></i>290 points</div> -->
              </div>
              <div class="user-info">
                <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="../../public/plantilla/img/account/user-ava.jpg" alt="User"></div>
                <div class="user-data">
                  <h4><?php echo $_SESSION['Ecommerce-ClienteNombre'] ?></h4><span>Unido desde <?php echo $_SESSION['Ecommerce-ClienteFechaRegistro'] ?></span>
                </div>
              </div>
            </aside>
            <nav class="list-group">
              <a class="list-group-item <?php echo $_GET['menu'] == 1 ? 'active' : '' ?>" href="../Cuenta/index.php?menu=1"><i class="icon-head"></i>Perfil</a>
              <a class="list-group-item <?php echo $_GET['menu'] == 2 ? 'active' : '' ?>" href="../Cuenta/index.php?menu=2"><i class="icon-bag"></i>Pedidos</a>
              <a class="list-group-item <?php echo $_GET['menu'] == 3 ? 'active' : '' ?>" href="../Cuenta/index.php?menu=3"><i class="icon-map"></i>Datos de envió</a>
              <a class="list-group-item <?php echo $_GET['menu'] == 4 ? 'active' : '' ?>" href="../Cuenta/index.php?menu=4"><i class="icon-heart"></i>Datos de Facturación</a>
            </nav>
          </div>
          <div class="col-lg-8">
            <?php 
              switch ($_GET['menu']) {
                case 1:
                  include $_SERVER['DOCUMENT_ROOT'].'/views/Cuenta/Perfil/index.php';                  
                  break;
                case 2:
                  include $_SERVER['DOCUMENT_ROOT'].'/views/Cuenta/Pedidos/index.php';                  
                  break;
                case 3:
                  include $_SERVER['DOCUMENT_ROOT'].'/views/Cuenta/DatosEnvio/index.php';                  
                  break;
                case 4:
                  include $_SERVER['DOCUMENT_ROOT'].'/views/Cuenta/DatosFacturacion/index.php';                  
                  break;
                default:
                  # code...
                  break;
              }

             ?>
          </div>
          
        </div>
      </div>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Scripts.php'; 
    ?>
    <script type="text/javascript" src="../../public/scripts/Login/login.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Cuenta/datos_envio.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Cuenta/datos_facturacion.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Cuenta/pedidos.js?id=<?php echo rand() ?>"></script>
  </body>
</html>

<?php 

  unset($Cliente);
  unset($response);

 ?>