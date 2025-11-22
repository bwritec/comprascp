<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCharacteristicModel extends Model
{
    protected $table = 'product_characteristics';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'characteristic'];
}