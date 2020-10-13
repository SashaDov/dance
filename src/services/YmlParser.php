<?php

namespace App\services;

use Psr\Container\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

class YmlParser
{
    public function parseYml(ContainerInterface $container)
    {
        $path = $container->get('parameter_bag')->get('files_directory');
        $value = Yaml::parseFile($path . '/supp.yml');
        return $value;
    }
}