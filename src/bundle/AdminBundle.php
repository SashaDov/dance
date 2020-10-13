<?php

namespace App\bundle;

use App\dbal\EnumMetallType;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AdminBundle extends Bundle
{
    public function boot()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        Type::addType('metallenum', ' \App\dbal\EnumMetallType');
        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('metallenum','metallenum');
    }
}