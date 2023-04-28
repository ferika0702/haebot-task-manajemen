<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Task extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'=>[
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'start_time'=>[
                'type' => 'DATE',
                'null' => true,
            ],
            'end_time'=>[
                'type' => 'DATE',
                'null' => true,
            ],
            'status'=>[
                'type'           => 'ENUM',
                'constraint'     => "'ON','OFF'",
                'null'           => true,
                'default'        => 'ON'
            ],            
            'list_frequency'=>[
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'list_absen'=>[
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('task');
    }

    public function down()
    {
        $this->forge->dropTable('task');
    }
}
