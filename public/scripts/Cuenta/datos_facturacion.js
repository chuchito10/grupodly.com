/**
 * Listar datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ListDatosFacturacion = function() {
  ajaxViews('../../views/Cuenta/DatosFacturacion/List.php', 'POST', 'HTML', {}, 
  function(response){
    document.getElementById('List-DatosFacturacion').innerHTML = response
    GlobalInitialDatatableSimple('TableDatosFacturacion')
  })
}
/**
 * Nuevo registro datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var nuevoRegistroDatosFacturacion = function(Elem) {
  ajax_('../../models/Cliente/Cuenta/DatosFacturacion.php', 'POST', 'JSON', $('#form-datos-facturacion').serialize(), 
  function(response){
    if (!response.error) {
      toastAlert(response.typeError, '', response.message, 'topRight', 'icon-circle-check')
      ListDatosFacturacion()
      GlobalCloseModal('modal-datos-facturacion')
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
var mostrarFormDatosFacturacion = function() {
  ajaxViews('../../views/Cuenta/DatosFacturacion/Create.php', 'POST', 'HTML', {}, 
  function(response){
    GlobalOpenModal('modal-datos-facturacion')
    document.getElementById('modal-body-datos-facturacion').innerHTML = response
  })
}
/**
 * Nuevo registro datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var editarFormDatosFacturacion = function(Elem) {
  ajaxViews('../../views/Cuenta/DatosFacturacion/Create.php', 'POST', 'HTML', { DatosFacturacionKey: Elem.getAttribute('DatosFacturacionKey') }, 
  function(response){
    GlobalOpenModal('modal-datos-facturacion')
    document.getElementById('modal-body-datos-facturacion').innerHTML = response
  })
}

GlobalInitialDatatableSimple('TableDatosFacturacion')