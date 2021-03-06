'use strict';

function rKDownlinkCapitaliseFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.substring(1);
}

/**
 * Initialise the quick navigation form in list views.
 */
function rKDownlinkInitQuickNavigation() {
    var quickNavForm;
    var objectType;

    if (jQuery('.rkdownlinkmodule-quicknav').length < 1) {
        return;
    }

    quickNavForm = jQuery('.rkdownlinkmodule-quicknav').first();
    objectType = quickNavForm.attr('id').replace('rKDownlinkModule', '').replace('QuickNavForm', '');

    quickNavForm.find('select').change(function (event) {
        quickNavForm.submit();
    });

    var fieldPrefix = 'rkdownlinkmodule_' + objectType.toLowerCase() + 'quicknav_';
    // we can hide the submit button if we have no visible quick search field
    if (jQuery('#' + fieldPrefix + 'q').length < 1 || jQuery('#' + fieldPrefix + 'q').parent().parent().hasClass('hidden')) {
        jQuery('#' + fieldPrefix + 'updateview').addClass('hidden');
    }
}

/**
 * Simulates a simple alert using bootstrap.
 */
function rKDownlinkSimpleAlert(anchorElement, title, content, alertId, cssClass) {
    var alertBox;

    alertBox = ' \
        <div id="' + alertId + '" class="alert alert-' + cssClass + ' fade"> \
          <button type="button" class="close" data-dismiss="alert">&times;</button> \
          <h4>' + title + '</h4> \
          <p>' + content + '</p> \
        </div>';

    // insert alert before the given anchor element
    anchorElement.before(alertBox);

    jQuery('#' + alertId).delay(200).addClass('in').fadeOut(4000, function () {
        jQuery(this).remove();
    });
}

/**
 * Initialises the mass toggle functionality for admin view pages.
 */
function rKDownlinkInitMassToggle() {
    if (jQuery('.rkdownlink-mass-toggle').length > 0) {
        jQuery('.rkdownlink-mass-toggle').unbind('click').click(function (event) {
            jQuery('.rkdownlink-toggle-checkbox').prop('checked', jQuery(this).prop('checked'));
        });
    }
}

/**
 * Creates a dropdown menu for the item actions.
 */
function rKDownlinkInitItemActions(context) {
    if (context == 'display') {
        jQuery('.btn-group-sm.item-actions').each(function (index) {
            var innerList;
            innerList = jQuery(this).children('ul.list-inline').first().detach();
            jQuery(this).append(innerList.find('a.btn'));
        });
    }
    if (context == 'view') {
        var containerSelector;
        var containers;
        
        containerSelector = '';
        if (context == 'view') {
            containerSelector = '.rkdownlinkmodule-view';
        } else if (context == 'display') {
            containerSelector = 'h2, h3';
        }
        
        if (containerSelector == '') {
            return;
        }
        
        containers = jQuery(containerSelector);
        if (containers.length < 1) {
            return;
        }
        
        containers.find('.dropdown > ul').removeClass('list-inline').addClass('list-unstyled dropdown-menu');
        containers.find('.dropdown > ul a i').addClass('fa-fw');
        containers.find('.dropdown-toggle').removeClass('hidden').dropdown();
    }
}

jQuery(document).ready(function () {
    var isViewPage;
    var isDisplayPage;

    isViewPage = jQuery('.rkdownlinkmodule-view').length > 0;
    isDisplayPage = jQuery('.rkdownlinkmodule-display').length > 0;

    if (isViewPage) {
        rKDownlinkInitQuickNavigation();
        rKDownlinkInitMassToggle();
        rKDownlinkInitItemActions('view');
    } else if (isDisplayPage) {
        rKDownlinkInitItemActions('display');
    }
});
