<html>
<head>
<title>Conectandose a UMAPal</title>
</head>
<body onload="document.umapal.submit()">
<!-- <body onload="document.forms['member_signup'].submit()"> -->

<h3>Conectandose a UMAPal, espere unos instantes...</h3>

<!-- Ver https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/formbasics/ -->
<form name="umapal" action="<?php echo base_url(); ?>umapal/procesar.php" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="mi@negocio.com">
  <input type="hidden" name="item_name" value="<?php echo $item_name ?>">
  <input type="hidden" name="item_number" value="<?php echo $item_id ?>">
  <input type="hidden" name="amount" value="<?php echo $amount ?>">
  <input type="hidden" name="quantity" value="<?php echo $quantity ?>">
  <input type="hidden" name="currency_code" value="EUR">
  <!-- Indicamos que la direccion viene dada por la web -->
  <input type="hidden" name="address_override" value="1">
  <input type="hidden" name="first_name" value="<?php echo $datosEnvio->nombre ?>">
  <input type="hidden" name="last_name" value="<?php echo $datosEnvio->apellidos ?>">
  <input type="hidden" name="address1" value="<?php echo $datosEnvio->direccion ?>">
  <input type="hidden" name="city" value="<?php echo $datosEnvio->provincia ?>">
  <input type="hidden" name="zip" value="<?php echo $datosEnvio->cp ?>">
  <input type="hidden" name="country" value="ES">
  <input type="hidden" name="return" value="<?php echo $success ?>">
  <input type="hidden" name="cancel_return" value="<?php echo $denied ?>">
  <!-- Este valor no existe en paypal, pero nos ayudara a la hora de simular peticiones unicas -->
  <input type="hidden" name="cartID" value="<?php echo $peticionActual; ?>">
  <input type="submit" value="Enviar a UMAPal" />
</form>

</body>
</html>