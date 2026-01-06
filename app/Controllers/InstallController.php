<?php

    namespace App\Controllers;

    use CodeIgniter\Controller;


    /**
     * Controller para instalação do sistema.
     */
    class InstallController extends Controller
    {
        /**
         * Tela para usuario fazer a instalação.
         */
        public function migrate(): string
        {
            $data = array(
                "title" => "Instalação do banco de dados"
            );


            return view("install/migrate", $data);
        }

        /**
         * Faz a instalação das migrations e salva
         * na env
         */
        public function migrate_install(): string
        {
            return "instalando ...";
        }
    }
