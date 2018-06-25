Ext.define('Shopware.apps.StagingList.view.detail.Window', {
    extend : 'Shopware.window.Detail',
    alias : 'widget.emz-staging-detail-window',
    title : '{s name=title}Staging Detailansicht{/s}',
    height: 420,
    width: 900,

    /**
     * Initialize the component
     * @return void
     */
    initComponent : function () {
        var me = this;

        me.callParent(arguments);
    },
});
