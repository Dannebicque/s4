<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostCategoryRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     *
     * @return Response
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        //Créer une page qui va sauvegarder un post avec le nom Post 1 à la date courante avec comme contenu Lorem ipsum et en enable à true.
        $post = new Post();
        $post->setTitle('Post 1');
        $post->setContext('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper tellus vitae ante euismod tempus. Quisque non est luctus, tempus felis quis, pellentesque nulla. Sed hendrerit nulla ut ullamcorper dignissim. Aliquam eleifend, mi a gravida ullamcorper, odio nisl volutpat diam, sit amet commodo purus massa et libero. Nunc in porttitor libero, sit amet elementum ex. Donec nisi tellus, malesuada porta porttitor auctor, consequat eget felis. Nunc rhoncus sapien imperdiet nisi mattis pharetra non sed augue. Curabitur rhoncus libero magna, egestas pretium ipsum dignissim at. Nullam vulputate ut tortor et dignissim. Pellentesque eget diam sed augue auctor mollis quis in turpis. Donec gravida justo at magna dictum, eget posuere nibh ultrices. Suspendisse at aliquam mauris. Nam iaculis ipsum justo, at viverra turpis vulputate id. Sed convallis faucibus mi. Mauris tempor ante a dignissim porta.');
        $post->setEnable(true);
        $entityManager->persist($post);
        $entityManager->flush();

        return $this->render('post/index.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/liste", name="post_liste")
     *
     * @return Response
     */
    public function liste(PostRepository $postRepository, PostCategoryRepository $postCategoryRepository): Response
    {
        $posts = $postRepository->findAll();
        $postCategories = $postCategoryRepository->findAll();

        return $this->render('post/liste.html.twig',
        [
            'posts' => $posts,
            'postCategories' => $postCategories
        ]);

    }
}
