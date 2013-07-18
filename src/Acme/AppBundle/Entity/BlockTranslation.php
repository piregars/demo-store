<?php

namespace Acme\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Msi\CmfBundle\Entity\BlockTranslation as BaseBlockTranslation;

/**
 * @ORM\Entity
 */
class BlockTranslation extends BaseBlockTranslation
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Block", inversedBy="translations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $object;
}
