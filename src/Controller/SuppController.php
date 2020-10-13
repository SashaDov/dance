<?php

namespace App\Controller;

use App\dbal\EnumMetallType;
use App\Entity\Price;
use App\Entity\Supplier;
use App\Repository\SupplierRepository;
use App\services\FormGetter;
use App\services\YmlParser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuppController extends AbstractController
{
    /**
     * @Route("/supp/create", name="supp")
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $name = $request->get('name');
        $source = $request->get('source') ?? 'yml'; // api, yml
        if (!is_null($name)) {
            $supplier = $entityManager->getRepository(Supplier::class)->getSupplier($name);

            $formGetter = new FormGetter($supplier, $source);
            $form = $formGetter->getData();

//            $client = new NativeHttpClient();
//            $response = $client->request('GET', 'http://localhost:90/api', [
//                'json' => ['id' => $supplier->getId()],
//            ]);
//
//            $data = json_decode($response->getContent());
//            $price_int = $this->parse($data->type);

            $price = new Price();
            $price->setSupplierId($supplier->getId());
            $price->setPrice($form->price);
            $price->setMetalType((new EnumMetallType())->getValue($form->type));

            $entityManager->persist($price);
            $entityManager->flush();

            return new Response('Saved new price with id '.$price->getId());
        }

        return new Response('Not saved');
    }

    /**
     * @Route("/supp/parse", name="supp_parse")
     */
    public function parse($type)
    {
        $p = new YmlParser();
        $v = $p->parseYml($this->container);

        return $v[$type];
    }
}
