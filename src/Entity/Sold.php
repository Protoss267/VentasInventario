<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Sold
{
    private string $id;
    private Collection $items;
    private  $date;
    private  $tranfer;
    private  $amount;


    public function __construct( bool $tranfer)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->items = new ArrayCollection();
        $this->date = new \DateTime('now');
        $this->tranfer = $tranfer;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getItem(): ArrayCollection|Collection
    {
        return $this->items;
    }

    public function setItem(ArrayCollection|Collection $items): void
    {
        $this->items = $items;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function isTranfer(): bool
    {
        return $this->tranfer;
    }

    public function setTranfer(bool $tranfer): void
    {
        $this->tranfer = $tranfer;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function toArray():array
    {
        return [
            'id'=>$this->id,
            'amount'=>$this->amount,
            'transfer'=>$this->tranfer,
            'fecha'=>$this->date->format('d-m-y h:i:s'),
            'items'=>array_map(function (Item $item):array{
                 return $item->toArray();
            },$this->items->toArray()),
        ];
    }




}