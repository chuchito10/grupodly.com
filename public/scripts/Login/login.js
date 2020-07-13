/**
 * Registro nuevo cliente
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var Registro = function(Elem) {
  ajax_('../../models/Cliente/Cliente.Route.php', 'POST', 'JSON', $('#form-registro').serialize(), 
  function(response){
    if (!response.error) {
      Alerts('alert-registro-actualizacion', 'success', response.message)
    }else{
      Alerts('alert-registro-actualizacion', 'danger', response.message)
    }
  })
}
/**
 * Inicio de sesión
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var Login = function(Elem) {
  ajax_('../../models/Login/Login.Route.php', 'POST', 'JSON', $('#form-login').serialize(), 
  function(response){
    if (!response.error) {
      Alerts('alert-login', 'success', response.message)
      window.location.href = "../Home/";
    }else{
      Alerts('alert-login', 'danger', response.message)
    }
  })
}