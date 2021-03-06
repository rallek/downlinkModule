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

namespace RK\DownlinkModule\Entity;

use RK\DownlinkModule\Entity\Base\AbstractLinkCategoryEntity as BaseEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity extension domain class storing link categories.
 *
 * This is the concrete category class for link entities.
 * @ORM\Entity(repositoryClass="\RK\DownlinkModule\Entity\Repository\LinkCategoryRepository")
 * @ORM\Table(name="rk_downli_link_category",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="cat_unq", columns={"registryId", "categoryId", "entityId"})
 *     }
 * )
 */
class LinkCategoryEntity extends BaseEntity
{
    // feel free to add your own methods here
}
