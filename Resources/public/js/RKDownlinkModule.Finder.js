'use strict';

var currentRKDownlinkModuleEditor = null;
var currentRKDownlinkModuleInput = null;

/**
 * Returns the attributes used for the popup window. 
 * @return {String}
 */
function getRKDownlinkModulePopupAttributes() {
    var pWidth, pHeight;

    pWidth = screen.width * 0.75;
    pHeight = screen.height * 0.66;

    return 'width=' + pWidth + ',height=' + pHeight + ',location=no,menubar=no,toolbar=no,dependent=yes,minimizable=no,modal=yes,alwaysRaised=yes,resizable=yes,scrollbars=yes';
}

/**
 * Open a popup window with the finder triggered by an editor button.
 */
function RKDownlinkModuleFinderOpenPopup(editor, editorName) {
    var popupUrl;

    // Save editor for access in selector window
    currentRKDownlinkModuleEditor = editor;

    popupUrl = Routing.generate('rkdownlinkmodule_external_finder', { objectType: 'link', editor: editorName });

    if (editorName == 'ckeditor') {
        editor.popup(popupUrl, /*width*/ '80%', /*height*/ '70%', getRKDownlinkModulePopupAttributes());
    } else {
        window.open(popupUrl, '_blank', getRKDownlinkModulePopupAttributes());
    }
}


var rKDownlinkModule = {};

rKDownlinkModule.finder = {};

rKDownlinkModule.finder.onLoad = function (baseId, selectedId) {
    if (jQuery('#rKDownlinkModuleSelectorForm').length < 1) {
        return;
    }
    jQuery('select').not("[id$='pasteAs']").change(rKDownlinkModule.finder.onParamChanged);
    
    jQuery('.btn-default').click(rKDownlinkModule.finder.handleCancel);

    var selectedItems = jQuery('#rkdownlinkmoduleItemContainer a');
    selectedItems.bind('click keypress', function (event) {
        event.preventDefault();
        rKDownlinkModule.finder.selectItem(jQuery(this).data('itemid'));
    });
};

rKDownlinkModule.finder.onParamChanged = function () {
    jQuery('#rKDownlinkModuleSelectorForm').submit();
};

rKDownlinkModule.finder.handleCancel = function (event) {
    var editor;

    event.preventDefault();
    editor = jQuery("[id$='editor']").first().val();
    if ('ckeditor' === editor) {
        rKDownlinkClosePopup();
    } else if ('quill' === editor) {
        rKDownlinkClosePopup();
    } else if ('summernote' === editor) {
        rKDownlinkClosePopup();
    } else if ('tinymce' === editor) {
        rKDownlinkClosePopup();
    } else {
        alert('Close Editor: ' + editor);
    }
};


function rKDownlinkGetPasteSnippet(mode, itemId) {
    var quoteFinder;
    var itemPath;
    var itemUrl;
    var itemTitle;
    var itemDescription;
    var pasteMode;

    quoteFinder = new RegExp('"', 'g');
    itemPath = jQuery('#path' + itemId).val().replace(quoteFinder, '');
    itemUrl = jQuery('#url' + itemId).val().replace(quoteFinder, '');
    itemTitle = jQuery('#title' + itemId).val().replace(quoteFinder, '').trim();
    itemDescription = jQuery('#desc' + itemId).val().replace(quoteFinder, '').trim();
    pasteMode = jQuery("[id$='pasteAs']").first().val();

    // item ID
    if (pasteMode === '3') {
        return '' + itemId;
    }

    // relative link to detail page
    if (pasteMode === '1') {
        return mode === 'url' ? itemPath : '<a href="' + itemPath + '" title="' + itemDescription + '">' + itemTitle + '</a>';
    }
    // absolute url to detail page
    if (pasteMode === '2') {
        return mode === 'url' ? itemUrl : '<a href="' + itemUrl + '" title="' + itemDescription + '">' + itemTitle + '</a>';
    }

    return '';
}


// User clicks on "select item" button
rKDownlinkModule.finder.selectItem = function (itemId) {
    var editor, html;

    html = rKDownlinkGetPasteSnippet('html', itemId);
    editor = jQuery("[id$='editor']").first().val();
    if ('ckeditor' === editor) {
        if (null !== window.opener.currentRKDownlinkModuleEditor) {
            window.opener.currentRKDownlinkModuleEditor.insertHtml(html);
        }
    } else if ('quill' === editor) {
        if (null !== window.opener.currentRKDownlinkModuleEditor) {
            window.opener.currentRKDownlinkModuleEditor.clipboard.dangerouslyPasteHTML(window.opener.currentRKDownlinkModuleEditor.getLength(), html);
        }
    } else if ('summernote' === editor) {
        if (null !== window.opener.currentRKDownlinkModuleEditor) {
            html = jQuery(html).get(0);
            window.opener.currentRKDownlinkModuleEditor.invoke('insertNode', html);
        }
    } else if ('tinymce' === editor) {
        window.opener.currentRKDownlinkModuleEditor.insertContent(html);
    } else {
        alert('Insert into Editor: ' + editor);
    }
    rKDownlinkClosePopup();
};

function rKDownlinkClosePopup() {
    window.opener.focus();
    window.close();
}

jQuery(document).ready(function () {
    rKDownlinkModule.finder.onLoad();
});
