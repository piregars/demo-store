<?php

namespace Acme\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Msi\CmfBundle\Entity\Page as BasePage;

/**
 * @ORM\Entity
 */
class Page extends BasePage
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Block", mappedBy="pages")
     */
    protected $blocks;

    /**
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $site;

    /**
     * @ORM\OneToMany(targetEntity="PageTranslation", mappedBy="object", cascade={"persist"})
     * @ORM\OrderBy({"locale" = "ASC"})
     */
    protected $translations;
}
