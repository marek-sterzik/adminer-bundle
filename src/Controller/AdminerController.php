<?php

namespace Sterzik\AdminerBundle\Controller;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminerController extends AbstractController
{
    public function __construct(
        private ?string $databaseUrl = null,
    ) {
    }

    #[Route("/adminer", name: "adminer_bundle.adminer")]
    public function pageAdminer(): Response
    {
        $bootFile = dirname(__DIR__, 2) . "/adminer/boot.php";
        return new StreamedResponse(
            function () use ($bootFile) {
                $httpAuth = null;
                $dbConf = $this->databaseUrl;
                include $bootFile;
            }
        );
    }
}
