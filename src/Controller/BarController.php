<?php

namespace App\Controller;

use App\dbal\EnumMetallType;
use App\Entity\Price;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarController extends AbstractController
{
    /**
     * @Route("/bar/index")
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('bar/index.html.twig', [
            'number' => $number,
        ]);
    }
}
