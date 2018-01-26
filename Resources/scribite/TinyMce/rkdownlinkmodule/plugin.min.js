/**
 * Initializes the plugin, this will be executed after the plugin has been created.
 * This call is done before the editor instance has finished it's initialization so use the onInit event
 * of the editor instance to intercept that event.
 *
 * @param {tinymce.Editor} ed Editor instance that the plugin is initialised in
 * @param {string} url Absolute URL to where the plugin is located
 */
tinymce.PluginManager.add('rkdownlinkmodule', function(editor, url) {
    var icon;

    icon = Zikula.Config.baseURL + Zikula.Config.baseURI + '/web/modules/rkdownlink/images/admin.png';

    editor.addButton('rkdownlinkmodule', {
        //text: 'Downlink',
        image: icon,
        onclick: function() {
            RKDownlinkModuleFinderOpenPopup(editor, 'tinymce');
        }
    });
    editor.addMenuItem('rkdownlinkmodule', {
        text: 'Downlink',
        context: 'tools',
        image: icon,
        onclick: function() {
            RKDownlinkModuleFinderOpenPopup(editor, 'tinymce');
        }
    });

    return {
        getMetadata: function() {
            return {
                title: 'Downlink',
                url: 'http://k62.de'
            };
        }
    };
});
