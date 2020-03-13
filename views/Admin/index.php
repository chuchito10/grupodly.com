 <html> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Head.php'; ?>
    <!-- dataTables.foundation.min CSS -->
    <link rel="stylesheet" type="text/css" href="../../public/plugins/DataTables/css/dataTables.foundation.min.css">
    <!-- fileinput-rtl.min CSS -->
    <link rel="stylesheet" type="text/css" href="../../public/plugins/file-input/css/fileinput.min.css">
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Header.php'; ?>    
    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Alerts</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="../Home/">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li><a href="accordion.html">Components</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Alerts</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2">
        <div class="row">
          <div class="col-lg-9 col-md-8 order-md-2">
            <?php 

              if (isset($_GET['menu'])) {
                switch ($_GET['menu']) {
                  case 1:
                    include $_SERVER['DOCUMENT_ROOT'].'/views/Admin/Productos/index.php';
                    break;
                  default:
                    echo "¡No se encuentra la opción solicitada!";
                    break;
                }
              }else{
                echo "¡Error!";
              }

             ?>
          </div>

          <div class="col-lg-3 col-md-4 order-md-1">
            <!-- Side Menu-->
            <div class="padding-top-3x hidden-md-up"></div>
            <div class="card rounded-bottom-0" data-filter-list="#components-list">
              <div class="card-body pb-3">
                <div class="widget mb-4">
                  <div class="input-group form-group"><span class="input-group-btn">
                      <button class="btn" type="submit" disabled><i class="icon-search"></i></button></span>
                    <input class="form-control" type="text" placeholder="Search components">
                  </div>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input class="custom-control-input" type="radio" id="filter-all" name="compFilter" value="all" checked>
                  <label class="custom-control-label" for="filter-all">ALL</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input class="custom-control-input" type="radio" id="filter-af" name="compFilter" value="af">
                  <label class="custom-control-label" for="filter-af">A-F</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input class="custom-control-input" type="radio" id="filter-gm" name="compFilter" value="gm">
                  <label class="custom-control-label" for="filter-gm">G-M</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input class="custom-control-input" type="radio" id="filter-pt" name="compFilter" value="pt">
                  <label class="custom-control-label" for="filter-pt">P-T</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input class="custom-control-input" type="radio" id="filter-vw" name="compFilter" value="vw">
                  <label class="custom-control-label" for="filter-vw">V-W</label>
                </div>
              </div>
            </div>
              <nav class="list-group" id="components-list">
                <a class="list-group-item list-group-item-action" href="../Admin/index.php?menu=1" data-filter-item="pt">Producto</a>
              </nav>
          </div>
        </div>
      </div>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/views/Partials/Scripts.php'; 
    ?>
    <!-- fileinput JS -->
    <script type="text/javascript" src="../../public/plugins/file-input/js/fileinput.min.js"></script>
    <!-- fileinput locales español JS -->
    <script type="text/javascript" src="../../public/plugins/file-input/js/locales/es.js"></script>
    <!-- fileinput theme bootstrap 4 JS  -->
    <script type="text/javascript" src="../../public/plugins/file-input/themes/fas/theme.min.js"></script>
    <!-- Datatable JS -->
    <script type="text/javascript" src="../../public/plugins/DataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../public/plugins/DataTables/js/dataTables.foundation.min.js"></script>
    <!-- Producto JS -->
    <script type="text/javascript" src="../../public/scripts/Admin/Producto.js?id=<?php echo rand() ?>"></script>
  </body>
</html>