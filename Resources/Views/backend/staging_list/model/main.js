
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
        { name : 'createdOn', type: 'date' },
    ]
});
