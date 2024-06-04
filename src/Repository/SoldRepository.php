<?php


namespace App\Repository;


use App\Entity\Sold;

class SoldRepository extends BaseRepository
{

    protected static function entityClass(): string
    {
        return Sold::class;
    }

    public function save(Sold $sold){
        $this->saveEntity($sold);
    }

    public function findOneById(string $id):?Sold
    {
        return $this->objectRepository->findOneBy(['id'=>$id]);
    }

    public function delete(Sold $sold){
        $this->deleteEntity($sold);
    }

    public function findAll()
    {
        return $this->objectRepository->createQueryBuilder('s')
            ->getQuery()->getResult();
    }

    public function getSoldByDay(\DateTime $fecha= null)
    {
        if(!$fecha)
        {
            $fecha= new \DateTime();
        }

        return $this->objectRepository->createQueryBuilder('s')
            ->where('s.date')
    }
}