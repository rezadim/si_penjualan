<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
			'type' => 'BIGINT',
			'constraint' => 20,
			'unsigned' => true,
			'auto_increment' => true
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null'=>true
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null'=>true
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint'=>'100',
				'null'=>true
			],
			'password'=>[
				'type'=>'VARCHAR',
				'constraint'=>'255'
			],
			'status'=>[
				'type'=>'ENUM',
				'constraint'=>"'Active', 'Inactive'",
				'default'=>'Active'
			],
			'level'=>[
				'type'=>'ENUM',
				'constraint'=>"'Admin', 'User'",
				'default'=>'Admin'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
