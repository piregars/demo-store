<?php

namespace Acme\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Acme\AppBundle\Entity\Menu;

class LoadMenuData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    protected $dic;
    protected $menuManager;

    public function setContainer(ContainerInterface $dic = null)
    {
        $this->dic = $dic;
        $this->menuManager = $this->dic->get('msi_cmf.menu_root_manager');
    }

    public function load(ObjectManager $manager)
    {
        // ADMIN MENU
        // root
        $root = $this->menuManager->create();
        $this->menuManager->createTranslations($root, array('fr'));
        $root->getTranslation()->setName('admin');
        $manager->persist($root);
        $manager->flush();
            // sites
            $menu = $this->menuManager->create();
            $this->menuManager->createTranslations($menu, array('fr'));
            $menu->getTranslation()->setRoute('@msi_cmf_site_admin_list');
            $menu->setParent($root);
            $menu->getTranslation()->setName('Sites');
            $manager->persist($menu);
            // security
            $security = $this->menuManager->create();
            $this->menuManager->createTranslations($security, array('fr'));
            $security->setParent($root);
            $security->getTranslation()->setName('Sécurité');
            $manager->persist($security);
                // users
                $menu = $this->menuManager->create();
                $this->menuManager->createTranslations($menu, array('fr'));
                $menu->getTranslation()->setRoute('@msi_user_user_admin_list');
                $menu->setParent($security);
                $menu->getTranslation()->setName('Utilisateurs');
                $manager->persist($menu);
                // groups
                $menu = $this->menuManager->create();
                $this->menuManager->createTranslations($menu, array('fr'));
                $menu->getTranslation()->setRoute('@msi_user_group_admin_list');
                $menu->setParent($security);
                $menu->getTranslation()->setName('Groupes');
                $manager->persist($menu);
            // menu
            $menu = $this->menuManager->create();
            $this->menuManager->createTranslations($menu, array('fr'));
            $menu->getTranslation()->setRoute('@msi_cmf_menu_root_admin_list');
            $menu->setParent($root);
            $menu->getTranslation()->setName('Menus');
            $manager->persist($menu);


        // main1 MENU
        // root
        $root = $this->menuManager->create();
        $this->menuManager->createTranslations($root, array('fr', 'en'));
        $root->getTranslation('fr')->setName('main');
        $root->getTranslation('en')->setName('main');
        $manager->persist($root);
        $manager->flush();

        // FLUSH
        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}
