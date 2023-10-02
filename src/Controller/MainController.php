<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home()
    {
        $text = 'Coucou !';
        echo $text;
        die();
    }

    /**
     * @Route("/test", name="main_test")
     */
    public function test()
    {
        $text = 'Test !';
        echo $text;
        die();
    }
}