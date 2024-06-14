<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Follow extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'following_user_id' => [
                'type' => 'INT',
                'usigned' => true,
            ],
            'followed_user_id' => [
                'type' => 'INT',
                'usigned' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('following_user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('followed_user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable(follow);
    }

    public function down()
    {
        $this->forge->dropTable(follow);
    }
}
