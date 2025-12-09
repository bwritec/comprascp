<?php

    namespace App\Controllers;

    use App\Controllers\BaseController;
    use App\Models\AddressModel;

    /**
     *
     */
    class FreteController extends BaseController
    {
        /**
         * Calcular frete com API melhorenvio https://melhorenvio.com.br.
         */
        public function calcular_melhorenvio()
        {
            $addressModel = new AddressModel();

            $user = session()->get('user');
            $token = env('melhorenvio.token');
            $destination_cep = $this->request->getGet('cep');

            if (!$user)
            {
                /**
                 * Vamos usar um cep em branco para essa request.
                 */
                if (strlen($destination_cep) == 0)
                {
                    $destination_cep = "00000000";
                }
            } else
            {
                $user_address = $addressModel
                    ->where("user_id", $user["id"])
                    ->first();

                if (is_null($user_address))
                {
                    $destination_cep = "00000000";
                } else
                {
                    if (strlen($destination_cep) == 0)
                    {
                        $destination_cep = $user_address["cep"];
                    }
                }
            }

            $pedido = [
                "from" => [
                    /**
                     * origem
                     */
                    "postal_code" => "01001-000"
                ],

                "to" => [
                    /**
                     * destino
                     */
                    "postal_code" => $destination_cep
                ],

                "package" => [
                    "weight" => 1,        // kg
                    "height" => 10,       // cm
                    "width" => 15,        // cm
                    "length" => 20        // cm
                ],
                "services" => "1,2" // 1=PAC, 2=SEDEX (Correios)
            ];

            $ch = curl_init("https://www.melhorenvio.com.br/api/v2/me/shipment/calculate");

            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    "Authorization: Bearer $token",
                    "Content-Type: application/json"
                ],
                CURLOPT_POSTFIELDS => json_encode($pedido)
            ]);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                return $this->response->setJSON([
                    'erro' => curl_error($ch)
                ]);
            }

            curl_close($ch);

            return $this->response->setJSON(json_decode($response, true));
        }

        /**
         * Calcular frete com alguma API.
         */
        public function calcular()
        {
            return $this->calcular_melhorenvio();
        }
    }