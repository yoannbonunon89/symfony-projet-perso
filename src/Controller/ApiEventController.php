<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EventType;
use App\Entity\Event;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Service\EntityService;

/**
 * @Route("/api/event", name="api_event")
 */
class ApiEventController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request)
    {
        $data = $request->request->all();
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
        } else {
            throw new Exception("Le formulaire n'est pas valide", 409);
        }
        return $this->json([
            'message' => 'Le formulaire a bien etait valider',
            'event' => $event,
        ]);
    }

    /**
     * @Route("/list", name="get_all")
     */
    public function getAll()
    {
        $events = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findAll();

        if (!$events) {
            throw $this->createNotFoundException(
                'Pas d\'evenement trouver '
            );
        }
        return $this->json([
            'event' => $events,
        ]);
    }

    /**
     * @Route("/{event}", name="get_one")
     */
    public function getOne(Event $event)
    {
        return $this->json([
            'event' => $event,
        ]);
    }


    /**
     * @Route("/{event}/edit")
     */
    public function update(EntityService $entityservice, Request $request, Event $event)
    {
        $data = $request->request->all(); // Toute les donées envoyer dans le post
        $entityUpdated = $entityservice->UpdateEntityByJson($event, $data);
        $form = $this->createForm(EventType::class, $event,); // Creer un formulaire qui recupére toute les informations de l'event de base

        $form->submit($entityUpdated->serialize()); // Simule le formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entityUpdated);
            $em->flush();
        } else {
            throw new Exception("Le formulaire n'est pas valide", 409);
        }
        return $this->json([
            'event' => $entityUpdated
        ]);
    }
}
