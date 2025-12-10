<?php

    namespace App\Controllers;

    use CodeIgniter\Controller;


    /**
     *
     */
    class EnvController extends BaseController
    {
        /**
         * Alterar um valor de uma chave .env
         * 
         * Exemplo:
         *     $this->setEnvValue("app.name", "kwrite");
         *     $this->setEnvValue("app.rate", "25");
         */
        public function setEnvValue($key, $value)
        {
            $path = ROOTPATH . '.env';

            if (!file_exists($path))
            {
                return false;
            }

            $value = trim($value);

            $env = file_get_contents($path);

            /**
             * Verifica se já existe.
             */
            if (preg_match("/^{$key}=.*/m", $env))
            {
                /**
                 * Substitui a linha completa.
                 */
                $env = preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}=\"{$value}\"",
                    $env
                );
            } else
            {
                /**
                 * Adiciona ao final.
                 */
                $env .= "\n{$key}=\"{$value}\"";
            }

            /**
             * Salva de volta
             */
            file_put_contents($path, $env);

            return true;
        }
    }
