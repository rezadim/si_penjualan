<?php namespace App\Controllers;

use App\Models\Auth_model;

class Auth extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        $this->cek_login();
        $this->auth_model = new Auth_model;
    }
    
    public function index()
    {
        if($this->cek_login() == true){
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }
    public function login()
    {
        if($this->cek_login() == true){
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }
    public function proses_login()
    {
        $validation = \Config\Services::validation();

        $username = $this->request->getPost('username');
        $pass = $this->request->getPost('password');

        $data = [
            'username' => $username,
            'password' => $pass
        ];

        if($validation->run($data, 'authlogin') == false){
            session()->setFlashdata('errors', $validation->getErrors());

            return redirect()->to('/auth/login');
        }else{
            $cek_login = $this->auth_model->cek_login($username);

            if($cek_login == true){
                if(password_verify($pass, $cek_login['password'])){
                    session()->set('email', $cek_login['email']);
                    
                    session()->set('name', $cek_login['name']);
                    session()->set('level', $cek_login['level']);
                    session()->set('status', $cek_login['status']);

                    return redirect()->to('/dashboard');
                }else{
                    session()->setFlashdata('errors', [''=>'Password salah']);

                    return redirect()->to('/auth/login');
                }
            }else{
                session()->setFlashdata('errors', [''=> 'Username belum terdaftar']);

                return redirect()->to('/auth/login');
            }
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/auth/login');
    }


}