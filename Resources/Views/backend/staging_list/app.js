
Ext.define('Shopware.apps.StagingList', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.StagingList',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main', 'Staging' ],

    views: [
        'list.Window',
        'list.List',

        'detail.Container',
        'detail.Window',

        'staging.Main',
        'staging.Thumbnails',
    ],

    models: [ 'Main' ],
    stores: [ 'Main' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});
