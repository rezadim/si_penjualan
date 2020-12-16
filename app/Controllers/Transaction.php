<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Product_model;
use App\Models\Transaction_model;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Transaction extends Controller
{
    protected $helpers = [];

    public function __construct()
    {
        helper(['form']);
        $this->transaction_model = new Transaction_model();
        $this->product_model = new Product_model();
    }
    public function index()
    {
        $data['transactions'] = $this->transaction_model->getTransaction();
        
        return view('transaction/index', $data);
    }

    public function import()
    {
        return view('transaction/import');
    }
    public function proses_import()
    {
        $validation = \Config\Services::validation();

        $file = $this->request->getFile('trx_file');

        $data = [
            'trx_file' => $file,
        ];

        if($validation->run($data, 'transaction') == false){
            session()->setFlashdata('errors', $validation->getErrors());

            return redirect()->to(base_url('transaction/import'));
        }else{
            $extension = $file->getClientExtension();

            if('xls' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }else{
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach($data as $idx => $row){
                if($idx === 0){
                    continue;
                }

                $product_id = $row[0];
                $trx_date = $row[1];
                $trx_price = $this->getTrxPrice($row[0]);

                $data = [
                    'product_id' => $product_id,
                    'trx_date' => date('Y-m-d', strtotime($trx_date)),
                    'trx_price' => $trx_price
                ];

                $simpan = $this->transaction_model->insertTransaction($data);
            }
            if($simpan){
                session()->setFlashdata('success', 'Imported');
                return redirect()->to(base_url('transaction'));
            }
        }

    }

    public function getTrxPrice($product_id)
    {
        $price = $this->product_model->getPrice($product_id);
        $data = $price['product_price'];

        return $data;
    }

    public function export()
    {
        $transactions = $this->transaction_model->getTransaction();

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // $$sheet->setActiveSheetIndex(0)
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Product');
        $sheet->setCellValue('C1', 'Date');
        $sheet->setCellValue('D1', 'Price');

        $kolom = 2;
        $no = 1;

        foreach($transactions as $data){
            // $sheet->setActiveSheetIndex(0)
            $sheet->setCellValue('A'.$kolom, $no);
            $sheet->setCellValue('B'.$kolom, $data['product_name']);
            $sheet->setCellValue('C'.$kolom, date('j F Y', strtotime($data['trx_date'])));
            $sheet->setCellValue('D'.$kolom, "Rp.".number_format($data['trx_price']));

            $kolom++;
            $no++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Transaction.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

    }


}