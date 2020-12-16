<?php namespace App\Database\Seeds;

class AdminSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
                'username' => 'admin',
                'name'=> 'admin',
                'email'=>'admin@admin.com',
                'password'=>'$2y$10$5ZTQs4eFKf.4ariOHJ5NKOqgb.8VlZSljSG2R8x/dDu7xKXvts.B6',
                'status'=>'Active',
                'level'=>'Admin'
        ];

        $this->db->table('users')->insert($data);
    }
}