<?php

namespace Simonsimcity\GetId3Bundle\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;

class GetId3Factory
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return \GetId3\Write\Tags
     */
    public function getTagsWriter()
    {
        return $this->container->get("SimonsimcityGetId3.Write.Tags");
    }
}
