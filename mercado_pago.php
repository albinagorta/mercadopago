<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// SDK de Mercado Pago
require 'extencion/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-2429504688547560-111120-984ae3c8095e9921d82cb1a1c6e58d4f-267864011');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$items = array();

$productosprecio = [10,20, 30];


	foreach ($productosprecio as $valor) {
			$item = new MercadoPago\Item();
			/*$item->title = strtoupper($nombre) . " x". $cantidad;*/
			$item->quantity = 1;
			$item->currency_id = "PEN";
			$item->unit_price = floatval($valor);
			array_push($items, $item);
	}


$preference->items = $items;
// var_dump($items);
$preference->save();
?>

	<form action="/procesar-pago" method="POST">
	  
		<script
		  src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js"
		  data-preference-id="<?php echo $preference->id; ?>">
		</script>

	</form>