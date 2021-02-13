<?php
/*INSTALAR SDK CON COMANDO: composer require mercadopago/sdk

*/
  // Requerimos el archivo autoload dentro de la carpeta 'vendor' para poder usar el SDK
  require 'exten/vendor/autoload.php';

  // Precio a cobrar
  $precio = "199.99";

  // Concepto de compra
  $concepto = "Compra en mi sitio web.";

  // URL's de ret orno
  // sustituye "mi-proyecto" por el nombre que le diste a tu carpeta de proyecto
  $regreso   = "http://localhost/mi-proyecto/pago-aceptado.php?id=90"; 
  $cancelado = "http://localhost/mi-proyecto/pago-cancelado.php";

  // Inicializar mercadopago
  /*$mp = new MP('CLIENT_ID', 'CLIENT_SECRET');*/
  $mp = new MP('2429504688547560', 'h4rvPHf7ZUAZRFO0vUCcdsiB2G5XqZQD');
  
  // Configuramos los datos del cobro
  $preference_data = array(
      "items" => [
          [
              "title" => $concepto,
              "quantity" => 9,
              "currency_id" => "PEN", // Si deseas saber con que tipos de monedas puedes cobrar visita https://api.mercadopago.com/currencies
              "unit_price" => (double) $precio
          ]
      ],
      "default_payment_method_id" => "visa", // método de pago por default
      "installments" => 1,
      "back_urls" => [
        "success" => $regreso,
        "failure" => $cancelado
      ]
  );
  
  // Enviar los datos al API de Mercado Pago para la generación del link
  $preference = $mp->create_preference($preference_data);

  // Redireccionar al usuario a la página de pago en modo sandbox
  header("Location: " . $preference['response']['sandbox_init_point']); // puedes usar $preference['response']['init_point'] para aceptar reales
?>