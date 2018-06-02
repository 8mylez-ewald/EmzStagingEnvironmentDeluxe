
Ext.define('Shopware.apps.StagingList.controller.Main', {
    extend: 'Enlight.app.Controller',

    init: function() {
        var me = this;
        me.mainWindow = me.getView('list.Window').create({ }).show();

        me.control({
            'emz-staging-listing-grid': {
                'main-add-item': me.onAddItem,
            },
        });

        me.callParent(arguments);
    },

    onAddItem: function() {
        var me = this;

        Shopware.app.Application.addSubApplication({
            name: 'Shopware.apps.Staging'
        });
    }
});
