
Ext.define('Shopware.apps.StagingList.model.Main', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'StagingList',
            detail: 'Shopware.apps.StagingList.view.detail.Container'
        };
    },


    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'name', type: 'string' },
        { name : 'directory', type: 'string' },
        { name : 'createdOn', type: 'date', useNull: false },
        { name : 'dbHost', type: 'string' },
        { name : 'dbPort', type: 'string' },
        { name : 'dbName', type: 'string' },
        { name : 'dbUser', type: 'string' },
        { name : 'dbPassword', type: 'string' },
        { name : 'excludedFolders', type: 'string' },
        { name : 'displayErrors', type: 'boolean' },
        { name : 'disableCsrfToken', type: 'boolean' },
        { name : 'deactivateCompilerCaching', type: 'boolean' },
        { name : 'activateMaintenance', type: 'boolean' },
        { name : 'moveMediaDir', type: 'boolean' },
    ]
});
