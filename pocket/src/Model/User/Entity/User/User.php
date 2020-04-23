<?php


namespace App\Model\User\Entity\User;


use DateTimeImmutable;

class User
{
    private const STATUS_WAIT = 'wait';
    private const STATUS_ACTIVE = 'active';

    private Id $id;
    private DateTimeImmutable $date;
    private Email $email;
    private string $passwordHash;
    private string $confirmToken;
    private string $status;

    public function __construct(Id $id, DateTimeImmutable $date, Email $email, string $hash, string $confirmToken)
    {
        $this->id = $id;
        $this->date = $date;
        $this->email = $email;
        $this->passwordHash = $hash;
        $this->confirmToken = $confirmToken;
        $this->status = self::STATUS_WAIT;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * @return Id
     */
    public function getId(): Id
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
     * @return Email
     */
    public function getEmail(): Email
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

    /**
     * @return string
     */
    public function getConfirmToken(): string
    {
        return $this->confirmToken;
    }
}