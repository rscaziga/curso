<?php
namespace App\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
* @Rest\Route("/api")
*/
class UsuarioController extends AbstractController
{
    /**
     * @Rest\Get("/usuario", name="obtener_usuarios")
     */
    public function obtenerUsuarios()
    {
        $usuarios = $this->getDoctrine()->getRepository(Usuario::class)->findAll();
        if ($usuarios == null) {
            return new JsonResponse('No hay usuarios', Response::HTTP_NOT_FOUND);
        }

        return $usuarios;
    }

    /**
     * @Rest\Get("/usuario/{id}", name="buscar_usuario")
     */
    public function buscarUsuario($id)
    {
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($id);
        if ($usuario == null) {
            return new JsonResponse('El usuario buscado no existe', Response::HTTP_NOT_FOUND);
        }

        return $usuario;
    }

    /**
     * @Rest\Post("/usuario/", name="insertar_usuario")
     */
    public function insertarUsuario(Request $request)
    {
        $apellido = $request->request->get('apellido');
        $nombre = $request->request->get('nombre');
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $apodo = $request->request->get('apodo');
        
        if (empty($apellido) || empty($nombre) || empty($username) || empty($password)) {
            return new JsonResponse('Ingrese los datos obligatorios del usuario', Response::HTTP_NOT_ACCEPTABLE);
        }
        $data = new Usuario();
        $data->setApellido($apellido);
        $data->setNombre($nombre);
        $data->setUsername($username);
        $data->setPassword($password);
        $data->setApodo($apodo);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();

        return new JsonResponse('El usuario fue insertado', Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/usuario/{id}", name="actualizar_usuario")
     */
    public function actualizarUsuario($id, Request $request)
    {
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($id);
        if (empty($usuario)) {
            return new JsonResponse('El usuario buscado no existe', Response::HTTP_NOT_FOUND);
        }
        $apellido = $request->request->get('apellido');
        $nombre = $request->request->get('nombre');
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $apodo = $request->request->get('apodo');
        
        if (empty($apellido) || empty($nombre) || empty($username) || empty($password)) {
            return new JsonResponse('Ingrese los datos obligatorios del usuario', Response::HTTP_NOT_ACCEPTABLE);
        }

        $usuario->setApellido($apellido);
        $usuario->setNombre($nombre);
        $usuario->setUsername($username);
        $usuario->setPassword($password);
        $usuario->setApodo($apodo);

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('El usuario fue actualizado', Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/usuario/{id}", name="eliminar_usuario")
     */
    public function eliminarUsuario($id)
    {
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($id);
        if (empty($usuario)) {
            return new JsonResponse('El usuario solicitado no existe', Response::HTTP_NOT_FOUND);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($usuario);
        $em->flush();

        return new JsonResponse('El usuario fue eliminado', Response::HTTP_OK);
    }
}