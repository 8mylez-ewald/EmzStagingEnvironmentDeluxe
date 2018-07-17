
Ext.define('Shopware.apps.StagingList.controller.Main', {
    extend: 'Enlight.app.Controller',

    snippets: {
        errorTitle: '{s name=error/title}Error{/s}',
        errorMessage: '{s name=thumbnail/batch/error_message}An error has occurred while generating the item thumbnails:{/s}',
        finished: '{s name=thumbnail/batch/finished}Finished{/s}'
    },

    init: function() {
        var me = this;
        me.mainWindow = me.getView('list.Window').create({ }).show();

        me.control({
            'emz-staging-listing-grid': {
                prepareProcess: me.onPrepareProcess
            }
        });

        me.callParent(arguments);
    },

    onPrepareProcess: function (window){
        var me = this;
console.log('onPrepareProcess');
        window.fireEvent('createStagingWindow');
    },
});
