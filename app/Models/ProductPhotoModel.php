<?php

    namespace App\Models;

    use CodeIgniter\Model;

    /**
     *
     */
    class ProductPhotoModel extends Model
    {
        /**
         *
         */
        protected $table = 'product_photos';

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
            'name'
        ];
    }
