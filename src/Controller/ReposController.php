<?php

namespace App\Controller;

use App\Service\ReposService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReposController
 * @package App\Controller
 */
class ReposController extends AbstractController
{
    /**
     * @param Request $request
     * @param ReposService $reposService
     * @return JsonResponse
     */
    public function listAction(Request $request, ReposService $reposService): JsonResponse
    {
        $params = $request->query->all();
        $result = $reposService->list($params);
        return $this->json($result);
    }
}
