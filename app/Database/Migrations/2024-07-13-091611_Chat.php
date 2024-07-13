<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Chat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'created_by_user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'chat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('created_by_user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('chat');
    }

    public function down()
    {
        $this->forge->dropTable('chat');
    }
}
