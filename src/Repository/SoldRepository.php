<?php


namespace App\Repository;


use App\Entity\Sold;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;

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
            ->where('s.date > :fechaI')
            ->andwhere('s.date < :fechaF')
            ->setParameter('fechaI',$fecha->format('Y-m-d').' '.'00:00:01')
            ->setParameter('fechaF',$fecha->format('Y-m-d').' '.'23:59:59')
            ->orderBy('s.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getSoldByDateRange(\DateTime $fechaI,\DateTime $fechaF)
    {
        return $this->objectRepository->createQueryBuilder('s')
            ->where('s.date > :fechaI')
            ->andwhere('s.date < :fechaF')
            ->setParameter('fechaI',$fechaI->format('Y-m-d').' '.'00:00:01')
            ->setParameter('fechaF',$fechaF->format('Y-m-d').' '.'23:59:59')
            ->orderBy('s.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAllOrderedByDate(): array
    {
        return $this->objectRepository->createQueryBuilder('s')
            ->orderBy('s.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getVentasUltimosSeisMesesAgrupadas()
    {
        $fechaLimite = new \DateTime('-6 months');

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('fecha', 'fecha');
        $rsm->addScalarResult('totalVentas', 'totalVentas');
        $rsm->addScalarResult('cantidadVentas', 'cantidadVentas');

        $sql = "
    SELECT 
        DATE_FORMAT(v.fecha_venta, '%Y-%m-%d') AS fecha, 
        SUM(v.total) AS totalVentas, 
        COUNT(v.id) AS cantidadVentas
    FROM sold v
    WHERE v.fecha_venta >= :fechaLimite
    GROUP BY fecha
    ORDER BY fecha ASC
";

        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        $query->setParameter('fechaLimite', $fechaLimite->format('Y-m-d'));

        return $query->getResult();
    }

    public function getVentasAgrupadasPorMes()
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('year', 'year');
        $rsm->addScalarResult('month', 'month');
        $rsm->addScalarResult('totalVentas', 'totalVentas');
        $rsm->addScalarResult('cantidadVentas', 'cantidadVentas');

        $sql = "
            SELECT 
                YEAR(v.fecha_venta) AS year, 
                MONTH(v.fecha_venta) AS month, 
                SUM(v.total) AS totalVentas, 
                COUNT(v.id) AS cantidadVentas
            FROM sold v
            WHERE v.fecha_venta >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
            GROUP BY year, month
            ORDER BY year ASC, month ASC
        ";

        return $this->getEntityManager()->createNativeQuery($sql, $rsm)->getResult();
    }



    public function obtenerVentasPorMes(int $mes, int $anno): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
            SELECT 
                p.name AS producto,
                SUM(i.amount) AS cantidad_vendida
            FROM item i
            JOIN product p ON i.product_id = p.id
            JOIN sold s ON i.sold_id = s.id
            WHERE YEAR(s.fecha_venta) = :year
            AND MONTH(s.fecha_venta) = :month
            GROUP BY p.name
            ORDER BY cantidad_vendida DESC
        ";

        $stmt = $conn->prepare($sql);
       return $stmt->executeQuery(['year' => $anno, 'month' => $mes])->fetchAllAssociative();


    }

}