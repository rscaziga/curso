<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Usuario;

class LoginController extends AbstractController
{
    /**
     * @Rest\Get("/", name="credenciales")
     */
    public function index(Request $request): Response
    {
        $username = "";
        $error = "";
        $apellido = "";
        $nombre = "";

        return new Response($this->render('login.html.twig', ['error' => $error, 'username' => $username, 'apellido' => $apellido, 'nombre' => $nombre]));
    }

    /**
     * @Rest\Post("/", name="login")
     */
    public function login(Request $request): Response
    {
        $error = "";
        $apellido = "";
        $nombre = "";

        $username = $request->request->get('username');

        if ($username)
        {
            $em = $this->getDoctrine()->getManager();
        
            $usuarios = $em->getRepository(Usuario::class)->findBy(array('username'=>$username));
        #    dd($usuarios);
            if (sizeof($usuarios) == 0){
                $error = "Usuario Inexistente. Verifique username";
            }
            else {
                $password = $request->request->get('password');
    
                $usuario = $usuarios[0];
                if ($password == $usuario->getPassword())
                {
                    $apellido = $usuario->getApellido();
                    $nombre = $usuario->getNombre();
                }
             else {
            $error = "Acceso Denegado. Verifique la contraseña";}
             }
        }

        return new Response($this->render('login.html.twig', ['error' => $error, 'username' => $username, 'apellido' => $apellido, 'nombre' => $nombre]));
    }
}