<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="default")
     * @Route("/home", name="home")
     * @Route("/search/{search}", name="search", defaults={"search"=""})
     */
    public function index(PostRepository $PostRepo, $search = ""): Response
    {
        $Posts = [];
        if (!empty($search)) {
            $Posts = $PostRepo->customSearch($search);
        } else {
            $Posts = $PostRepo->findAll();
        }

        return $this->render('home/index.html.twig', [
            "Posts" => $Posts
        ]);
    }
}
