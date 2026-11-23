<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Read-only metadata check. Never prints credentials or account records.
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

try {
    config(['database.connections.mysql.options' => array_replace(
        config('database.connections.mysql.options', []),
        [PDO::ATTR_TIMEOUT => 5],
    )]);
    $connection = DB::connection();
    $connection->getPdo();
    echo 'connection=ok'.PHP_EOL;
    $database = $connection->selectOne('SELECT DATABASE() AS selected_database')->selected_database;
    echo 'database_matches_team='.($database === 'SI4809_PPL_D' ? 'yes' : 'no').PHP_EOL;
    echo 'users='.(Schema::hasTable('users') ? 'yes' : 'no').PHP_EOL;
    echo 'role='.(Schema::hasColumn('users', 'role') ? 'yes' : 'no').PHP_EOL;
    $columns = $connection->select("SELECT COLUMN_NAME, COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'users' AND COLUMN_NAME IN ('role', 'password')");
    foreach ($columns as $column) {
        echo $column->COLUMN_NAME.'_type='.$column->COLUMN_TYPE.PHP_EOL;
    }
} catch (Throwable $exception) {
    echo 'connection=failed; exception='.get_class($exception).'; code='.$exception->getCode().PHP_EOL;
    exit(1);
}
