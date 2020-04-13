 <html> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Head.php'; ?>
  </head>
  <body>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Header.php'; 

      if (!class_exists('CategoriaController')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Catalogos/Categoria.Controller.php';
      }if (!class_exists('ProductoController')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Productos/Producto.Controller.php';
      }

     ?>
    <!-- Shop Filters Modal-->
    <div class="modal fade" id="modalShopFilters" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <?php include 'ListMenu.php'; ?>
          </div>
        </div>
      </div>
    </div>
        <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Shop Grid Left Sidebar</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="../Home/">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Shop Grid Left Sidebar</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-1">
        <div class="row">
          <!-- Products-->
          <div class="col-xl-9 col-lg-8 order-lg-2">
            <!-- Products Grid-->
            <div class="isotope-grid cols-3 mb-2">
              <div class="gutter-sizer"></div>
              <div class="grid-sizer"></div>
              <?php include 'List.php'; ?>
            </div>
           <!--  Pagination
           <nav class="pagination">
             <div class="column">
               <ul class="pages">
                 <li class="active"><a href="#">1</a></li>
                 <li><a href="#">2</a></li>
                 <li><a href="#">3</a></li>
                 <li><a href="#">4</a></li>
                 <li>...</li>
                 <li><a href="#">12</a></li>
               </ul>
             </div>
             <div class="column text-right hidden-xs-down"><a class="btn btn-outline-secondary btn-sm" href="#">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
           </nav> -->
          </div>
          <!-- Sidebar          -->
          <div class="col-xl-3 col-lg-4 order-lg-1">
            <button class="sidebar-toggle position-left" data-toggle="modal" data-target="#modalShopFilters"><i class="icon-layout"></i></button>
            <aside class="sidebar sidebar-offcanvas">
              <?php include 'ListMenu.php'; ?>
            </aside>
          </div>
        </div>
      </div>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Footer.php'; 
      include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/views/Partials/Scripts.php'; 
    ?>
  </body>
</html>