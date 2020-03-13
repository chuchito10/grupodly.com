/**
 * Listar datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ListDatosEnvio = function(Elem) {
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
var nuevoRegistroDatosEnvio = function(Elem) {
  ajax_('../../models/Cliente/Cuenta/DatosEnvio.php', 'POST', 'JSON', $('#form-datos-envio').serialize(), 
  function(response){
    if (!response.error) {
      toastAlert(response.typeError, '', response.message, 'topRight', 'icon-circle-check')
      GlobalCloseModal('modal-datos-envio')
      ListDatosEnvio()
    }else{
      toastAlert('danger', '', response.message, 'topRight', 'icon-ban')
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
var mostrarFormDatosEnvio = function() {
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
var EditarFormDatosEnvio = function(Elem) {
  ajaxViews('../../views/Cuenta/DatosEnvio/Create.php', 'POST', 'HTML', { DatosEnvioKey: Elem.getAttribute('DatosEnvioKey') }, 
  function(response){
    GlobalOpenModal('modal-datos-envio')
    document.getElementById('modal-body-datos-envio').innerHTML = response
  })
}

GlobalInitialDatatableSimple('TableDatosEnvio')