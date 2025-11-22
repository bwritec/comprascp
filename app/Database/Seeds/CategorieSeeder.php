<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run()
    {
        /**
         * Tecnologia
         */
        $this->db->table('categories')->insert([
            'parent' => 0,
            'name' => 'Tecnologia',
            'slogan' => 'tecnologia',
            'description' => ''
        ]);

        $parentId = $this->db->insertID();

        $this->db->table('categories')->insertBatch([
            [
                "parent" => $parentId,
                "name" => "Antena",
                "slogan" => "antena",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Pendrive",
                "slogan" => "pendrive",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Receptor",
                "slogan" => "receptor",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Smartphone",
                "slogan" => "smartphone",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Tv Box",
                "slogan" => "tv-box",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "WiFi",
                "slogan" => "wifi",
                "description" => ""
            ],
        ]);

        /**
         * Moda
         */
        $this->db->table('categories')->insert([
            'parent' => 0,
            'name' => 'Moda',
            'slogan' => 'moda',
            'description' => ''
        ]);

        $parentId = $this->db->insertID();

        $this->db->table('categories')->insertBatch([
            [
                "parent" => $parentId,
                "name" => "Íntima",
                "slogan" => "intima",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Bermuda",
                "slogan" => "bermuda",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Camisa",
                "slogan" => "camisa",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Regata",
                "slogan" => "regata",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Sapato",
                "slogan" => "sapato",
                "description" => ""
            ],
            [
                "parent" => $parentId,
                "name" => "Vestido",
                "slogan" => "vestido",
                "description" => ""
            ],
        ]);
    }
}
