<?php


namespace App\Controller\Users;


use App\Service\Users\GetUserServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetUsersController extends AbstractController
{
    private GetUserServices $getUserServices;

    public function __construct(GetUserServices $getUserServices)
    {
        $this->getUserServices = $getUserServices;
    }

    public function __invoke()
    {
        return $this->getUserServices->__invoke();
    }
}