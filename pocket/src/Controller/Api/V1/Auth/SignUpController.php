<?php


namespace App\Controller\Api\V1\Auth;


use App\Model\Pocket\UseCase\SingUp;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SignUpController extends AbstractController
{
    private LoggerInterface $logger;
    private SerializerInterface $serializer;
    private TranslatorInterface $translator;
    private ValidatorInterface $validator;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        TranslatorInterface $translator,
        LoggerInterface $logger
    ) {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->translator = $translator;
        $this->logger = $logger;
    }

    /**
     * @Route("/auth/signup", name="auth.signup", methods={"POST"})
     * @param Request $request
     * @param SingUp\Request\Handler $handler
     * @return Response
     */
    public function request(Request $request, SingUp\Request\Handler $handler): Response
    {
        /** @var SingUp\Request\Command $command */
        $command = $this->serializer->deserialize($request->getContent(), SingUp\Request\Command::class, 'json');
        $violations = $this->validator->validate($command);

        if (\count($violations)) {
            $json = $this->serializer->serialize($violations, 'json');
            return new JsonResponse($json, 400, [], true);
        }

        try {
            $handler->handle($command);
        } catch (\DomainException $e) {
            $this->logger->error($e->getMessage(), ['exception' => $e, 'request' => $request]);

            $json = $this->serializer->serialize(
                ['error' => $this->translator->trans($e->getMessage(), [], 'exceptions')],
                'json'
            );

            return new JsonResponse($json, 409, [], true);
        }

        return $this->json([], 201);
    }
}