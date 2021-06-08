<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\CreatFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContentController extends AbstractController
{
    /**
     * @Route("/new", name="new")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $post = new Post();
        $form = $this->createForm(CreatFormType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($this->getUser());
            $manager->persist($post);
            $manager->flush();
            return $this->redirectToRoute('home');
        } else {
            return $this->render('content/new.html.twig', [
                'createForm' => $form->createView()
            ]);
        }
    }
}
