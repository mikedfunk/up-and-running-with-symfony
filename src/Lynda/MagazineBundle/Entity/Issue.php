<?php

namespace Lynda\MagazineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Issue
 *
 * @ORM\Table(name="issues")
 * @ORM\Entity(repositoryClass="Lynda\MagazineBundle\Entity\IssueRepository")
 */
class Issue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     * @Assert\Range(
     *  min = 1,
     *  minMessage = "You'll need to specify issue 1 or higher."
     * )
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="date")
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @var Publication
     *
     * @ORM\ManyToOne(targetEntity="Publication", inversedBy="issues")
     * @ORM\JoinColumn(name="publication_id", referencedColumnName="id")
     */
    private $publication;

    /**
     * the uploaded file
     *
     * @Assert\File(maxSize="1000000")
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    private $file;

    /**
     * setter
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file (default: null)
     * @return $this current entity for chaining
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * getter
     *
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Issue
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Issue
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set cover
     *
     * @param string $cover
     * @return Issue
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set publication
     *
     * @param \Lynda\MagazineBundle\Entity\Publication $publication
     * @return Issue
     */
    public function setPublication(\Lynda\MagazineBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \Lynda\MagazineBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * get the upload path dir
     *
     * @return string relative path
     */
    protected function getUploadPath()
    {
        return 'uploads/covers';
    }

    /**
     * absolute path to upload dir
     *
     * @return string
     */
    protected function getUploadAbsolutePath()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadPath();
    }

    /**
     * get the path to the cover file relative to the web dir
     * not used yet.
     *
     * @return null|string
     */
    public function getCoverWeb()
    {
        return null === $this->getCover() ?
            null :
            $this->getUploadPath() . '/' . $this->getCover();
    }

    /**
     * get the absolute path to the cover file
     *
     * @return null|string
     */
    public function getCoverAbsolute()
    {
        return null === $this->getCover() ?
            null :
            $this->getUploadAbsolutePath() . '/' . $this->getCover();
    }

    /**
     * upload a file
     *
     * @return void
     */
    public function upload()
    {
        // file property can be empty
        if (null === $this->getFile()) {
            return;
        }

        $filename = $this->getFile()->getClientOriginalName();

        // move the uploaded file to to target directory using original name
        $this->getFile()->move($this->getUploadAbsolutePath(), $filename);

        // set the cover
        $this->setCover($filename);
    }
}
