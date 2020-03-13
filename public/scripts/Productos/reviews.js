/**
 * Listar datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ListComentariosProducto = function(Elem) {
  ajaxViews('../../views/Cuenta/DatosEnvio/List.php', 'POST', 'HTML', {}, 
  function(response){
    document.getElementById('List-DatosEnvio').innerHTML = response
    GlobalInitialDatatableSimple('TableDatosEnvio')
  })
}
/**
 * Nuevo registro datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var nuevoComentarioProducto = function(Elem) {
  ajax_('../../models/Productos/Comentarios.Controller.php', 'POST', 'JSON', $('#form-reviews').serialize(), 
  function(response){
    console.log(response)
    if (!response.error) {
      Alerts('alert-datos-envio', 'success', response.message)
    }else{
      Alerts('alert-datos-envio', 'danger', response.message)
    }
  })
}
/**
 * Nuevo registro datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var mostrarFormComentarioProducto = function() {
  ajaxViews('../../views/Cuenta/DatosEnvio/Create.php', 'POST', 'HTML', {}, 
  function(response){
    GlobalOpenModal('modal-datos-envio')
    document.getElementById('modal-body-datos-envio').innerHTML = response
  })
}
/**
 * Nuevo registro datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var EditarFormComentarioProducto = function(Elem) {
  ajaxViews('../../views/Cuenta/DatosEnvio/Create.php', 'POST', 'HTML', { DatosEnvioKey: Elem.getAttribute('DatosEnvioKey') }, 
  function(response){
    GlobalOpenModal('modal-datos-envio')
    document.getElementById('modal-body-datos-envio').innerHTML = response
  })
}