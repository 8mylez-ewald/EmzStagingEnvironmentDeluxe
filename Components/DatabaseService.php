<?php

namespace EmzStagingEnvironmentDeluxe\Components;

use Doctrine\DBAL\Connection;

class DatabaseService {
    
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createDatabase() {

    }

    public function exportDatabase() {

    }

    public function importDatabase() {
        
    }

    public function syncDatabaseTable($tableName, $offset, $limit) {
        //1. Get all Tables --> use ajax here
        //2. Foreach table --> single request for every table
        //3. Get COUNT(*) for table --> to have the max results
        //4. Copy Database Items to new Database
        //5. Finish!
    }
}