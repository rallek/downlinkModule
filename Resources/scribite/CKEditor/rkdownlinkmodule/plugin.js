CKEDITOR.plugins.add('rkdownlinkmodule', {
    requires: 'popup',
    init: function (editor) {
        editor.addCommand('insertRKDownlinkModule', {
            exec: function (editor) {
                RKDownlinkModuleFinderOpenPopup(editor, 'ckeditor');
            }
        });
        editor.ui.addButton('rkdownlinkmodule', {
            label: 'Downlink',
            command: 'insertRKDownlinkModule',
            icon: this.path.replace('scribite/CKEditor/rkdownlinkmodule', 'images') + 'admin.png'
        });
    }
});
