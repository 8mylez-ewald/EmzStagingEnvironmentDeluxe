
Ext.define('Shopware.apps.StagingList.view.list.List', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.emz-staging-listing-grid',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.StagingList.view.detail.Window',
            columns: {
                name: {
                    header: 'Name'
                },
                createdOn: {
                    header: 'Erstellt am',
                    format: 'd.m.Y',
                    editor: undefined
                }
            }
        };
    },

    createActionColumnItems: function() {
        var me = this,
            items = me.callParent(arguments);

        items.push({
            action: 'actionName', iconCls: 'sprite-arrow-circle-315', handler: function() {
                console.log('hi');
            }
        });

        return items;
    }
});
