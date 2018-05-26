
Ext.define('Shopware.apps.StagingList.store.Main', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'StagingList'
        };
    },
    model: 'Shopware.apps.StagingList.model.Main'
});
