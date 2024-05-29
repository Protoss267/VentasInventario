<?php


namespace App\Entity;


use Symfony\Component\Uid\Uuid;

class Item
{
    private string $id;
    private Product $product;
    private float $price;
    private float $amount;
    private Sold $sold;

    public function __construct()
    {
        $this->id=Uuid::v4()->toRfc4122();
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return Sold
     */
    public function getSold(): Sold
    {
        return $this->sold;
    }

    /**
     * @param Sold $sold
     */
    public function setSold(Sold $sold): void
    {
        $this->sold = $sold;
    }

    public function toArray():array
    {
        return [
            'id'=>$this->id,
            'product'=>$this->product,
            'price'=>$this->price,
            'amount'=>$this->amount,
            'sold'=>$this->sold
        ];
    }


}