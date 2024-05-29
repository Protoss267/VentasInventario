<?php


namespace App\Repository;


use App\Entity\User;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UserRepository extends BaseRepository
{

    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findOneByUsernameOrFail(string $username):User
    {
        if (null === $user=$this->objectRepository->findOneBy(['username' => $username])){
            throw new \Exception(sprintf('User %s not found',$username));
        }

        return $user;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(User $user):void
    {
        $this->saveEntity($user);
    }

    public function delete(User $user)
    {
        $this->deleteEntity($user);
        $this->getEntityManager()->flush();
    }

    public function findAllUsers(){
        return $this->objectRepository
            ->createQueryBuilder('u')
            ->getQuery()->getResult();
    }

    public function findUserById(string $id)
    {
        return $this->objectRepository->
        createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id',$id)
            ->getQuery()->getOneOrNullResult();
    }

    public function findUserByUsername(string $username):User
    {
        return $this->objectRepository
            ->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameter('username',$username)
            ->getQuery()->getOneOrNullResult();
    }
}