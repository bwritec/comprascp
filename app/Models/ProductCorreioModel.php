<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class ProductCorreioModel extends Model
    {
        /**
         *
         */
        protected $table = 'product_correios';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $allowedFields = [
            'user_id',
            'product_id',
            'weight',
            'length',
            'height',
            'width'
        ];
    }
