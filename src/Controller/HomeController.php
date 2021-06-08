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
        $posts = [];
        if (!empty($search)) {
            $posts = $PostRepo->customSearch($search);
        } else {
            $posts = $PostRepo->findAll();
        }

        return $this->render('home/index.html.twig', [
            "posts" => $posts
        ]);
    }
}
