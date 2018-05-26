
Ext.define('Shopware.apps.StagingList.view.list.List', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.emz-staging-listing-grid',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.StagingList.view.detail.Window'
        };
    }
});
