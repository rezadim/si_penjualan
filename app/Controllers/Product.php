<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Product_model;
use App\Models\Category_model;

class Product extends Controller
{
    protected $helpers = [];

    public function __construct()
    {
        helper(['form']);
        $this->category_model = new Category_model();
        $this->product_model = new Product_model();
    }
    public function index()
    {
        $category = $this->request->getGet('category');
        $keyword = $this->request->getGet('keyword');

        $data['category'] = $category;
        $data['keyword'] = $keyword;

        $categories = $this->category_model->where('category_status', 'Active')->findAll();
        $data['categories'] = [''=>'Pilih Kategori'] + array_column($categories, 'category_name', 'category_id');

        //filter
        $where = [];
        $like = [];
        $or_like = [];

        if(!empty($category)){
            $like = ['products.product_name' => $keyword];
            $or_like = ['products.product_sku'=>$keyword, 'products.product_description'=>$keyword];
        }

        $paginate = 5;
        $data['products'] = $this->product_model->join('categories', 'categories.category_id = products.category_id')->where($where)->like($like)->orlike($or_like)->paginate($paginate, 'product');
        $data['pager'] = $this->product_model->pager;

        return view('product/index', $data);
    }
    public function create()
    {
        // $categories = $this->category_model->where('category_status', 'Active')->findAll();

        // $data['categories']= ['' => 'Pilih Kategori'] + array_column($categories, 'category_name', 'category_id');
        $data['categories'] = $this->category_model->where('category_status', 'Active')->findAll();

        return view('product/create', $data);
    }
    public function store()
    {
        $validation = \Config\Services::validation();

        //file upload
        $image = $this->request->getFile('product_image');
        //random nama file
        $name = $image->getRandomName();
        
        $nama  = "";
        if($this->request->getPost('product_name') != null){
            $nama = $this->request->getPost('product_name');
        }else{
            $nama = '-';
        }

        $data = [
            'category_id' => $this->request->getPost('category_id'),
            
            // 'product_name' => $this->request->getPost('product_name'),
            'product_name' => $nama,
            'product_price' => $this->request->getPost('product_price'),
            'product_sku' => $this->request->getPost('product_sku'),
            'product_status' => $this->request->getPost('product_status'),
            'product_image' => $name,
            'product_description' => $this->request->getPost('product_description')
        ];

        if($validation->run($data, 'product') == false){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());

            return redirect()->to(base_url('product/create'));
        }else{
            //upload file
            $image->move(ROOTPATH . 'public/uploads', $name);
            //insert
            $simpan = $this->product_model->insertProduct($data);
            if($simpan){
                session()->setFlashdata('success', 'Created');

                return redirect()->to(base_url('product'));
            }
        }
    }
    public function show($id)
    {
        $data['product'] = $this->product_model->getProduct($id);

        return view('product/show', $data);
    }
    public function edit($id)
    {
        $categories = $this->category_model->where('category_status', 'Active')->findAll();
        $data['categories'] = [''=>'Pilih Kategori'] + array_column($categories, 'category_name', 'category_id');

        $data['product'] = $this->product_model->getProduct($id);
        return view('product/edit', $data);
    }
    public function update()
    {
        $id = $this->request->getPost('product_id');

        $validation = \Config\Services::validation();

        //get file
        $image = $this->request->getFile('product_image');
        //random nama file
        $name = $image->getRandomName();

        $data = [
            'category_id'=>$this->request->getPost('category_id'),
            'product_name'=>$this->request->getPost('product_name'),
            'product_price'=>$this->request->getPost('product_price'),
            'product_sku'=>$this->request->getPost('product_sku'),
            'product_status'=>$this->request->getPost('product_status'),
            'product_image'=>$name,
            'product_description'=>$this->request->getPost('product_description')
        ];

        if($validation->run($data, 'product') == false){
            session()->setFlashdata('errors', $validation->getErrors());

            return redirect()->to(base_url('product/edit/'.$id));
        }else{
            $image->move(ROOTPATH . 'public/uploads', $name);

            $ubah = $this->product_model->updateProduct($data, $id);
            if($ubah){
                session()->setFlashdata('info', 'Updated');

                return redirect()->to(base_url('product'));
            }
        }

    }
    public function delete($id)
    {
        $hapus = $this->product_model->deleteProduct($id);
        if($hapus){
            session()->setFlashdata('warning', 'Deleted');

            return redirect()->to(base_url('product'));
        }
    }


}