var rkdownlinkmodule = function(quill, options) {
    setTimeout(function() {
        var button;

        button = jQuery('button[value=rkdownlinkmodule]');

        button
            .css('background', 'url(' + Zikula.Config.baseURL + Zikula.Config.baseURI + '/web/modules/rkdownlink/images/admin.png) no-repeat center center transparent')
            .css('background-size', '16px 16px')
            .attr('title', 'Downlink')
        ;

        button.click(function() {
            RKDownlinkModuleFinderOpenPopup(quill, 'quill');
        });
    }, 1000);
};
