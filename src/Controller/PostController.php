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
    public function index(
        PostCategoryRepository $postCategoryRepository,
        EntityManagerInterface $entityManager): Response
    {
        $category = $postCategoryRepository->find(1);//on récupère une catégorie

        //Créer une page qui va sauvegarder un post avec le nom Post 1 à la date courante avec comme contenu Lorem ipsum et en enable à true.
        $post = new Post();
        $post->setTitle('Post 2');
        $post->setContext('texte.');
        $post->setEnable(true);
        $post->setCategory($category);//on associe la catégorie au post
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
