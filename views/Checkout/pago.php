<h4>Método de pago</h4>
<hr class="padding-bottom-1x">
<div class="card">
  <div class="card-header" role="tab">
    <h6><a href="#card" data-toggle="collapse"><i class="icon-columns"></i> Pago con tarjeta mediante Open Pay</a></h6>
  </div>
  <div class="collapse show" id="card" data-parent="#accordion" role="tabpanel">
    <div class="card-body">
      <div id="AlertPago"></div>
      <div class="row mb-4">
        <div class="col-md-12">
          <div class="alert alert-info alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-layers"></i>&nbsp;&nbsp;Monto máximo para pago con tarjeta: <strong>$100,000 MXN</strong></div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-8">
          <h4 class="text-center">Tarjetas de crédito</h4>
          <div class="credit d-flex justify-content-center">
            <img class="img-responsive" src="../../public/img/OpenPay/cards2.png">
          </div>
        </div>
        <div class="col-md-4">
          <h4>Tarjetas de débito</h4>
          <div class="debit">
            <img class="img-responsive" src="../../public/img/OpenPay/cards1.png">
          </div>
        </div>
      </div>
      <!--  -->
      <hr>
      <div class="card-wrapper"></div>
      <form class="interactive-credit-card row">
        <div class="form-group col-sm-6">
          <input class="form-control" type="text" id="number" name="number" placeholder="Número de tarjeta" required>
        </div>
        <div class="form-group col-sm-6">
          <input class="form-control" type="text" id="name" name="name" placeholder="Nombre Completo" required>
        </div>
        <div class="form-group col-sm-6">
          <input class="form-control" type="text" id="expiry" name="expiry" placeholder="MM/YY" onkeyup="Expiracion(this)" required>
          <input class="form-control" type="hidden" id="exp_month" name="exp_month" data-openpay-card="expiration_month">
          <input class="form-control" type="hidden" id="exp_year" name="exp_year" data-openpay-card="expiration_year">
        </div>
        <div class="form-group col-sm-6">
          <input class="form-control" type="text" id="cvc" name="cvc" placeholder="CVC" required>
        </div>
      </form>
      <!-- Información OpenPay Necesaria -->
      <div class="row mt-4">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <p class="text-right">Transacciones realizadas vía:</p>
            </div>
            <div class="col-md-3">
              <div class="credit d-flex justify-content-end">
                <img class="img-responsive" src="../../public/img/OpenPay/openpay.png">
              </div>
            </div>
          </div>  
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-2">
              <div class="credit d-flex justify-content-center">
                <img class="img-responsive" src="../../public/img/OpenPay/security.png">
              </div>
            </div>
            <div class="col-md-6">
              <p>Tus pagos se realizan de forma segura con encriptación de 256 bits</p>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>
<div class="checkout-footer">
  <div class="column">
    <a class="btn btn-outline-secondary" number="2" onclick="addViewCheckout(this)">
      <i class="icon-arrow-left"></i>
      <span class="hidden-xs-down">&nbsp;Otro</span>
    </a>
  </div>
  <div class="column">
    <a class="btn btn-primary" number="4" onclick="addViewCheckout(this)">
      <span class="hidden-xs-down">Continuar&nbsp;</span><i class="icon-arrow-right"></i>
    </a>
  </div>
</div>