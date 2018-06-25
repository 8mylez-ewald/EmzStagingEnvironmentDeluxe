
Ext.define('Shopware.apps.StagingList.view.detail.Container', {
    extend: 'Shopware.model.Container',
    padding: 20,

    configure: function() {
        var me = this;

        return {
            controller: 'StagingList',
            fieldSets: [
                {
                    title: 'Grundeinstellungen',
                    fields: {
                        name: {
                            fieldLabel: 'Name'
                        },
                        directory: {
                            fieldLabel: "Unterordner"
                        }
                    }
                },
                {
                    title: 'Datenbank-Konfiguration',
                    fields: {
                        dbHost: {
                            fieldLabel: 'Datenbank-Host'
                        },
                        dbPort: {
                            fieldLabel: 'Datenbank-Port'
                        },
                        dbName: {
                            fieldLabel: 'Datenbank-Name'
                        },
                        dbUser: {
                            fieldLabel: 'Datenbank-Benutzer'
                        },
                        dbPassword: {
                            fieldLabel: 'Datenbank-Passwort'
                        }
                    }
                },
                {
                    title: 'Erweiterte Einstellungen',
                    fields: {
                        excludedFolders: {
                            fieldLabel: 'Ausgeschlossene Ordner'
                        },
                        displayErrors: {
                            fieldLabel: 'Fehlermeldungen ausgeben',
                        },
                        disableCsrfToken: {
                            fieldLabel: 'CSRF-Token deaktivieren',
                            value: true
                        },
                        deactivateCompilerCaching: {
                            fieldLabel: 'Compiler-Caching deaktivieren',
                            value: true
                        },
                        activateMaintenance: {
                            fieldLabel: 'Wartungsmodus aktivieren',
                            value: true
                        },
                        moveMediaDir: {
                            fieldLabel: 'Media-Ordner mitkopieren',
                            value: true
                        }
                    }
                }
            ]
        };
    }
});
