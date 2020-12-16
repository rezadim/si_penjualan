<?php namespace App\Models;
use CodeIgniter\Model;

class Transaction_model extends Model
{
    protected $table = 'trasactions';

    public function getTransaction($id = false)
    {
        if($id === false){
            return $this->table('trasactions')
                    ->select('products.product_name, trasactions.*')
                    ->JOIN('products', 'products.product_id = trasactions.product_id')
                    ->get()->getResultArray();
        }else{
            return $this->table('trasactions')
                    ->select('products.product_name', 'trasactions.*')
                    ->JOIN('products', 'products.product_id = trasactions.product_id')
                    ->where('trasactions.product_id', $id)
                    ->get()->getRowArray();
        }
        
    }
    public function insertTransaction($data)
    {
        return $this->db->table($this->table)->insert($data);
    }


}