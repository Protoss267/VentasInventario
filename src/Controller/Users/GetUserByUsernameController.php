<?php


namespace App\Controller\Users;


use App\Service\Users\GetUserByUsernameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetUserByUsernameController extends AbstractController
{
    private GetUserByUsernameService $getUserByUsernameService;

    public function __construct(GetUserByUsernameService $getUserByUsernameService)
    {

        $this->getUserByUsernameService = $getUserByUsernameService;
    }

    public function __invoke(string $username)
    {
        return $this->getUserByUsernameService->__invoke($username);
    }
}