<?php namespace App\Models;

use CodeIgniter\Model;

class Dashboard_model extends Model
{
    protected $table = 'trasactions';

    public function getCountTrx()
    {
        return $this->db->table("trasactions")->countAll();
    }
    public function getCountCategory()
    {
        return $this->db->table("categories")->countAll();
    }
    public function getCountProduct()
    {
        return $this->db->table("products")->countAll();
    }
    public function getCountUser()
    {
        return $this->db->table("users")->countAll();
    }
    public function getGrafik()
    {
        $query = $this->db->query("SELECT trx_price, MONTHNAME(trx_date) as month, COUNT(product_id) as total FROM trasactions GROUP BY MONTH(trx_date)");
        $hasil = [];

        if(!empty($query)){
            foreach($query->getResultArray() as $data){
                $hasil[] = $data;
            }
        }
        return $hasil;
    }
    public function getLatestTrx()
    {
        return $this->table("trasactions")
                    ->select('products.product_name, trasactions.*')
                    ->join('products', 'products.product_id = trasactions.product_id')
                    ->orderBy('trasactions.trx_id', 'desc')
                    ->limit(5)->get()->getResultArray();
    }


}