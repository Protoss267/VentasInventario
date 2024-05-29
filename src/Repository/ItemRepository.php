<?php


namespace App\Repository;


use App\Entity\Item;

class ItemRepository extends BaseRepository
{

    protected static function entityClass(): string
    {
        return Item::class;

    }

    public function save(Item $item)
    {
        $this->saveEntity($item);
    }
}