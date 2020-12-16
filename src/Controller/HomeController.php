<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $user =  new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                ->from('beedigital2019@gmail.com')
                ->to($user->getEmail())
                ->subject('Bien chez Bee Digital')
                ->htmlTemplate('home/email.html.twig')
                ->context([
                    'user' => $user,
                ]);

            $mailer->send($email);
            $this->addFlash('success', 'Votre email a été bien envoyé ');
            return $this->redirectToRoute('home_page');
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
}
