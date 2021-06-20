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
              <h1>CARRITO DE COMPRAS <small class="tittles-pages-logo">Mentha Ecos</small></h1>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                        require_once "library/configServer.php";
                        require_once "library/consulSQL.php";
                        if(!empty($_SESSION['carro'])){
                            $suma = 0;
                            $sumaA = 0;
                            echo '<table class="table table-bordered table-hover"><thead><tr class="bg-success"><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acciones</th></tr></thead>';
                            foreach($_SESSION['carro'] as $codeProd){
                                $consulta=ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='".$codeProd['producto']."'");
                                while($fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
                                    $pref=number_format(($fila['Precio']-($fila['Precio']*($fila['Descuento']/100))), 2, '.', '');
                                        // echo "<tbody>
                                        //     <tr>
                                        //         <td>".$fila['NombreProd']."</td>
                                        //         <td> ".$pref."</td>
                                        //         <td> ".$codeProd['cantidad']."</td>
                                        //         <td> ".$pref*$codeProd['cantidad']."</td>
                                        //         <td>
                                        //             <form action='process/quitarproducto.php' method='POST' class='FormCatElec' data-form=''>
                                        //                 <input type='hidden' value='".$codeProd['producto']."' name='codigo'>
                                        //                 <button class='btn btn-danger btn-raised btn-xs'>Eliminar</button>
                                        //             </form>
                                        //         </td>
                                        //     </tr>
                                        // </tbody>";
                                $suma += $pref*$codeProd['cantidad'];
                                $sumaA += $codeProd['cantidad'];
                                }
                                mysqli_free_result($consulta);
                            }
                            echo '<tr class="bg-danger"><td colspan="2">Total</td><td><strong>'.$sumaA.'</strong></td><td><strong>$'.number_format($suma,2).'</strong></td></tr></table><div class="ResForm"></div>';
                            echo '
                            <p class="text-center">
                            <a href="product.php" class="btn btn-primary btn-raised btn-lg">Seguir comprando</a>
                            <a href="process/vaciarcarrito.php" class="btn btn-success btn-raised btn-lg">Vaciar el carrito</a>
                            </p>
                            ';
                        }else{
                            echo '<p class="text-center text-danger lead">El carrito de compras esta vacío</p><br>
                            <a href="product.php" class="btn btn-primary btn-lg btn-raised">Ir a Productos</a>'; 
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
                        }  
                    ?>
                        
                </div>
            </div>
        </div> 
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>