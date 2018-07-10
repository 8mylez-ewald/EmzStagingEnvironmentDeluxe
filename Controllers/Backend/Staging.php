<?php

class Shopware_Controllers_Backend_Staging extends Shopware_Controllers_Backend_ExtJs
{
    public function syncDatabaseTableAction()
    {
        $offset = $this->Request()->getParam('offset');
        $limit = $this->Request()->getParam('limit');
        $tableName = $this->Request()->getParam('tableName');

        $databaseService = $this->get('emz_sed.database_service');

        $count = $databaseService->syncDatabaseTable($tableName, $offset, $limit);

        $this->View()->assign([
            'success' => true,
            'data' => ['count' => $count]
        ]);
    }
}