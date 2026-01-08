<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductThumbnailModel;
use App\Models\ProductPhotoModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductCharacteristicModel;
use App\Models\ProductCorreioModel;

class ProductsController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');
        $userId = $user['id'];

        $productModel = new ProductModel();
        $thumbModel = new ProductThumbnailModel();

        /**
         * obtém os produtos do usuário
         */
        $products = $productModel
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        /**
         * obtém miniaturas relacionadas
         */
        foreach ($products as &$product)
        {
            $thumb = $thumbModel->where('product_id', $product['id'])->first();
            $product['thumbnail'] = $thumb ? base_url($thumb['name']) : base_url('dist/photos/no-image.png');
        }

        return view('dashboard/products', [
            'title' => 'Meus Produtos',
            'products' => $products,
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error')
        ]);
    }

    public function delete($id)
    {
        $user = session()->get('user');
        $userId = $user['id'];

        $productModel = new ProductModel();
        $thumbModel = new ProductThumbnailModel();
        $photoModel = new ProductPhotoModel();
        $categoryModel = new ProductCategoryModel();
        $charModel = new ProductCharacteristicModel();
        $correioModel = new ProductCorreioModel();

        $db = \Config\Database::connect();
        $db->transStart(); // 🔒 Inicia transação

        /**
         * Verifica se o produto pertence ao usuário logado
         */
        $product = $productModel->find($id);
        if (!$product || $product['user_id'] != $userId) {
            return redirect()->back()->with('error', 'Produto não encontrado ou acesso negado.');
        }

        /**
         * Exclui miniatura.
         */
        $thumb = $thumbModel->where('product_id', $id)->first();
        if ($thumb && !empty($thumb['name']) && file_exists(FCPATH . $thumb['name'])) {
            unlink(FCPATH . $thumb['name']);
        }
        $thumbModel->where('product_id', $id)->delete();

        /**
         * Exclui fotos
         */
        $photos = $photoModel->where('product_id', $id)->findAll();
        foreach ($photos as $photo) {
            if (!empty($photo['name']) && file_exists(FCPATH . $photo['name'])) {
                unlink(FCPATH . $photo['name']);
            }
        }
        $photoModel->where('product_id', $id)->delete();

        /**
         * Exclui categorias
         */
        $categoryModel->where('product_id', $id)->delete();

        /**
         * Exclui características
         */
        $charModel->where('product_id', $id)->delete();

        /**
         * Exclui informações de correio
         */
        $correioModel->where('product_id', $id)->delete();

        /**
         * Por fim, exclui o produto
         */
        $productModel->delete($id);

        /**
         * Confirma transação.
         */
        $db->transComplete();

        if ($db->transStatus() === false)
        {
            return redirect()->back()->with('error', 'Erro ao excluir produto. Tente novamente.');
        }

        return redirect()->to('/dashboard/products')->with('success', 'Produto e todos os dados relacionados foram excluídos com sucesso!');
    }
}
