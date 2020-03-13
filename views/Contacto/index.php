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
            <h1>Contacto</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="../Home/">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Contacto</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2">
        <div class="row">
          <div class="col-md-12">
            <div class="display-3 text-muted opacity-75 mb-30">Centro de contacto</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 ">
            <div class="card mb-30">
               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15050.533353605817!2d-99.2065313!3d19.4282421!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xca7e9b8e9149aac2!2sGoogle!5e0!3m2!1ses!2smx!4v1580339175295!5m2!1ses!2smx" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
              <div class="card-body">
                <ul class="list-icon">
                  <li><i class="icon-map-pin text-muted"></i>Calle Montes Urales 445, Lomas - Virreyes, Lomas de Chapultepec, Miguel Hidalgo, 11000 Ciudad de México, CDMX</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <hr class="margin-top-1x padding-top-2x">
            <h5><?php #echo nl2br($response->ContactoDescripcion) ?></h5>
            <ul class="list-icon">
              <li> <i class="icon-phone text-muted"></i><?php #echo $response->ContactoTelefono;?></li>
              <li> <i class="icon-phone text-muted"></i><?php #echo $response->ContactoTelefono_1;?></li>
              <li> 
                <i class="icon-mail text-muted"></i>
                <a class="navi-link" href="mailto:<?php #echo $response->ContactoEmail;?>"><?php #echo $response->ContactoEmail;?></a>
              </li>
              <li> <i class="icon-clock text-muted"></i><?php #echo $response->ContactoHorario; ?></li>
              <li> <i class="icon-globe text-muted"></i><?php #echo $response->ContactoPagina; ?></li>
            </ul>
          </div>
        </div>
      </div>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Scripts.php'; 
    ?>
  </body>
</html>