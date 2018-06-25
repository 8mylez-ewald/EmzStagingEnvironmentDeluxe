
Ext.define('Shopware.apps.Staging.view.check.Window', {
    extend : 'Enlight.app.Window',
    alias : 'widget.staging-main-check',
    layout : 'fit',
    title : 'Checkliste',
    width : '80%',
    height : '90%',

    /**
     * Initialize the component
     * @return void
     */
    initComponent : function () {
        var me = this;
        me.items = [ me.getFormPanel() ];

        me.dockedItems = [{
            xtype: 'toolbar',
            dock: 'bottom',
            cls: 'shopware-toolbar',
            ui: 'shopware-ui',
            items: me.getButtons()
        }];

        me.callParent(arguments);
    },

    getFormPanel : function()
    {
        var me = this;
        return Ext.create('Ext.form.Panel', {
            collapsible : false,
            split       : false,
            region      : 'center',
            width       : '100%',
            autoScroll: true,
            defaults : {
                labelWidth  : 155,
                anchor      : '100%'
            },
            bodyPadding : 10,
            items : [
                Ext.create('Ext.form.FieldSet', {
                    alias:'widget.staging-database-field-set',
                    title : 'Datenbank',
                    defaults : {
                        labelWidth  : 155,
                        anchor      : '100%'
                    },
                    items : [
                        {
                            xtype       : 'textfield',
                            name        : 'dbHost',
                            fieldLabel  : 'Datenbank Host',
                            allowBlank  : false
                        },
                        {
                            xtype       : 'textfield',
                            name        : 'dbPort',
                            fieldLabel  : 'Datenbank Port',
                            allowBlank  : false
                        },
                        {
                            xtype       : 'textfield',
                            name        : 'dbName',
                            fieldLabel  : 'Datenbank Name',
                            allowBlank  : false
                        },
                        {
                            xtype       : 'textfield',
                            name        : 'dbUser',
                            fieldLabel  : 'Datenbank Benutzer',
                            allowBlank  : false
                        },
                        {
                            xtype       : 'textfield',
                            name        : 'dbPassword',
                            fieldLabel  : 'Datenbank Passwort',
                            allowBlank  : false
                        },
                    ]
                }),
                Ext.create('Ext.form.FieldSet', {
                    alias:'widget.staging-base-set',
                    title : 'Einstellungen',
                    defaults : {
                        labelWidth  : 155,
                        anchor      : '100%'
                    },
                    items : [
                        {
                            xtype       : 'textfield',
                            name        : 'name',
                            fieldLabel  : 'Name',
                            allowBlank  : false
                        },
                        {
                            xtype       : 'textfield',
                            name        : 'excludedFolders',
                            fieldLabel  : 'Ausgeschlossene Ordner',
                            supportText : 'Mehrere Ordner mit einem Komma trennen',
                            allowBlank  : true
                        },
                    ]
                }),
            ]
        });
    },

    getButtons : function()
    {
        var me = this;
        return ['->',
            {
                text    : 'Weiter',
                action  : 'proceedStaging',
                cls     : 'primary',
                formBind: true
            }
        ];
    },
});
