<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\GroupOfEntities;
use App\Form\GroupEntityType;
use Doctrine\ORM\EntityManagerInterface;

class ExampleController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/")
     */
    public function index(Request $request)
    {
        $groupEntity = new GroupOfEntities;
        $form = $this->createForm(GroupEntityType::class, $groupEntity);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($groupEntity);
            $this->flush();
        }

        return $this->render('SomeTemplates/NewGroupTemplate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}