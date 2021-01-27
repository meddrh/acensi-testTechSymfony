<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class APIController extends AbstractController
{
    /**
     * @Route("/students/list", name="liste", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns all students",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Reward::class, groups={"full"}))
     *     )
     * )
     * @SWG\Parameter(
     *     name="students",
     *     in="query",
     *     type="string",
     *     description="students repo"
     * )
     * @SWG\Tag(name="rewards")
     * @Security(name="Bearer")
     */
    public function index(StudentRepository $studentsRepo): Response
    {
        // On récupère la liste des etudiants
        $articles = $studentsRepo->findAll();

        // On spécifie qu'on utilise l'encodeur JSON
        $encoders = [new JsonEncoder()];

        // On instancie le "normaliseur" pour convertir la collection en tableau
        $normalizers = [new ObjectNormalizer()];

        // On instancie le convertisseur
        $serializer = new Serializer($normalizers, $encoders);

        // On convertit en json
        $jsonContent = $serializer->serialize($articles, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        // On instancie la réponse
        $response = new Response($jsonContent);

        // On ajoute l'entête HTTP
        $response->headers->set('Content-Type', 'application/json');

        dump($response);
        // On envoie la réponse
        return $response;
    }
}
