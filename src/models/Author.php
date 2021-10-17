<?php


namespace Alejandro\Library\models;


use DateTime;

class Author
{
    private int $id;
    private string $fullName;
    private DateTime $birthDay;

    public function __construct(int $id, string $fullName, DateTime $birthDay)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->birthDay = $birthDay;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return DateTime
     */
    public function getBirthDay(): DateTime
    {
        return $this->birthDay;
    }

    /**
     * @param DateTime $birthDay
     */
    public function setBirthDay(DateTime $birthDay): void
    {
        $this->birthDay = $birthDay;
    }


}