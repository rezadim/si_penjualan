<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $category = [
		'category_name' => 'required',
		'category_status' => 'required'
	];
	public $category_errors = [
		'category_name' => ['required' => 'Nama kategori harus diisi'],
		'category_status' => ['required' => 'Status Kategori harus diisi']
	];

	public $product = [
		'category_id'=> 'required',
		// 'product_name'=>'required',
		'product_price'=>'required',
		'product_sku'=>'required',
		'product_status'=>'required',
		'product_image'=>'uploaded[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[product_image,50000]',
		'product_description'=>'required'
	];
	public $product_errors = [
		'category_id'=>['required'=>'Kategori harus diisi'],
		// 'product_name'=>['required'=>'Nama Produk harus diisi'],
		'product_price'=>['required'=>'Harga produk harus diisi'],
		'product_sku'=>['required'=>'Kode produk harus diisi'],
		'product_status'=>['required'=>'Status produk harus diisi'],
		'product_image'=>[
			'mime_in' => 'Gambar produk hanya boleh diisi dengan jpg, jpeg, png atau gif',
			'max_size' => 'Gambar produk maksimal 5gb',
			'uploaded' => 'Gambar produk harus diisi'
		],
		'product_description'=>['required'=>'Deskripsi harus diisi']
	];

	public $transaction = [
		'trx_file' => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,10000]',
	];
	public $transaction_errors = [
		'trx_file' => [
			'ext_in' => 'File hanya boleh diisi dengan xls atau xlsx',
			'max_size' => 'File Excel product maxsimal 1gb',
			'uploaded' => 'File Excel product harus diisi'
		]
	];

	public $authlogin = [
		'username' => 'required',
		'password' => 'required'
	];
	public $authlogin_errors = [
		'username' => [
			'required' => 'Username harus diisi',
			// 'valid_email' => 'Email tidak valid'
		],
		'password' => [
			'required' => 'Password harus diisi'
		]
	];
}
