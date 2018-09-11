
Ext.define('Shopware.apps.StagingList.controller.Staging', {
    extend: 'Enlight.app.Controller',

    snippets: {
        errorTitle: '{s name=error/title}Error{/s}',
        errorMessage: '{s name=thumbnail/batch/error_message}An error has occurred while generating the item thumbnails:{/s}',
        finished: '{s name=thumbnail/batch/finished}Finished{/s}'
    },

    batchSize: 20,

    init: function () {
        var me = this;

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

        me.window = me.getView('staging.Main').create({ }).show();
    },

    onStartProcess: function(win, btn){
        var me = this;

        me.batchConfig = me.getBatchConfig(win);

        setTimeout(function() {
            me.runRequest(0, win);
        }, 500);

    },

    getBatchConfig: function (win) {
        var me = this;

        me.getTotalImages();

        return {
            batchSize: 20,
            snippet: 'win.snippets.batch.process',
            totalCount: me.totalImages,
            progress: win.stagingProgress,
            requestUrl: '{url controller="StagingList" action="createStaging"}',
            params: {
                offset: 0
            }
        }
    },

    getTotalImages: function(){
        var me = this;

        Ext.Ajax.request({
            url: '{url controller="StagingList" action="getTotalImages"}',
            async: false,
            method: 'POST',
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

                me.totalImages = operation.totalCount;

            },
            failure: function (response) {
                Shopware.Msg.createStickyGrowlMessage({
                    title: '{s name=thumbnail/batch/timeOutTitle}An error occured{/s}',
                    text: "{s name=thumbnail/batch/timeOut}The server could not handle the request. Please choose a smaller batch size.{/s}"
                });
            }
        });
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
     * Will be called when every media were copied
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
        win.close();

        me.Window = me.getView('staging.Thumbnails').create({ }).show();
        me.getAlbums();
        // console.log(me.allAlbums);
        me.startProcessThumbnail();
    },

    getAlbums: function(){
        var me = this;
        Ext.Ajax.request({
            url: '{url controller="StagingList" action="getAlbums"}',
            async: false,
            method: 'POST',
            timeout: 4000000,
            success: function (response) {
                var operation = Ext.decode(response.responseText);

                if (operation.success !== true) {

                }

                me.allAlbums = operation.albums;
            }
        });
    },

    startProcessThumbnail: function(){
        var me = this;

        // me.allAlbums.forEach(function(value) {
        //     setTimeout(function() {
        console.log(me.allAlbums);
        value = me.allAlbums[0];
        console.log(value);
        if(value){
            console.log('value set');
                me.batchConfigThumbnail = {
                    batchSize: 20,
                    snippet: 'Creating thumbnails for [0]/[1] images',
                    totalCount: value.amount,
                    params: {
                        albumId: value.id,
                        offset: 0,
                        limit: 20
                    },
                    progress: me.thumbnailProgress,
                    requestUrl: '{url controller="MediaManager" action="createThumbnails"}',
                };
                me.runRequestThumbnail(0, me);
        //     }, 500);
        // });
        }else{
            console.log('value undefined');
            me.onProcessThumbnailFinish(me);
        }


        // me.allAlbums.forEach(function(value) {
            // console.log(value.amount);
            // console.log(value.id);
            // me.batchConfigThumbnail = {
            //     batchSize: 20,
            //     snippet: 'Creating thumbnails for [0]/[1] images',
            //     totalCount: value.amount,
            //     params: {
            //         albumId: value.id,
            //         offset: 0,
            //         limit: 20
            //     },
            //     progress: me.thumbnailProgress,
            //     requestUrl: '{url controller="MediaManager" action="createThumbnails"}',
            // };
            //
            // setTimeout(function() {
            //     me.runRequestThumbnail(0, me);
            // }, 500);
        // });
    },

    runRequestThumbnail: function (offset, win) {
        var me = this,
            config = me.batchConfigThumbnail,
            params = config.params;
            console.log('runRequestThumbnail');

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

        console.log(params, 'params');

        // Sends a request to create new thumbnails according to the batch informations
        Ext.Ajax.request({
            url: config.requestUrl,
            method: 'POST',
            params: params,
            async: false,
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
// console.log(newOffset, 'newOffset');
// console.log(config, 'config');

                if (newOffset == config.totalCount) {
                    // me.batchConfigThumbnail.progress.updateText(me.snippets.finished);
                    me.allAlbums.shift();
                    me.startProcessThumbnail();
                    return;
                }
// console.log(newOffset,'newOffset');
// console.log(win, 'win');
                me.runRequestThumbnail(newOffset, win);
            },
            failure: function (response) {
                Shopware.Msg.createStickyGrowlMessage({
                    title: '{s name=thumbnail/batch/timeOutTitle}An error occured{/s}',
                    text: "{s name=thumbnail/batch/timeOut}The server could not handle the request. Please choose a smaller batch size.{/s}"
                });

                // me.onProcessFinishThumbnail(win);
            }
        });
    },

    /**
     * Will be called when every thumbnails were generated
     *
     * @param win
     */
    onProcessThumbnailFinish: function (win) {
        var me = this;

        if (!Ext.isEmpty(me.errors)) {
            var message = me.errors.join("\n");

            Shopware.Msg.createStickyGrowlMessage({
                title: me.snippets.errorTitle,
                text: me.snippets.errorMessage + '\n' + message
            });

            me.errors = [];
        }

        console.log(win);
        console.log(me);
        // win.cancelButton.hide();
        // win.closeButton.enable();
        me.window.close();
    },
});
