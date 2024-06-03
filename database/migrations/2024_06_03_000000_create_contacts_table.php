<?php

use Prism\Database\DB;
use Prism\Database\Migrations\Migration;

return new class() implements Migration {
    public function up() {
        DB::statement('CREATE TABLE contacts (id INT AUTO_INCREMENT PRIMARY KEY)');
    }
    
    public function down() {
        DB::statement('DROP TABLE contacts');
    }
};