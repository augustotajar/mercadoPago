<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use MP;

class mercadopagoController extends Controller
{
    public function procesar_pago(Request $request){
        //$post = Input::all();
        $mp = new MP('6256745905356554', 'D3nZvtaC5coPWZOuOeCyEzjTYIdoftS4'); //USER_ID Y USER_KEY

        $preference_data = array(
            "items" => array(
                array(
                    "id" => "NUMERO_DE_PEDIDO_O_ID_DEL_CARRO", //$request->numero_orden;
                    "title" => "Carro de compras",
                    "currency_id" => "CLP",
                    "picture_url" =>"https://www.mercadopago.com/org-img/MP3/home/logomp3.gif",
                    "description" => "DESCRIPCION", //$request->descripcion;
                    "quantity" => 1,
                    "unit_price" => 10000 //$request->precio;
                )
            ),
            "back_urls" => array(
                "success" => "https://www.success.com",
                "failure" => "http://www.failure.com",
                "pending" => "http://www.pending.com"
            ),
            "auto_return" => "approved",
            "payment_methods" => array(
                "excluded_payment_types" => array(
                ),
                "installments" => 24, //$request->cuotas;
                "default_payment_method_id" => null,
                "default_installments" => null,
            ),
            "notification_url" => "https://www.your-site.com/ipn"  //sito publico para recibir notificaciones del pago
        );

        $preference = $mp->create_preference($preference_data);
        return redirect($preference['response']['init_point']);
    }
    
}
