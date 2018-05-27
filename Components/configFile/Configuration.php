<?php

namespace EmzStagingEnvironmentDeluxe\Components\ConfigFile;

class Configuration {
    
    private $subFolder;
    private $databaseUsername;
    private $databasePassword;
    private $databaseName;
    private $databaseHost;
    private $databasePort;

    public function __construct() {
        
        $this->subFolder = 'staging';
        $this->databaseUsername = 'stagingDatabaseUsername';
        $this->databasePassword = 'stagingDatabasePassword';
        $this->databaseName = 'stagingDatabaseName';
        $this->databaseHost = 'db_emz';
        $this->databasePort = '3306';
    }

    public function getSubFolder() {
        return $this->subFolder;
    }

    public function setSubFolder($subFolder) {
        $this->subFolder = $subFolder;
    }

    public function getDatabaseUsername() {
        return $this->databaseUsername;
    }

    public function setDatabaseUsername($databaseUsername) {
        $this->databaseUsername = $databaseUsername;
    }

    public function getDatabasePassword() {
        return $this->databasePassword;
    }

    public function setDatabasePassword($databasePassword) {
        $this->databasePassword = $databasePassword;
    }

    public function getDatabaseName() {
        return $this->databaseName;
    }

    public function setDatabaseName($databaseName) {
        $this->databaseName = $databaseName;
    }

    public function getDatabaseHost() {
        return $this->databaseHost;
    }

    public function setDatabaseHost($databaseHost) {
        $this->databaseHost = $databaseHost;
    }

    public function getDatabasePort() {
        return $this->databasePort;
    }

    public function setDatabasePort($databasePort) {
        $this->databasePort = $databasePort;
    }
}