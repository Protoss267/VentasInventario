<?php


namespace App\Repository;


use App\Entity\Product;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class ProductRepository extends BaseRepository
{

    protected static function entityClass(): string
    {
        return Product::class;
    }

    public function save(Product $product){
        $this->saveEntity($product);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function delete(Product $product)
    {
        $this->deleteEntity($product);
        $this->getEntityManager()->flush();
    }

    public function findAllProduct(){
        return $this->objectRepository->findAll();
    }

    public function findOneById(string $id):?Product{
        return $this->objectRepository->findOneBy(['id'=>$id]);
    }

    public function findOneByCod(string $cod):?Product
    {
        return $this->objectRepository->findOneBy(['codigo'=>$cod]);
    }

    public function GetLowStock()
    {
        return$this->objectRepository->createQueryBuilder('p')
            ->where('p.stock < 100')
            ->getQuery()->getResult();
    }
}