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

namespace RK\DownlinkModule\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Zikula\Core\Doctrine\EntityAccess;
use RK\DownlinkModule\Traits\StandardFieldsTrait;
use RK\DownlinkModule\Validator\Constraints as DownlinkAssert;

/**
 * Entity class that defines the entity structure and behaviours.
 *
 * This is the base entity class for link entities.
 * The following annotation marks it as a mapped superclass so subclasses
 * inherit orm properties.
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractLinkEntity extends EntityAccess
{
    /**
     * Hook standard fields behaviour embedding createdBy, updatedBy, createdDate, updatedDate fields.
     */
    use StandardFieldsTrait;

    /**
     * @var string The tablename this object maps to
     */
    protected $_objectType = 'link';
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true)
     * @Assert\Type(type="integer")
     * @Assert\NotNull()
     * @Assert\LessThan(value=1000000000)
     * @var integer $id
     */
    protected $id = 0;
    
    /**
     * the current workflow state
     *
     * @ORM\Column(length=20)
     * @Assert\NotBlank()
     * @DownlinkAssert\ListEntry(entityName="link", propertyName="workflowState", multiple=false)
     * @var string $workflowState
     */
    protected $workflowState = 'initial';
    
    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="0", max="255")
     * @var string $linkTitle
     */
    protected $linkTitle = '';
    
    /**
     * Here type the link you want to share
     *
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="0", max="255")
     * @Assert\Url(checkDNS=true, dnsMessage = "The host '{{ value }}' could not be resolved.")
     * @var string $myLink
     */
    protected $myLink = '';
    
    /**
     * the quantity of characters are limited to {{length}}
     *
     * @ORM\Column(type="text", length=2000, nullable=true)
     * @Assert\Length(min="0", max="2000")
     * @var text $myDescription
     */
    protected $myDescription = '';
    
    
    /**
     * @ORM\OneToMany(targetEntity="\RK\DownlinkModule\Entity\LinkCategoryEntity", 
     *                mappedBy="entity", cascade={"all"}, 
     *                orphanRemoval=true)
     * @var \RK\DownlinkModule\Entity\LinkCategoryEntity
     */
    protected $categories = null;
    
    
    /**
     * LinkEntity constructor.
     *
     * Will not be called by Doctrine and can therefore be used
     * for own implementation purposes. It is also possible to add
     * arbitrary arguments as with every other class method.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }
    
    /**
     * Returns the _object type.
     *
     * @return string
     */
    public function get_objectType()
    {
        return $this->_objectType;
    }
    
    /**
     * Sets the _object type.
     *
     * @param string $_objectType
     *
     * @return void
     */
    public function set_objectType($_objectType)
    {
        if ($this->_objectType != $_objectType) {
            $this->_objectType = $_objectType;
        }
    }
    
    
    /**
     * Returns the id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Sets the id.
     *
     * @param integer $id
     *
     * @return void
     */
    public function setId($id)
    {
        if (intval($this->id) !== intval($id)) {
            $this->id = intval($id);
        }
    }
    
    /**
     * Returns the workflow state.
     *
     * @return string
     */
    public function getWorkflowState()
    {
        return $this->workflowState;
    }
    
    /**
     * Sets the workflow state.
     *
     * @param string $workflowState
     *
     * @return void
     */
    public function setWorkflowState($workflowState)
    {
        if ($this->workflowState !== $workflowState) {
            $this->workflowState = isset($workflowState) ? $workflowState : '';
        }
    }
    
    /**
     * Returns the link title.
     *
     * @return string
     */
    public function getLinkTitle()
    {
        return $this->linkTitle;
    }
    
    /**
     * Sets the link title.
     *
     * @param string $linkTitle
     *
     * @return void
     */
    public function setLinkTitle($linkTitle)
    {
        if ($this->linkTitle !== $linkTitle) {
            $this->linkTitle = isset($linkTitle) ? $linkTitle : '';
        }
    }
    
    /**
     * Returns the my link.
     *
     * @return string
     */
    public function getMyLink()
    {
        return $this->myLink;
    }
    
    /**
     * Sets the my link.
     *
     * @param string $myLink
     *
     * @return void
     */
    public function setMyLink($myLink)
    {
        if ($this->myLink !== $myLink) {
            $this->myLink = isset($myLink) ? $myLink : '';
        }
    }
    
    /**
     * Returns the my description.
     *
     * @return text
     */
    public function getMyDescription()
    {
        return $this->myDescription;
    }
    
    /**
     * Sets the my description.
     *
     * @param text $myDescription
     *
     * @return void
     */
    public function setMyDescription($myDescription)
    {
        if ($this->myDescription !== $myDescription) {
            $this->myDescription = $myDescription;
        }
    }
    
    /**
     * Returns the categories.
     *
     * @return ArrayCollection[]
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    
    /**
     * Sets the categories.
     *
     * @param ArrayCollection $categories List of categories
     *
     * @return void
     */
    public function setCategories(ArrayCollection $categories)
    {
        foreach ($this->categories as $category) {
            if (false === $key = $this->collectionContains($categories, $category)) {
                $this->categories->removeElement($category);
            } else {
                $categories->remove($key);
            }
        }
        foreach ($categories as $category) {
            $this->categories->add($category);
        }
    }
    
    /**
     * Checks if a collection contains an element based only on two criteria (categoryRegistryId, category).
     *
     * @param ArrayCollection $collection Given collection
     * @param \RK\DownlinkModule\Entity\LinkCategoryEntity $element Element to search for
     *
     * @return bool|int
     */
    private function collectionContains(ArrayCollection $collection, \RK\DownlinkModule\Entity\LinkCategoryEntity $element)
    {
        foreach ($collection as $key => $category) {
            /** @var \RK\DownlinkModule\Entity\LinkCategoryEntity $category */
            if ($category->getCategoryRegistryId() == $element->getCategoryRegistryId()
                && $category->getCategory() == $element->getCategory()
            ) {
                return $key;
            }
        }
    
        return false;
    }
    
    
    
    /**
     * Creates url arguments array for easy creation of display urls.
     *
     * @return array List of resulting arguments
     */
    public function createUrlArgs()
    {
        return [
            'id' => $this->getId()
        ];
    }
    
    /**
     * Returns the primary key.
     *
     * @return integer The identifier
     */
    public function getKey()
    {
        return $this->getId();
    }
    
    /**
     * Determines whether this entity supports hook subscribers or not.
     *
     * @return boolean
     */
    public function supportsHookSubscribers()
    {
        return true;
    }
    
    /**
     * Return lower case name of multiple items needed for hook areas.
     *
     * @return string
     */
    public function getHookAreaPrefix()
    {
        return 'rkdownlinkmodule.ui_hooks.links';
    }
    
    /**
     * Returns an array of all related objects that need to be persisted after clone.
     * 
     * @param array $objects Objects that are added to this array
     * 
     * @return array List of entity objects
     */
    public function getRelatedObjectsToPersist(&$objects = [])
    {
        return [];
    }
    
    /**
     * ToString interceptor implementation.
     * This method is useful for debugging purposes.
     *
     * @return string The output string for this entity
     */
    public function __toString()
    {
        return 'Link ' . $this->getKey() . ': ' . $this->getLinkTitle();
    }
    
    /**
     * Clone interceptor implementation.
     * This method is for example called by the reuse functionality.
     * Performs a quite simple shallow copy.
     *
     * See also:
     * (1) http://docs.doctrine-project.org/en/latest/cookbook/implementing-wakeup-or-clone.html
     * (2) http://www.php.net/manual/en/language.oop5.cloning.php
     * (3) http://stackoverflow.com/questions/185934/how-do-i-create-a-copy-of-an-object-in-php
     */
    public function __clone()
    {
        // if the entity has no identity do nothing, do NOT throw an exception
        if (!$this->id) {
            return;
        }
    
        // otherwise proceed
    
        // unset identifier
        $this->setId(0);
    
        // reset workflow
        $this->setWorkflowState('initial');
    
        $this->setCreatedBy(null);
        $this->setCreatedDate(null);
        $this->setUpdatedBy(null);
        $this->setUpdatedDate(null);
    
    
        // clone categories
        $categories = $this->categories;
        $this->categories = new ArrayCollection();
        foreach ($categories as $c) {
            $newCat = clone $c;
            $this->categories->add($newCat);
            $newCat->setEntity($this);
        }
    }
}
