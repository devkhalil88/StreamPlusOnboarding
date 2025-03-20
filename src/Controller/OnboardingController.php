<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserInfoType;
use App\Form\AddressType;
use App\Form\PaymentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/onboarding')]
class OnboardingController extends AbstractController
{

    #[Route('/step1', name: 'onboarding_step1')]
    public function step1(Request $request, SessionInterface $session): Response
    {

        if (!$session->isStarted()) {
            $session->start(); // Ensure session is active
        }

        $user = new User();
        $form = $this->createForm(UserInfoType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        /*
            if ($form->isSubmitted()) {
                dump($request->request->all());  // Check raw POST data
                dump($form->getData());         // Check if form mapped data correctly
                dump($form->isValid());         // See if validation is failing
                die();
            }
        */

            $session->set('user_data', $user);  // Store user data in session

            return $this->redirectToRoute('onboarding_step2');
        }

        return $this->render('onboarding/step1.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/step2', name: 'onboarding_step2')]
    public function step2(Request $request, SessionInterface $session): Response
    {
        $user = $session->get('user_data');

        $form = $this->createForm(AddressType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('user_data', $user);

            if ($user->getSubscriptionType() === 'premium') {
                return $this->redirectToRoute('onboarding_step3');
            }

            return $this->redirectToRoute('onboarding_confirm');
        }

        return $this->render('onboarding/step2.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/step3', name: 'onboarding_step3')]
    public function step3(Request $request, SessionInterface $session): Response
    {
        if (!$session->has('user_data')) {
            return $this->redirectToRoute('onboarding_step1');
        }

        // Directly retrieve the object
        $user = $session->get('user_data');

        $form = $this->createForm(PaymentType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('user_data', $user);
            return $this->redirectToRoute('onboarding_confirm');
        }

        return $this->render('onboarding/step3.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/confirm', name: 'onboarding_confirm')]
    public function confirm(SessionInterface $session): Response
    {
        $user = $session->get('user_data');

        if (!$user) {
            return $this->redirectToRoute('onboarding_step1');
        }

        return $this->render('onboarding/confirm.html.twig', ['user' => $user]);
    }

    #[Route('/submit', name: 'onboarding_submit', methods: ['POST'])]
    public function submit(SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        $user = $session->get('user_data');

        if (!$user) {
            return $this->redirectToRoute('onboarding_step1');
        }

        $entityManager->persist($user);
        $entityManager->flush();

        $session->remove('user_data'); // Clear session after saving

        return $this->redirectToRoute('onboarding_success');
    }

    #[Route('/success', name: 'onboarding_success')]
    public function success(): Response
    {
        return $this->render('onboarding/success.html.twig');
    }

    // Step 3 (Payment) and Step 4 (Confirmation) follow a similar structure.
}
