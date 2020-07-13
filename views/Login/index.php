<?php 
  @session_start();
  if(isset($_SESSION['Ecommerce-ClienteKey'])){
    header('Location: ../Home');
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
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Login / Registro</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="../Home/">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li><a href="#">Cuenta</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Login / Registro</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2">
        <div class="row">
          <div class="col-md-6">
            <div id="alert-login"></div>
            <form class="login-box" id="form-login">
              <div class="text-center mb-5">
                <img src="../../public/plantilla/img/logo/logo.png">
              </div>
              <input class="form-control" type="hidden" id="ActionLogin" name="ActionLogin" value="true">
              <input class="form-control" type="hidden" id="Action" name="Action" value="login">
              <div class="form-group input-group">
                <input class="form-control" type="email" id="Email" name="Email" placeholder="Correo eléctronico" required autocomplete="off"><span class="input-group-addon"><i class="icon-mail"></i></span>
              </div>
              <div class="form-group input-group">
                <input class="form-control" type="password" id="Password" name="Password" placeholder="Contraseña" required autocomplete="new-password"><span class="input-group-addon"><i class="icon-lock"></i></span>
              </div>
              <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="remember_me" checked>
                  <label class="custom-control-label" for="remember_me">Recuerdame</label>
                </div><a class="navi-link" href="account-password-recovery.html">Olvidaste tu contraseña?</a>
              </div>
              <div class="text-center text-sm-right">
                <button class="btn btn-primary margin-bottom-none" type="button" onclick="Login(this)">Login</button>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <div id="alert-registro-actualizacion"></div>
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">Aún no tienes cuenta? Registrate</h3>
            <p>El registro solo te llevara algunos minutos para obtener el control de tus ordenes.</p>
            <form class="row" id="form-registro">
              <input class="form-control" type="hidden" id="ActionCliente" name="ActionCliente" value="true">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-fn">Nombre</label>
                  <input class="form-control" type="hidden" id="Action" name="Action" value="create">
                  <input class="form-control" type="hidden" id="ClienteKey" name="ClienteKey" value="0">
                  <input class="form-control" type="text" id="Nombre" name="Nombre" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-ln">Apellido</label>
                  <input class="form-control" type="text" id="Apellido" name="Apellido" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-email">Correo eléctronico</label>
                  <input class="form-control" type="email" id="Correo" name="Correo" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-phone">Número de telefono</label>
                  <input class="form-control" type="text" id="Telefono" name="Telefono" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass">Contraseña</label>
                  <input class="form-control" type="password" id="ClientePassword" name="ClientePassword" autocomplete="new-password">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass-confirm">Confirmar contraseña</label>
                  <input class="form-control" type="password" id="ClientePasswordConfirm" name="ClientePasswordConfirm" autocomplete="new-password">
                </div>
              </div>
              <div class="col-12 text-center text-sm-right">
                <button class="btn btn-primary margin-bottom-none" type="button" onclick="Registro(this)">Registrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Scripts.php'; 
    ?>
    <script type="text/javascript" src="../../public/scripts/Login/login.js?id=<?php echo rand() ?>"></script>
  </body>
</html>
<?php } ?>