<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api",methods={"GET"})
     */
    public function index(Request $request)
    {
        $request = $this->transformJsonBody($request);
        if (!$request || !$request->get('id')){
            throw new \Exception('No id');
        }

        $type = random_int(1, 3);
        return $this->response([
            'id' => $request->get('id'),
            'type' => $type,
        ]);
    }

    /**
     * @Route("/api/all", name="api",methods={"GET"})
     */
    public function all(Request $request)
    {
        $request = $this->transformJsonBody($request);
        if (!$request || !$request->get('id')){
            throw new \Exception('No id');
        }

        $prices = [
            1 => 800,
            2 => 1000,
            3 => 2000,
        ];
        $type = random_int(1, 3);
        return $this->response([
            'id' => $request->get('id'),
            'type' => $type,
            'price' => $prices[$type],
        ]);
    }

    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}
