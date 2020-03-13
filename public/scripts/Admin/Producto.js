GlobalInitialDatatableSimple('TableProductos')
/**
 * Listar producto
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ListProductos = function(Elem) {
  ajaxViews('../../views/Admin/Productos/List.php', 'POST', 'HTML', {}, 
  function(response){
    document.getElementById('ListCatalogoProductos').innerHTML = response
    GlobalInitialDatatableSimple('TableProductos')
  })
}
/**
 * Nuevo registro producto
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var nuevoRegistroProducto = function(Elem) {
  ajax_('../../models/Productos/Producto.Controller.php', 'POST', 'JSON', $('#form-producto').serialize(), 
  function(response){
    if (!response.error) {
      Alerts('alert-producto', response.typeError, response.message)
      // setTimeout(ListProductos, 5000)
      ListProductos()
      GlobalCloseModal('modal-producto')
    }else{
      Alerts('alert-producto', 'danger', response.message)
    }
  })
}
/**
 * Nuevo registro producto
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var mostrarFormProducto = function() {
  ajaxViews('../../views/Admin/Productos/Create.php', 'POST', 'HTML', {}, 
  function(response){
    GlobalOpenModal('modal-producto')
    document.getElementById('modal-body-producto').innerHTML = response
    fileInput()
  })
}
/**
 * Nuevo registro producto
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var EditarFormProducto = function(Elem) {
  ajaxViews('../../views/Admin/Productos/Create.php', 'POST', 'HTML', { ProductoKey: Elem.getAttribute('ProductoKey') }, 
  function(response){
    GlobalOpenModal('modal-producto')
    document.getElementById('modal-body-producto').innerHTML = response
    // ImgPrincipal(Elem)
    fileInput()
  })
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ImgPrincipal = function(Elem){
    ajax_(
        "../../models/Files/File.php",
        "post",
        "json",
        { Action: "getImgPrincipal", Codigo: Elem.getAttribute('codigo') },
        function(response){
            $("#producto-img-principal").fileinput({
                theme: "fas",
                language: "es",
                deleteUrl: '../../models/Files/File.php',
                showRemove: false,
                showUpload: false,
                showBrowse: true,
                showClose: false,
                showCaption: false,
                browseLabel: '',
                removeLabel: '',
                // overwriteInitial: false,
                // reversePreviewOrder: true,
                initialPreview: response.initialPreview,
                initialPreviewAsData: true, // defaults markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                initialPreviewConfig: response.initialPreviewConfig,
                preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
                previewFileIconSettings: { // configure your icon file extensions
                    'doc': '<i class="fas fa-file-word text-info"></i>',
                    'xlsx': '<i class="fas fa-file-excel text-success"></i>',
                    'pptx': '<i class="fas fa-file-powerpoint text-danger"></i>',
                    'txt': '<i class="fas fa-file-alt text-info"></i>',
                    'zip': '<i class="fas fa-file-archive text-muted"></i>',
                    'htm': '<i class="fas fa-file-code text-info"></i>',
                },
                previewFileExtSettings: { // configure the logic for determining icon file extensions
                    'doc': function(ext) {
                        return ext.match(/(doc|docx)$/i);
                    },
                    'xls': function(ext) {
                        return ext.match(/(xls|xlsx)$/i);
                    },
                    'ppt': function(ext) {
                        return ext.match(/(ppt|pptx)$/i);
                    },
                    'zip': function(ext) {
                        return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                    },
                    'htm': function(ext) {
                        return ext.match(/(htm|html)$/i);
                    },
                    'txt': function(ext) {
                        return ext.match(/(txt|ini|csv|java|php|js|css|sql)$/i);
                    },
                    'mov': function(ext) {
                        return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                    },
                    'mp3': function(ext) {
                        return ext.match(/(mp3|wav)$/i);
                    }
                },
                fileActionSettings: {
                  showRemove: false,
                },
                uploadUrl: "../../models/Files/File.php",
                uploadExtraData: { 
                  Action: 'upload'
                },
                purifyHtml: true, // this by default purifies HTML data for preview
            }).on('filebeforedelete', function(event, key, data)  {
                var aborted = !window.confirm('Estas seguro de eliminar este archivo?')
                return aborted
            }).on('fileuploaderror', function(event, data, msg) {

            }).on('filedeleted', function(event, key, data) {

            })// filedeleted
        }
    ); 
}


var fileInput = function(){
                $("#producto-img-principal").fileinput({
                theme: "fas",
                language: "es",
                deleteUrl: '../../models/Files/File.php',
                showRemove: false,
                showUpload: false,
                showBrowse: true,
                showClose: false,
                showCaption: false,
                browseLabel: '',
                removeLabel: '',
                // overwriteInitial: false,
                // reversePreviewOrder: true,
                // initialPreview: response.initialPreview,
                initialPreviewAsData: true, // defaults markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                // initialPreviewConfig: response.initialPreviewConfig,
                preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
                previewFileIconSettings: { // configure your icon file extensions
                    'doc': '<i class="fas fa-file-word text-info"></i>',
                    'xlsx': '<i class="fas fa-file-excel text-success"></i>',
                    'pptx': '<i class="fas fa-file-powerpoint text-danger"></i>',
                    'txt': '<i class="fas fa-file-alt text-info"></i>',
                    'zip': '<i class="fas fa-file-archive text-muted"></i>',
                    'htm': '<i class="fas fa-file-code text-info"></i>',
                },
                previewFileExtSettings: { // configure the logic for determining icon file extensions
                    'doc': function(ext) {
                        return ext.match(/(doc|docx)$/i);
                    },
                    'xls': function(ext) {
                        return ext.match(/(xls|xlsx)$/i);
                    },
                    'ppt': function(ext) {
                        return ext.match(/(ppt|pptx)$/i);
                    },
                    'zip': function(ext) {
                        return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                    },
                    'htm': function(ext) {
                        return ext.match(/(htm|html)$/i);
                    },
                    'txt': function(ext) {
                        return ext.match(/(txt|ini|csv|java|php|js|css|sql)$/i);
                    },
                    'mov': function(ext) {
                        return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                    },
                    'mp3': function(ext) {
                        return ext.match(/(mp3|wav)$/i);
                    }
                },
                fileActionSettings: {
                  showRemove: false,
                },
                uploadUrl: "../../models/Files/File.php",
                uploadExtraData: { 
                  Action: 'upload'
                },
                purifyHtml: true, // this by default purifies HTML data for preview
            }).on('filebeforedelete', function(event, key, data)  {
                var aborted = !window.confirm('Estas seguro de eliminar este archivo?')
                return aborted
            }).on('fileuploaderror', function(event, data, msg) {

            }).on('filedeleted', function(event, key, data) {

            })// filedeleted
}