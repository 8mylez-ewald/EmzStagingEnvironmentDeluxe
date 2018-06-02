
Ext.define('Shopware.apps.Staging.controller.Main', {
    extend: 'Enlight.app.Controller',

    init: function() {
        var me = this;
        me.mainWindow = me.getView('config.Window').create({ }).show();

        me.control({
            'staging-main-config button[action=proceedStaging]' : {
                'click' : function(btn) {
                    this.onStagingSave(btn);
                }
            },
        });

        me.callParent(arguments);
    },

    onStagingSave: function(btn) {
        // var win     = btn.up('window'), // Get Window
        //     form    = win.down('form'), // Get the DOM Form used in that window
        //     formBasis = form.getForm(), // Extract the form from the DOM
        //     me      = this,             // copy the current scope to me, because the 'this' scope tends to change
        //     record  = form.getRecord();   // retrieve the record
        //
        // if (!(record instanceof Ext.data.Model)){
        //     record = Ext.create('Shopware.apps.StagingList.model.Main');
        // }
        //
        // formBasis.updateRecord(record);
        //
        // // Check if there the form is valid -> see model/supplier.js
        // if (formBasis.isValid()) {
        //     record.save();
        // }
        //
        //
        var me = this;

        me.subApplication.setAppWindow(me.getView('check.Window').create({ }));
        me.mainWindow.close();
    }
});
