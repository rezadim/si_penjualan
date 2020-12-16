<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'product_id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => true,
				'auto_increment' => true
			],
			'category_id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => true,
				'null' => true
			],
			'product_name' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'product_price' => [
				'type' => 'INT',
				'constraint' => '20',
			],
			'product_sku' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'product_status' => [
				'type' => 'ENUM',
				'constraint' => "'Active', 'Inactive'",
				'default' => 'Active'
			],
			'product_image' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => true
			],
			'product_description' => [
				'type' => 'TEXT',
				'null' => true
			]
		]);

		$this->forge->addKey('product_id', true);
		$this->forge->addForeignKey('category_id', 'categories', 'category_id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('products');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
