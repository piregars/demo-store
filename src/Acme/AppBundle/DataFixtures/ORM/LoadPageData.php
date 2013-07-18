<?php

namespace Acme\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadPageData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    protected $container;
    protected $pageManager;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->pageManager = $container->get('msi_cmf.page_manager');
    }

    public function load(ObjectManager $manager)
    {
        //home
        $page = $this->pageManager->create();
        $page->setTemplate('AcmeAppBundle::layout.html.twig');
        $this->pageManager->createTranslations($page, array('fr', 'en'));
        $page->setPublished(true);
        $page->getTranslation('en')->setTitle('lorem');
        $page->getTranslation('fr')->setTitle('Accueil');
        $page->setSite($manager->merge($this->getReference('site1')));
        $this->addReference('page1', $page);
        $manager->persist($page);

        //about
        $page = $this->pageManager->create();
        $page->setTemplate('AcmeAppBundle::layout.html.twig');
        $this->pageManager->createTranslations($page, array('fr', 'en'));
        $page->setPublished(true);
        $page->getTranslation('en')->setTitle('about us');
        $page->getTranslation('fr')->setTitle('à propos de nous');
        $page->setSite($manager->merge($this->getReference('site1')));
        $this->addReference('page2', $page);
        $manager->persist($page);

        // FLUSH
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
