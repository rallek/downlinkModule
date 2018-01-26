'use strict';

var rKDownlinkModule = {};

rKDownlinkModule.itemSelector = {};
rKDownlinkModule.itemSelector.items = {};
rKDownlinkModule.itemSelector.baseId = 0;
rKDownlinkModule.itemSelector.selectedId = 0;

rKDownlinkModule.itemSelector.onLoad = function (baseId, selectedId) {
    rKDownlinkModule.itemSelector.baseId = baseId;
    rKDownlinkModule.itemSelector.selectedId = selectedId;

    // required as a changed object type requires a new instance of the item selector plugin
    jQuery('#rKDownlinkModuleObjectType').change(rKDownlinkModule.itemSelector.onParamChanged);

    jQuery('#' + baseId + '_catidMain').change(rKDownlinkModule.itemSelector.onParamChanged);
    jQuery('#' + baseId + '_catidsMain').change(rKDownlinkModule.itemSelector.onParamChanged);
    jQuery('#' + baseId + 'Id').change(rKDownlinkModule.itemSelector.onItemChanged);
    jQuery('#' + baseId + 'Sort').change(rKDownlinkModule.itemSelector.onParamChanged);
    jQuery('#' + baseId + 'SortDir').change(rKDownlinkModule.itemSelector.onParamChanged);
    jQuery('#rKDownlinkModuleSearchGo').click(rKDownlinkModule.itemSelector.onParamChanged);
    jQuery('#rKDownlinkModuleSearchGo').keypress(rKDownlinkModule.itemSelector.onParamChanged);

    rKDownlinkModule.itemSelector.getItemList();
};

rKDownlinkModule.itemSelector.onParamChanged = function () {
    jQuery('#ajaxIndicator').removeClass('hidden');

    rKDownlinkModule.itemSelector.getItemList();
};

rKDownlinkModule.itemSelector.getItemList = function () {
    var baseId;
    var params;

    baseId = rKDownlinkModule.itemSelector.baseId;
    params = {
        ot: baseId,
        sort: jQuery('#' + baseId + 'Sort').val(),
        sortdir: jQuery('#' + baseId + 'SortDir').val(),
        q: jQuery('#' + baseId + 'SearchTerm').val()
    }
    if (jQuery('#' + baseId + '_catidMain').length > 0) {
        params[catidMain] = jQuery('#' + baseId + '_catidMain').val();
    } else if (jQuery('#' + baseId + '_catidsMain').length > 0) {
        params[catidsMain] = jQuery('#' + baseId + '_catidsMain').val();
    }

    jQuery.getJSON(Routing.generate('rkdownlinkmodule_ajax_getitemlistfinder'), params, function (data) {
        var baseId;

        baseId = rKDownlinkModule.itemSelector.baseId;
        rKDownlinkModule.itemSelector.items[baseId] = data;
        jQuery('#ajaxIndicator').addClass('hidden');
        rKDownlinkModule.itemSelector.updateItemDropdownEntries();
        rKDownlinkModule.itemSelector.updatePreview();
    });
};

rKDownlinkModule.itemSelector.updateItemDropdownEntries = function () {
    var baseId, itemSelector, items, i, item;

    baseId = rKDownlinkModule.itemSelector.baseId;
    itemSelector = jQuery('#' + baseId + 'Id');
    itemSelector.length = 0;

    items = rKDownlinkModule.itemSelector.items[baseId];
    for (i = 0; i < items.length; ++i) {
        item = items[i];
        itemSelector.get(0).options[i] = new Option(item.title, item.id, false);
    }

    if (rKDownlinkModule.itemSelector.selectedId > 0) {
        jQuery('#' + baseId + 'Id').val(rKDownlinkModule.itemSelector.selectedId);
    }
};

rKDownlinkModule.itemSelector.updatePreview = function () {
    var baseId, items, selectedElement, i;

    baseId = rKDownlinkModule.itemSelector.baseId;
    items = rKDownlinkModule.itemSelector.items[baseId];

    jQuery('#' + baseId + 'PreviewContainer').addClass('hidden');

    if (items.length === 0) {
        return;
    }

    selectedElement = items[0];
    if (rKDownlinkModule.itemSelector.selectedId > 0) {
        for (var i = 0; i < items.length; ++i) {
            if (items[i].id == rKDownlinkModule.itemSelector.selectedId) {
                selectedElement = items[i];
                break;
            }
        }
    }

    if (null !== selectedElement) {
        jQuery('#' + baseId + 'PreviewContainer')
            .html(window.atob(selectedElement.previewInfo))
            .removeClass('hidden');
    }
};

rKDownlinkModule.itemSelector.onItemChanged = function () {
    var baseId, itemSelector, preview;

    baseId = rKDownlinkModule.itemSelector.baseId;
    itemSelector = jQuery('#' + baseId + 'Id').get(0);
    preview = window.atob(rKDownlinkModule.itemSelector.items[baseId][itemSelector.selectedIndex].previewInfo);

    jQuery('#' + baseId + 'PreviewContainer').html(preview);
    rKDownlinkModule.itemSelector.selectedId = jQuery('#' + baseId + 'Id').val();
};

jQuery(document).ready(function () {
    var infoElem;

    infoElem = jQuery('#itemSelectorInfo');
    if (infoElem.length == 0) {
        return;
    }

    rKDownlinkModule.itemSelector.onLoad(infoElem.data('base-id'), infoElem.data('selected-id'));
});
