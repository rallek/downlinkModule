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
use Zikula\CategoriesModule\Entity\AbstractCategoryAssignment;

/**
 * Entity extension domain class storing link categories.
 *
 * This is the base category class for link entities.
 */
abstract class AbstractLinkCategoryEntity extends AbstractCategoryAssignment
{
    /**
     * @ORM\ManyToOne(targetEntity="\RK\DownlinkModule\Entity\LinkEntity", inversedBy="categories")
     * @ORM\JoinColumn(name="entityId", referencedColumnName="id")
     * @var \RK\DownlinkModule\Entity\LinkEntity
     */
    protected $entity;
    
    /**
     * Get reference to owning entity.
     *
     * @return \RK\DownlinkModule\Entity\LinkEntity
     */
    public function getEntity()
    {
        return $this->entity;
    }
    
    /**
     * Set reference to owning entity.
     *
     * @param \RK\DownlinkModule\Entity\LinkEntity $entity
     */
    public function setEntity(/*\RK\DownlinkModule\Entity\LinkEntity */$entity)
    {
        $this->entity = $entity;
    }
}
