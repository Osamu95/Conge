<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatutsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'unique' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('statuts');
    }

    public function down()
    {
        $this->forge->dropTable('statuts');
    }
}