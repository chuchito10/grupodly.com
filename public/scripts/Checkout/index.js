OpenPay.setId('m1sgywxddqxx4mzfnzkk');
OpenPay.setApiKey('pk_f3aa91e6196a499e830385787ad5e040');
OpenPay.setSandboxMode(true);

var checkDatosEnvio       = getChecked('.datosEnvio')
var checkDatosFacturacion = getChecked('.datosFacturacion')

var Success = function(response) {
  let tokenId = response.data.id;
  let deviceSessionId = OpenPay.deviceData.setup();
  ajax_('../../models/OpenPay/OpenPay.Route.php', 'POST', 'JSON', 
  {
    Action: "Create", 
    ActionOpenPay: true, 
    tokenId : tokenId, 
    deviceSessionId : deviceSessionId,
    datosEnvio: checkDatosEnvio,
    datosFacturacion: checkDatosFacturacion
  }, 
  function(response){
    if (!response.error) {
      toastAlert('success', '', response.message, 'topRight', 'icon-circle-check')
       window.location.href = "../Pedido/completo.php";
    }else{
      toastAlert('danger', '', response.message, 'topRight', 'icon-ban')
    }
  })
}

var Errorr = function(response) {
  let desc = response.data.description != undefined ? response.data.description : response.message;
  alert("ERROR [" + response.status + "] " + desc);
}

/**
 * 
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var PagarPedido = function(Elem){ 
  event.preventDefault();
  let CardNumber      = CleanSpaces(document.getElementById('number').value)
  let HolderName      = CleanSpaces(document.getElementById('name').value)
  let ExpirationMonth = CleanSpaces(document.getElementById('exp_month').value)
  let ExpirationYear  = CleanSpaces(document.getElementById('exp_year').value)
  let Cvv2            = CleanSpaces(document.getElementById('cvc').value)

    if ( OpenPay.card.validateCardNumber(CardNumber) ) {
      if (!(HolderName == '')) {
        if (OpenPay.card.validateExpiry(ExpirationMonth, ExpirationYear)) {
          if (OpenPay.card.validateCVC(Cvv2)) {
            // if (document.getElementById('TotalValidacion').value <= 100000) {
              $(Elem).prop( "disabled", true);
              OpenPay.token.create(
                {
                  "card_number": CardNumber,
                  "holder_name": HolderName,
                  "expiration_year": ExpirationYear,
                  "expiration_month": ExpirationMonth,
                  "cvv2": Cvv2
                }, Success, Errorr
              );          
            /*}else{
              Alerts("AlertPago", "warning", "Recuerda que no puedes superar los 100000 pesos")
            }*/
          }else{
            addViewCheckout(document.getElementById('process-3'))
            Alerts("AlertPago", "warning", "¡El <strong> Código de seguridad </strong> no es valido!")
          }
        }else{
          addViewCheckout(document.getElementById('process-3'))
          Alerts("AlertPago", "warning", "¡<strong> Fecha de expiración </strong> no valida!")
        }
      }else{
        addViewCheckout(document.getElementById('process-3'))
        Alerts("AlertPago", "warning", "¡<strong> Nombre </strong> es requerido!")
      }
    }else{
      addViewCheckout(document.getElementById('process-3'))
      Alerts("AlertPago", "warning", "¡El <strong> número de tarjeta </strong> no es valida!")
    }
}

var Expiracion = function(Elem){
  var str = Elem.value;
  var res = str.split("/");
  document.getElementById("exp_month").value = res[0]
  document.getElementById("exp_year").value = res[1]
} 

/**
 * información para mostralo en la vista resumen checkout
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var datosViewResumenCheckoutPedido = function(){
  let numeroTarjeta         = CleanSpaces(document.getElementById('number').value)
  let ultimosDigitosTarjeta = numeroTarjeta.substr(-4)

  document.getElementById('resumen-datosEnvio-direccion').innerHTML       = document.getElementById('datosEnvio-direccion-'+checkDatosEnvio).innerHTML
  document.getElementById('resumen-datosEnvio-celular').innerHTML         = document.getElementById('datosEnvio-celular-'+checkDatosEnvio).innerHTML

  document.getElementById('resumen-datosFacturacion-direccion').innerHTML = document.getElementById('datosFacturacion-direccion-'+checkDatosFacturacion).innerHTML
  document.getElementById('resumen-datosFacturacion-RFC').innerHTML       = document.getElementById('datosFacturacion-RFC-'+checkDatosFacturacion).innerHTML

  document.getElementById('resumen-numero-tarjeta').innerHTML = '**** **** **** '+ultimosDigitosTarjeta
}

/**
 * Incluir vista de acuerdo al proceso pedido checkout
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var addViewCheckout = function(Elem){
  let number = Elem.getAttribute('number') // obtención de atributo number dependiendo del elemento actual
  $('.completed').find('span:first').remove() // encontrar el primer elemento dependiendo de la clase para poder removerlo
  $('.process').removeClass('active').removeClass('completed') // remover clase active y completed dependiendo de la clase 
  document.getElementById('process-'+number).classList.add('active')  // añadir la clase active de acuerdo al id formado
  
  $('.process').each(function(index, el) {
    if (el.getAttribute('number') < number) {
      el.classList.add('completed')
    }
  });

  $('.completed').prepend('<span class="step-indicator icon-circle-check"></span>')// agregar elemento al inicio 
  $('.PartialCheckout').css('display','none'); //
  document.getElementById('PartialCheckout-'+number).style.display = 'block'

  if (number == 4) {
    datosViewResumenCheckoutPedido()
  }
}