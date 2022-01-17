<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

/**
 * @Route("/")
 */
class PostController extends AbstractController
{
    /**
     * @Route("", defaults={"page"="1"})
     * @Route("/{page<\d+>?}", name="post_index", methods={"GET"})
     */
    public function index(PostRepository $postRepository, int $page): Response
    {
        //définir le nombre d'éléments par page
        $limit = 6;
        
        //récupérer les posts de la page
        $posts = $postRepository->getPaginatedPosts($page, $limit);

        //récupérer le nombre total de posts
        $total = $postRepository->getTotalPosts();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }

    /**
     * 
     * @Security("is_granted('ROLE_USER')")
     * 
     * @Route("post/new", name="post_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $title = "Ajouter un article";
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$post->setUrlAlias($slugger->slug($post->getTitle()));
            //$post->setPublished(new \DateTime());
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Un article a été ajouté !');

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/new.html.twig', [
            'title' => $title,
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("post/{slug}", name="post_show", methods={"GET"})
     */
    public function show(PostRepository $postRepository, string $slug): Response
    {   
        //last 5 posts
        $page = 1; 
        $limit = 5;

        $featuredPosts = $postRepository->getPaginatedPosts($page, $limit);

        $post = $postRepository->findOneBy(['url_alias' => $slug]);
        if (!$post) {
            //return $this->render('exception/error404.html.twig');
            throw $this->createNotFoundException('Pas d\'article correspond à cette url.');
        }
        return $this->render('post/show.html.twig', [
            'post' => $post,
            'featuredPosts' => $featuredPosts,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * 
     * @Route("post/{slug}/edit", name="post_edit", methods={"GET","POST"})
     */
    public function edit(PostRepository $postRepository, Request $request, string $slug): Response
    {
        $post = $postRepository->findOneBy(['url_alias' => $slug]);
        $title = "Modifier l'article";

        if (!$post) {
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$slugger = new AsciiSlugger();
            //$post->setUrlAlias($slugger->slug($post->getTitle()));
            //$post->setPublished(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\'article a été modifié !');

            return $this->redirectToRoute('post_show', [
                'slug' => $post->getUrlAlias()
            ]);
        }

        return $this->render('post/new.html.twig', [
            'title' => $title,
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * 
     * @Route("post/supprimer/{id}", name="post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Post $post): Response
    {
        if ($this->isCsrfTokenValid('delete' . $post->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();

            $this->addFlash('warning', 'L\'article a été supprimé !');
        }

        return $this->redirectToRoute('post_index');
    }
}
