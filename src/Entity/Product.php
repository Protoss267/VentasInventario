<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Uid\Uuid;

class Product
{
    private string $id;
    private string $codigo;
    private string $name;
    private float $priceI;
    private float $priceF;
    private \DateTime $dateIn;
    private \DateTime $dateUpdated;
    private float $stock;



    public function __construct(string $codigo, string $name, float $priceI, float $priceF, float $stock)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->codigo = $codigo;
        $this->name = $name;
        $this->priceI = $priceI;
        $this->priceF = $priceF;
        $this->dateIn = new \DateTime('now');
        $this->dateUpdated = new \DateTime();
        $this->stock = $stock;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPriceI(): float
    {
        return $this->priceI;
    }

    public function setPriceI(float $priceI): void
    {
        $this->priceI = $priceI;
    }

    public function getPriceF(): float
    {
        return $this->priceF;
    }

    public function setPriceF(float $priceF): void
    {
        $this->priceF = $priceF;
    }

    public function getDateIn(): \DateTime
    {
        return $this->dateIn;
    }

    public function getDateUpdated(): \DateTime
    {
        return $this->dateUpdated;
    }

    public function markAsUpdate(): void
    {
        $this->dateUpdated = new \DateTime('now');
    }

    public function getStock(): float
    {
        return $this->stock;
    }

    public function setStock(float $stock): void
    {
        $this->stock = $stock;
    }

    public function toArray():array
    {
        return [
            'id'=>$this->id,
            'codigo'=>$this->codigo,
            'name'=>$this->name,
            'priceI'=>$this->priceI,
            'priceF'=>$this->priceF,
            'stock'=>$this->stock,
            'dateIn'=>$this->dateIn->format('d-m-y'),
            'dateUp'=>$this->dateUpdated
        ];
    }
}