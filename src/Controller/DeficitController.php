<?php

namespace App\Controller;

use App\Service\DeficitParser;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/deficit")
 */
class DeficitController extends AbstractController
{
    /**
     * @Route("/", name="deficit_show_list")
     * @param DeficitParser $deficitParser
     * @return Response
     * @throws DBALException
     */
    public function index(DeficitParser $deficitParser): Response
    {
        $deficitProducts = $deficitParser->getDeficitProducts();

        return $this->render('deficit/show.html.twig',
            [
                'deficitProducts' => $deficitProducts
            ]
        );
    }
}
