/**
 * agregar producto al carrito
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var agregarToCarrito = function(Elem) {
  let data = {
    Action: 'create',
    ActionPedidoDetalle: true,
    ProductoCodigo: Elem.getAttribute('code'),
    ProductoCantidad: document.getElementById('ProductoCantidad-'+Elem.getAttribute('code')).value
  }
  ajax_('../../models/Pedido/Detalle.Controller.php', 'POST', 'JSON', data, 
  function(response){
    if (!response.error) {
      toastAlert('success', '', response.message, 'topRight', 'icon-circle-check')
      if (document.getElementById('ListProductosCarrito')) {
        ListProductosCarrito()
      }
      ListResumenProductosCarrito()
    }else{
      toastAlert('danger', '', response.message, 'topRight', 'icon-ban')
    }
  })
}
/**
 * Listar productos vista carrito
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ListProductosCarrito = function(){
  ajax_("../../views/Carrito/List.php", "POST", "HTML", {  },  
  function(response){
    document.getElementById('ListProductosCarrito').innerHTML = response
  })
}
/**
 * Listar productos en header resumen carrito
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ListResumenProductosCarrito = function(){
  ajax_("../../views/Carrito/Resumen/index.php", "POST", "HTML", {  },  
  function(response){
    document.getElementById('ListResumenProductosCarrito').innerHTML = response
  })
}
/**
 * eliminar producto carrito
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var deleteProductoCarrito = function(Elem){
  ajax_("../../models/Pedido/Detalle.Controller.php", "POST", "JSON", { Action: 'delete', ActionPedidoDetalle: true, ProductoKey: Elem.getAttribute('productokey') },
  function(response){
    if (!response.error) {
      toastAlert(response.typeError, '', response.message, 'topRight', 'icon-circle-check')
      if (document.getElementById('ListProductosCarrito')) {
        ListProductosCarrito()
      }
      ListResumenProductosCarrito()
    }else{
      toastAlert(response.typeError, '', response.message, 'topRight', 'icon-ban')
    }
  })
}