
Ext.define('Shopware.apps.StagingList.view.list.List', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.emz-staging-listing-grid',
    region: 'center',

    snippets: {
        batch: {
            label: '{s name=thumbnail/batch/label}Batch size{/s}',
            help: '{s name=thumbnail/batch/help}How many records should be processed per request? Default: 30{/s}',
            cancel: '{s name=thumbnail/batch/cancel}Cancel process{/s}',
            start: '{s name=thumbnail/batch/start}Start process{/s}',
            close: '{s name=thumbnail/batch/close}Close window{/s}',
            process: '{s name=thumbnail/batch/thumbnails}Creating thumbnails for [0]/[1] images{/s}'
        }
    },

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
            iconCls: 'sprite-cookie--plus',
            action: 'staginglist-list-list-prepare-staging',
            handler: function(){
                me.fireEvent('prepareProcess', me);
            }
        });

        items.push({
            action: 'actionName', iconCls: 'sprite-arrow-circle-315', handler: function() {

            }
        });

        return items;
    },
});
