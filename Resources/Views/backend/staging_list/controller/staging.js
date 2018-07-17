
Ext.define('Shopware.apps.StagingList.controller.Staging', {
    extend: 'Enlight.app.Controller',

    init: function () {
        var me = this;
console.log('inStagingController');
        me.control({
            'staginglist-staging-main': {
                startProcess: me.onStartProcess
            },

            'emz-staging-listing-grid': {
                createStagingWindow: me.onCreateStagingWindow
            }
        });

        me.callParent(arguments);
    },

    onCreateStagingWindow: function(){
        var me = this;
console.log('onCreateStagingWindow');
        me.window = me.getView('staging.Main').create({ }).show();
    },

    onStartProcess: function(win, btn){
        var me = this;

        me.batchConfig = me.getBatchConfig(win);

        me.runRequest(0, win);
    },

    getBatchConfig: function (win) {
        var me = this;

        return {
            batchSize: 20,
            snippet: 'win.snippets.batch.process',
            totalCount: 23,
            progress: win.stagingProgress,
            requestUrl: '{url controller="StagingList" action="createStaging"}',
            params: {
                albumId: -1
            }
        }
    },

    runRequest: function (offset, win) {
        var me = this,
                config = me.batchConfig,
                params = config.params;

        me.errors = me.errors || [];

        // if cancel button was pressed
        if (me.cancelOperation) {
            win.closeButton.enable();
            return;
        }

        if (config.progress) {
            // sets a new progress status
            config.progress.updateProgress(
                    (offset + config.batchSize) / config.totalCount,
                    Ext.String.format(
                            config.snippet,
                            (offset + config.batchSize) > config.totalCount ? config.totalCount : (offset + config.batchSize),
                            config.totalCount
                    ),
                    true
            );
        }

        params.offset = offset;
        params.limit = config.batchSize;

        // Sends a request to create new thumbnails according to the batch informations
        Ext.Ajax.request({
            url: config.requestUrl,
            method: 'POST',
            params: params,
            timeout: 4000000,
            success: function (response) {
                var operation = Ext.decode(response.responseText);

                if (operation.success !== true) {
                    me.errors.push(operation.message);
                }

                if (operation.fails && operation.fails.length > 0) {
                    Shopware.Notification.createGrowlMessage(
                        "",
                        operation.fails.join("\n<br>")
                    );
                }

                var newOffset = (offset + config.batchSize);

                if (newOffset > config.totalCount) {
                    config.batchSize = config.totalCount - offset;
                    newOffset = (offset + config.batchSize);
                }

                if (newOffset === config.totalCount) {
                    me.batchConfig.progress.updateText(me.snippets.finished);
                    me.onProcessFinish(win);
                    return;
                }

                me.runRequest(newOffset, win);
            },
            failure: function (response) {
                Shopware.Msg.createStickyGrowlMessage({
                    title: '{s name=thumbnail/batch/timeOutTitle}An error occured{/s}',
                    text: "{s name=thumbnail/batch/timeOut}The server could not handle the request. Please choose a smaller batch size.{/s}"
                });

                me.onProcessFinish(win);
            }
        });
    },

    /**
     * Will be called when every thumbnails were generated
     *
     * @param win
     */
    onProcessFinish: function (win) {
        var me = this;

        if (!Ext.isEmpty(me.errors)) {
            var message = me.errors.join("\n");

            Shopware.Msg.createStickyGrowlMessage({
                title: me.snippets.errorTitle,
                text: me.snippets.errorMessage + '\n' + message
            });

            me.errors = [];
        }

        win.cancelButton.hide();
        win.closeButton.enable();
    }
});
