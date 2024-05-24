<?php

namespace Prism\Database\Migrations;

interface Migration
{
    public function up();
    public function down();
}
