<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="./assets/img/logo.png" type="">
    <title>MENTHA ECOS</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <section id="container-pedido">
        <div class="container">
            <div class="page-header">
              <h1>PEDIDOS <small class="tittles-pages-logo">Mentha Ecos</small></h1>
            </div>
            <br><br><br>
            <div class="row">
              <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <?php
                  require_once "library/configServer.php";
                  require_once "library/consulSQL.php";
                  if($_SESSION['UserType']=="Admin" || $_SESSION['UserType']=="User"){
                    if(isset($_SESSION['carro'])){
                ?>
                      <br><br><br>
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-xs-10 col-xs-offset-1">
                            <p class="text-center lead">Selecciona un metodo de pago</p>
                            <img class="img-responsive center-all-contens" src="assets/img/credit-card.png">
                            <p class="text-center">
                              <button class="btn btn-lg btn-raised btn-success btn-block" data-toggle="modal" data-target="#PagoModalTran">Transaccion Bancaria</button>
                            </p>
                          </div>
                        </div>
                      </div>
                <?php
                    }else{
                      echo '<p class="text-center lead">No tienes pedidos pendientes de pago</p>';
                    }
                  }else{
                    echo '<p class="text-center lead">Inicia sesión para realizar pedidos</p>';
                  }
                ?>
              </div>
            </div>
        </div>
        <?php
            if($_SESSION['UserType']=="User"){
                $consultaC=ejecutarSQL::consultar("SELECT * FROM venta WHERE NIT='".$_SESSION['UserNIT']."'");
        ?>
            <div class="container" style="margin-top: 70px;">
              <div class="page-header">
                <h1>Mis pedidos</h1>
              </div>
            </div>
        <?php
            if(mysqli_num_rows($consultaC)>=1){
        ?> 
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Envío</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($rw=mysqli_fetch_array($consultaC, MYSQLI_ASSOC)){
                                    ?> 
                                        <tr>
                                            <td><?php echo $rw['Fecha']; ?></td>
                                            <td>$<?php echo $rw['TotalPagar']; ?></td>
                                            <td>
                                            <?php
                                              switch ($rw['Estado']) {
                                                case 'Enviado':
                                                  echo "En camino";
                                                  break;
                                                case 'Pendiente':
                                                  echo "En espera";
                                                  break;
                                                case 'Entregado':
                                                  echo "Entregado";
                                                  break;
                                                default:
                                                  echo "Sin informacion";
                                                  break;
                                              }
                                            ?>
                                            </td>
                                            <td><?php echo $rw['TipoEnvio']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        <?php
            }else{
              echo '<p class="text-center lead">No tienes ningun pedido realizado</p>';
            }
            mysqli_free_result($consultaC);
        }
        ?>
    </section>
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
