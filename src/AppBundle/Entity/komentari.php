<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * komentari
 *
 * @ORM\Table(name="komentari")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\komentariRepository")
 */
class komentari
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="komentar", type="string", length=255)
     */
    private $komentar;

    /**
     * @var string
     *
     * @ORM\Column(name="autor", type="string", length=255)
     */
    private $autor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set komentar
     *
     * @param string $komentar
     *
     * @return komentari
     */
    public function setKomentar($komentar)
    {
        $this->komentar = $komentar;

        return $this;
    }

    /**
     * Get komentar
     *
     * @return string
     */
    public function getKomentar()
    {
        return $this->komentar;
    }

    /**
     * Set autor
     *
     * @param string $autor
     *
     * @return komentari
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return komentari
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

