<?php


namespace App\Controller\V1;


use App\Model\Pocket\UseCase\SingUp;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SignUpController extends AbstractController
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function request(Request $request, SingUp\Request\Handler $handler): Response
    {
        $command = new SingUp\Request\Command();
    }
}