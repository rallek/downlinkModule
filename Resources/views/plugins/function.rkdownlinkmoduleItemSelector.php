<?php
/**
 * Downlink.
 *
 * @copyright Ralf Koester (RK)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Ralf Koester <ralf@familie-koester.de>.
 * @link http://k62.de
 * @link http://zikula.org
 * @version Generated by ModuleStudio (https://modulestudio.de).
 */

/**
 * The rkdownlinkmoduleItemSelector plugin provides items for a dropdown selector.
 *
 * @param  array            $params All attributes passed to this function from the template
 * @param  Zikula_Form_View $view   Reference to the view object
 *
 * @return string The output of the plugin
 */
function smarty_function_rkdownlinkmoduleItemSelector($params, $view)
{
    return $view->registerPlugin('\\RK\\DownlinkModule\\Form\\Plugin\\ItemSelector', $params);
}