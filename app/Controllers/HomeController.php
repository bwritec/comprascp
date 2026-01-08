<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductThumbnailModel;

class HomeController extends BaseController
{
    /**
     *
     */
    public function index(): string
    {
        $productModel = new ProductModel();
        $thumbModel   = new ProductThumbnailModel();

        /**
         * Busca os 12 produtos mais recentes com miniatura
         */
        $last_products = $productModel
            ->select('products.*, product_thumbnails.name AS thumbnail')
            ->join('product_thumbnails', 'product_thumbnails.product_id = products.id', 'left')
            ->orderBy('products.id', 'DESC')
            ->limit(12)
            ->findAll();

        $data = [
            'title' => 'Página inicial',
            'last_products' => $last_products,
        ];

        return view("index", $data);
    }

    /**
     *
     */
    public function blank(): string
    {
        $data = [
            'title' => 'Branco',
        ];

        return view("blank", $data);
    }
}
