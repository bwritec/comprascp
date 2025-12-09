<?php

    namespace App\Controllers;

    use App\Controllers\BaseController;
    use App\Models\AddressModel;
    use App\Models\ProductModel;


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
            /**
             * Objetos
             */
            $addressModel = new AddressModel();
            $productModel = new ProductModel();

            $product_id = $this->request->getGet("product_id");

            /**
             * Caso não exista um product_id.
             */
            if (strlen($product_id) == 0)
            {
                return $this->response->setJSON([
                    "errors" => array(
                        "Não foi possivel obter o id do produto"
                    )
                ]);
            }

            $productModel = new ProductModel();
            $product_user_id = 0;
            $product = $productModel
                ->where("id", $product_id)
                ->first();

            /**
             * Caso não exista um produto com esse id.
             */
            if (is_null($product))
            {
                return $this->response->setJSON([
                    "errors" => array(
                        "Não foi possivel obter informações do produto"
                    )
                ]);
            } else
            {
                /**
                 * Vamos obter o id do produto.
                 */
                $product_user_id = $product["user_id"];
            }

            /**
             * Obter cep de origem.
             */
            $user_address = $addressModel
                ->where("user_id", $product_user_id)
                ->first();

            /**
             * O cep de origem.
             */
            $origin_cep = "00000000";

            /**
             * Sé o usuario tiver um endereço.
             */
            if (!is_null($user_address))
            {
                $origin_cep = $user_address["cep"];
            }

            /**
             * Configurações do gateway.
             */
            $token = env('melhorenvio.token');

            /**
             * Obter cep de destino.
             */
            $user = session()->get('user');
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
                    "postal_code" => $origin_cep
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

            if (curl_errno($ch))
            {
                return $this->response->setJSON([
                    'erro' => curl_error($ch)
                ]);
            }

            curl_close($ch);

            return $this->response->setJSON(
                json_decode($response, true)
            );
        }

        /**
         * Calcular frete com alguma API.
         */
        public function calcular()
        {
            return $this->calcular_melhorenvio();
        }
    }