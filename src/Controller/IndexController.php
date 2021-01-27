<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
    #    dd($em);
        
        $usuarios = $em->getRepository(Usuario::class)->findAll();
    #   dd($usuarios);

        return new Response($this->render('index.html.twig', ['lista' => $usuarios]));

    }
    
    /**
     * @Route("/todos/{valor_todos}", name="prueba_todos")
     */
    public function prueba_todos(Request $request, int $valor_todos): Response
    {
        return new Response($this->render('index_todos.html.twig', ['lista' => ['papas', 'bananas', 'manzanas'], 'todos' => $valor_todos]));
    }
}