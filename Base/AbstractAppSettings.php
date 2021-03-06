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

namespace RK\DownlinkModule\Base;

use Symfony\Component\Validator\Constraints as Assert;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use RK\DownlinkModule\Validator\Constraints as DownlinkAssert;

/**
 * Application settings class for handling module variables.
 */
abstract class AbstractAppSettings
{
    /**
     * @var VariableApiInterface
     */
    protected $variableApi;
    
    /**
     * The amount of links shown per page
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $linkEntriesPerPage
     */
    protected $linkEntriesPerPage = 10;
    
    /**
     * Whether to add a link to links of the current user on his account page
     *
     * @Assert\NotNull()
     * @Assert\Type(type="bool")
     * @var boolean $linkOwnLinksOnAccountPage
     */
    protected $linkOwnLinksOnAccountPage = true;
    
    /**
     * Which sections are supported in the Finder component (used by Scribite plug-ins).
     *
     * @Assert\NotNull()
     * @DownlinkAssert\ListEntry(entityName="appSettings", propertyName="enabledFinderTypes", multiple=true)
     * @var string $enabledFinderTypes
     */
    protected $enabledFinderTypes = 'link';
    
    
    /**
     * AppSettings constructor.
     *
     * @param VariableApiInterface $variableApi VariableApi service instance
     */
    public function __construct(
        VariableApiInterface $variableApi
    ) {
        $this->variableApi = $variableApi;
    
        $this->load();
    }
    
    /**
     * Returns the link entries per page.
     *
     * @return integer
     */
    public function getLinkEntriesPerPage()
    {
        return $this->linkEntriesPerPage;
    }
    
    /**
     * Sets the link entries per page.
     *
     * @param integer $linkEntriesPerPage
     *
     * @return void
     */
    public function setLinkEntriesPerPage($linkEntriesPerPage)
    {
        if (intval($this->linkEntriesPerPage) !== intval($linkEntriesPerPage)) {
            $this->linkEntriesPerPage = intval($linkEntriesPerPage);
        }
    }
    
    /**
     * Returns the link own links on account page.
     *
     * @return boolean
     */
    public function getLinkOwnLinksOnAccountPage()
    {
        return $this->linkOwnLinksOnAccountPage;
    }
    
    /**
     * Sets the link own links on account page.
     *
     * @param boolean $linkOwnLinksOnAccountPage
     *
     * @return void
     */
    public function setLinkOwnLinksOnAccountPage($linkOwnLinksOnAccountPage)
    {
        if (boolval($this->linkOwnLinksOnAccountPage) !== boolval($linkOwnLinksOnAccountPage)) {
            $this->linkOwnLinksOnAccountPage = boolval($linkOwnLinksOnAccountPage);
        }
    }
    
    /**
     * Returns the enabled finder types.
     *
     * @return string
     */
    public function getEnabledFinderTypes()
    {
        return $this->enabledFinderTypes;
    }
    
    /**
     * Sets the enabled finder types.
     *
     * @param string $enabledFinderTypes
     *
     * @return void
     */
    public function setEnabledFinderTypes($enabledFinderTypes)
    {
        if ($this->enabledFinderTypes !== $enabledFinderTypes) {
            $this->enabledFinderTypes = isset($enabledFinderTypes) ? $enabledFinderTypes : '';
        }
    }
    
    
    /**
     * Loads module variables from the database.
     */
    protected function load()
    {
        $moduleVars = $this->variableApi->getAll('RKDownlinkModule');
    
        if (isset($moduleVars['linkEntriesPerPage'])) {
            $this->setLinkEntriesPerPage($moduleVars['linkEntriesPerPage']);
        }
        if (isset($moduleVars['linkOwnLinksOnAccountPage'])) {
            $this->setLinkOwnLinksOnAccountPage($moduleVars['linkOwnLinksOnAccountPage']);
        }
        if (isset($moduleVars['enabledFinderTypes'])) {
            $this->setEnabledFinderTypes($moduleVars['enabledFinderTypes']);
        }
    }
    
    /**
     * Saves module variables into the database.
     */
    public function save()
    {
        $this->variableApi->set('RKDownlinkModule', 'linkEntriesPerPage', $this->getLinkEntriesPerPage());
        $this->variableApi->set('RKDownlinkModule', 'linkOwnLinksOnAccountPage', $this->getLinkOwnLinksOnAccountPage());
        $this->variableApi->set('RKDownlinkModule', 'enabledFinderTypes', $this->getEnabledFinderTypes());
    }
}
