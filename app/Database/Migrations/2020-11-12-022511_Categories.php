<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'category_id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => true,
				'auto_increment' => true
			],
			'category_name' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'category_status' => [
				'type' => 'ENUM',
				'constraint' => "'Active', 'Inactive'",
				'default' => 'Active'
			]
		]);
		$this->forge->addKey('category_id', true);
		$this->forge->createTable('categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
