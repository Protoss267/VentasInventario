<?php


namespace App\Service\Solds;


use App\Repository\SoldRepository;

class GetSoldsByDayService
{
    private SoldRepository $soldRepository;

    public function __construct(SoldRepository $soldRepository){
        $this->soldRepository = $soldRepository;
    }

    public function __invoke()
    {

    }
}