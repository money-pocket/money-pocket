<?php


namespace App\Model\Pocket\Entity\Pocket;


use Doctrine\ORM\EntityManagerInterface;
use App\Model\EntityNotFoundException;
use Doctrine\Persistence\ObjectRepository;

class PocketRepository
{
    private EntityManagerInterface $em;
    private ObjectRepository $repo;

    /**
     * PocketRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Pocket::class);
    }

    /**
     * @param ClientId $clientId
     * @return bool
     */
    public function hasByClientId(ClientId $clientId): bool
    {
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.client_id = :client_id')
                ->setParameter(':client_id', $clientId->getValue())
                ->getQuery()->getSingleScalarResult() > 0;
    }

    /**
     * @param ClientId $clientId
     * @return Pocket
     * @throws EntityNotFoundException
     */
    public function getByClientId(ClientId $clientId): Pocket
    {
        /** @var Pocket $pocket */
        if (!$pocket = $this->repo->findOneBy(['clientId' => $clientId->getValue()])) {
            throw new EntityNotFoundException('Pocket is not found.');
        }

        return $pocket;
    }

    /**
     * @param string $inviteToken
     * @return Pocket
     * @throws EntityNotFoundException
     */
    public function getByInviteToken(string $inviteToken): Pocket
    {
        /** @var Pocket $pocket */
        if (!$pocket = $this->repo->findOneBy(['inviteToken.token' => $inviteToken])) {
            throw new EntityNotFoundException('Pocket is not found.');
        }

        return $pocket;
    }

    /**
     * @param Id $id
     * @return Pocket
     * @throws EntityNotFoundException
     */
    public function get(Id $id): Pocket
    {
        /** @var Pocket $pocket */
        if (!$pocket = $this->repo->find($id->getValue())) {
            throw new EntityNotFoundException('Pocket is not found.');
        }

        return $pocket;
    }

    /**
     * @param Pocket $pocket
     */
    public function add(Pocket $pocket): void
    {
        $this->em->persist($pocket);
    }
}