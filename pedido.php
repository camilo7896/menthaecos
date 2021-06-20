<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="./assets/img/logo.png" type="">
    <title>MENTHA ECOS</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
 
    <div class="modal fade" id="PagoModalTran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
  <input name="merchantId"    type="hidden"  value="508029"   >
  <input name="accountId"     type="hidden"  value="512321" >
  <input name="description"   type="hidden"  value="Ventas en linea"  >
  <input name="referenceCode" type="hidden"  value="pago-001" >
  <input name="amount"        type="hidden"  value="20000"   >
  <input name="tax"           type="hidden"  value="3193"  >
  <input name="taxReturnBase" type="hidden"  value="16806" >
  <input name="currency"      type="hidden"  value="COP" >
  <input name="signature"     type="hidden"  value="7ee7cf808ce6a39b17481c54f2c57acc"  >
  <input name="test"          type="hidden"  value="0" >
  <input name="buyerEmail"    type="hidden"  value="test@test.com" >
  <input name="responseUrl"    type="hidden"  value="http://www.test.com/response" >
  <input name="confirmationUrl"    type="hidden"  value="http://www.test.com/confirmation" >
  <input name="Submit"        type="submit"  value="Enviar" >
</form>
      </div>
    </div>
    <div class="ResForm"></div>
    <?php include './inc/footer.php'; ?>
</body>
</html>
