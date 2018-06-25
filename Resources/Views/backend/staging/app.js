
Ext.define('Shopware.apps.Staging', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.Staging',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'config.Window',
        'check.Window',
    ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});
