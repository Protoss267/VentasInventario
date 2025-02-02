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

    public function getSoldByWeek()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
        SELECT DATE(fecha_venta) AS dia, COUNT(id) AS total_ventas
        FROM sold
        WHERE fecha_venta BETWEEN :fechaInicio AND :fechaFin
        GROUP BY dia
        ORDER BY dia ASC
    ";

        $resultados = $conn->executeQuery($sql, [
            'fechaInicio' => (new \DateTime('2024-08-23 00:00:00'))->modify('-6 days')->format('Y-m-d 00:00:00'),
            'fechaFin'    => (new \DateTime('2024-08-23 00:00:00'))->format('Y-m-d 23:59:59'),
        ])->fetchAllAssociative();

        $ventasPorDia = [];
        foreach ($resultados as $resultado) {
            $ventasPorDia[$resultado['dia']] = (int) $resultado['total_ventas'];
        }

        return $ventasPorDia;
    }

    public function obtenerGanaciasMensuales()
    {
        // Obtener la fecha actual
        $currentDate = new \DateTime('2024-10-06 00:00:00');

        // Generar la fecha de hace 12 meses
        $startOf12MonthsAgo = (clone $currentDate)->modify('-12 months');

        // Consulta SQL nativa para obtener las ganancias por mes
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT
                YEAR(s.fecha_venta) AS year,
                MONTH(s.fecha_venta) AS month,
                SUM(s.total) AS totalEarnings
            FROM sold s
            WHERE s.fecha_venta >= :startDate
            AND s.fecha_venta <= :endDate
            GROUP BY YEAR(s.fecha_venta), MONTH(s.fecha_venta)
            ORDER BY YEAR(s.fecha_venta) DESC, MONTH(s.fecha_venta) DESC
        ";

        $results = $conn->executeQuery($sql, [
            'startDate' =>  $startOf12MonthsAgo->format('Y-m-d'),
            'endDate'    => $currentDate->format('Y-m-d'),
        ])->fetchAllAssociative();



        // Procesar los resultados para un formato más amigable
        $earnings = [];
        foreach ($results as $result) {
            $monthYear = $result['year'] . '-' . str_pad($result['month'], 2, '0', STR_PAD_LEFT); // Formato 'YYYY-MM'
            $earnings[$monthYear] = $result['totalEarnings'];
        }

        return $earnings;
    }

}