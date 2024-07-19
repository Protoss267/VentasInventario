<?php


namespace App\Service\Solds;


use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetOneSoldByIdService
{

    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke(string $id){
        $data=[];
        $response = new JsonResponse();
        if(!$id)
        {
            $data=['data'=>'Esa venta no se encuentra en el sistema'];
            $response->setData(['success'=>false,$data]);
        }
        else
        {
            $sold= $this->soldRepository->findOneById($id);

            if(!$sold)
            {
                $data=['data'=>'Esa venta no se encuentra en el sistema'];
                $response->setData(['success'=>false,$data]);
            }
            else
            {
                $data=['success'=>true,'data'=>$sold->toArray()];
                $response->setData($data);
            }
        }

        return $response;
    }
}