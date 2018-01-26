'use strict';

function rKDownlinkValidateNoSpace(val) {
    var valStr;
    valStr = new String(val);

    return (valStr.indexOf(' ') === -1);
}

/**
 * Runs special validation rules.
 */
function rKDownlinkExecuteCustomValidationConstraints(objectType, currentEntityId) {
}
