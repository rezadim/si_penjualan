<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Category_model;

class Category extends Controller
{
    public function __construct()
    {
        $this->model = new Category_model();
    }
    public function index()
    {
        // $model = new Category_model();
        $data['categories'] = $this->model->getCategory();

        return view('category/index', $data);
    }
    public function create()
    {
        return view('category/create');
    }
    public function store()
    {
        $validation = \Config\Services::validation();

        $data = [
            'category_name' => $this->request->getPost('category_name'),
            'category_status' => $this->request->getPost('category_status')
        ];

        if($validation->run($data, 'category') == false){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());

            return redirect()->to(base_url('category/create'));
        }else{
            // $model = new Category_model();
            $simpan = $this->model->insertCategory($data);
            if($simpan){
                session()->setFlashdata('success', 'Created');
                return redirect()->to(base_url('category'));
            }
        }
    }
    public function edit($id)
    {
        $data['category'] = $this->model->getCategory($id)->getRowArray();

        return view('category/edit', $data);
    }
    public function update()
    {
        $id = $this->request->getPost('category_id');

        $validation = \Config\Services::validation();

        $data = [
            'category_name' => $this->request->getPost('category_name'),
            'category_status' => $this->request->getPost('category_status')
        ];

        if($validation->run($data, 'category') == false){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());

            return redirect()->to(base_url('category/edit/'.$id));
        }else{
            $ubah = $this->model->updateCategory($data, $id);
            if($ubah){
                session()->setFlashdata('info', 'Updated');

                return redirect()->to(base_url('category'));
            }
        }
    }
    public function delete($id)
    {
        $hapus = $this->model->deleteCategory($id);

        if($hapus){
            session()->setFlashdata('warning', 'Deleted');

            return redirect()->to(base_url('category'));
        }
    }
    

}