<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class CategoryController extends BaseController
{
    protected $categoryModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categoryModel = new CategoryModel();

        $categories = $categoryModel
            ->select('categories.*, parent_cat.name as parent_name')
            ->join('categories as parent_cat', 'parent_cat.id = categories.parent', 'left')
            ->orderBy('categories.id', 'DESC')
            ->distinct() // evita duplicações se houver join
            ->paginate(10);

        $pager = $categoryModel->pager;

        $data = [
            'title'      => 'Categorias',
            'categories' => $categories,
            'pager'      => $pager,
        ];

        return view('dashboard/categories/index', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();

        /**
         * Busca todas as categorias existentes (para o select de "Categoria Pai")
         */
        $parents = $categoryModel->orderBy('name', 'ASC')->findAll();

        $data = [
            'title' => 'Nova Categoria',
            'parents' => $parents,
        ];

        return view('dashboard/categories/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required|min_length[3]|max_length[30]',
            'parent' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->categoryModel->save([
            'parent'      => $this->request->getPost('parent') ?: 0,
            'name'        => $this->request->getPost('name'),
            'slogan'      => $this->request->getPost('slogan'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/dashboard/categories')->with('success', 'Categoria criada com sucesso!');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);

        $categoryModel = new CategoryModel();

        /**
         * Busca todas as categorias existentes (para o select de "Categoria Pai")
         */
        $parents = $categoryModel->orderBy('name', 'ASC')->findAll();

        if (!$category)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Categoria não encontrada');
        }

        $data = [
            'title' => 'Editar Categoria',
            'category' => $category,
            'parents' => $parents
        ];

        return view('dashboard/categories/edit', $data);
    }

    public function update($id)
    {
        $this->categoryModel->update($id, [
            'parent'      => $this->request->getPost('parent') ?: 0,
            'name'        => $this->request->getPost('name'),
            'slogan'      => $this->request->getPost('slogan'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/dashboard/categories')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to('/dashboard/categories')->with('success', 'Categoria removida com sucesso!');
    }
}