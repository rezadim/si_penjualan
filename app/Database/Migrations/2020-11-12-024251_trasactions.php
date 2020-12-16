<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Trasactions extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'trx_id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => true,
				'auto_increment' => true
			],
			'product_id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => true,
				'null' => true
			],
			'trx_price' => [
				'type' => 'DATE'
			]
		]);
		$this->forge->addKey('trx_id', true);
		$this->forge->addForeignKey('product_id', 'products','product_id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('trasactions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
