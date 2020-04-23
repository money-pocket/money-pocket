<?php


namespace App\Model\User\Entity\User;


use DateTimeImmutable;

class User
{
    private string $id;
    private DateTimeImmutable $date;
    private string $email;
    private string $passwordHash;

    public function __construct(string $id, DateTimeImmutable $date, string $email, string $passwordHash)
    {
        $this->id = $id;
        $this->date = $date;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}