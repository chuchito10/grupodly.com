GlobalInitialDatatableSimple('TablePedidos')

var detallePedido = function(Elem){
  ajax_("../../views/Cuenta/Pedidos/listDetalle.php", "POST", "HTML", { PedidoKey: Elem.getAttribute('pedidokey')}, 
  function(response){
  	document.getElementById('modal-body-detalle-pedido').innerHTML = response
  	GlobalOpenModal('modal-detalle-pedido')
  })
}