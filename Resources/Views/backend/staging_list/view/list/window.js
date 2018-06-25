
Ext.define('Shopware.apps.StagingList.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.emz-staging-list-window',
    height: 450,
    title : '{s name=window_title}Staging Übersicht{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.StagingList.view.list.List',
            listingStore: 'Shopware.apps.StagingList.store.Main'
        };
    }
});
