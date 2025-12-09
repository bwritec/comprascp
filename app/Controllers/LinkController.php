<?php

    namespace App\Controllers;

    use CodeIgniter\Controller;
    use App\Models\LinkModel;


    /**
     *
     */
    class LinkController extends BaseController
    {
        /**
         *
         */
        public function index()
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            if ($user["admin"] !== '1')
            {
                return redirect()->to('/dashboard');
            }

            $model = new LinkModel();
            $data['links'] = $model->findAll();
            $data['title'] = "Links";

            return view('dashboard/links/index', $data);
        }

        /**
         *
         */
        public function create()
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            if ($user["admin"] !== '1')
            {
                return redirect()->to('/dashboard');
            }

            return view('dashboard/links/create', [
                'title' => "Novo Link"
            ]);
        }

        /**
         *
         */
        public function store()
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            if ($user["admin"] !== '1')
            {
                return redirect()->to('/dashboard');
            }

            $model = new LinkModel();
            $model->save([
                'name' => $this->request->getPost('name'),
                'url' => $this->request->getPost('url'),
                'open_in_new_window' => $this->request->getPost('open_in_new_window') ? 1 : 0,
            ]);

            return redirect()->to('/dashboard/links');
        }

        /**
         *
         */
        public function edit($id)
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            if ($user["admin"] !== '1')
            {
                return redirect()->to('/dashboard');
            }

            $model = new LinkModel();
            $data['link'] = $model->find($id);
            $data['title'] = "Editar Link";

            return view('dashboard/links/edit', $data);
        }

        /**
         *
         */
        public function update($id)
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            if ($user["admin"] !== '1')
            {
                return redirect()->to('/dashboard');
            }

            $model = new LinkModel();
            $model->update($id, [
                'name' => $this->request->getPost('name'),
                'url' => $this->request->getPost('url'),
                'open_in_new_window' => $this->request->getPost('open_in_new_window') ? 1 : 0,
            ]);

            return redirect()->to('/dashboard/links');
        }

        /**
         *
         */
        public function delete($id)
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            if ($user["admin"] !== '1')
            {
                return redirect()->to('/dashboard');
            }

            $model = new LinkModel();
            $model->delete($id);

            return redirect()->to('/dashboard/links');
        }
    }
