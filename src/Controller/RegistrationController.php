<?php

namespace App\Controller;

use App\User\ApplicationService\DTO\RegisterUserRequest;
use App\User\ApplicationService\RegisterUser;
use App\User\Infrastructure\Framework\Form\Model\RegistrationFormModel;
use App\User\Infrastructure\Framework\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(RegisterUser $registerUser, Request $request): Response
    {
        $model = new RegistrationFormModel();
        $form = $this->createForm(RegistrationFormType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $registerUserRequest = new RegisterUserRequest(
                $model->name(),
                $model->lastName(),
                $model->phone(),
                $model->email(),
                $model->plainPassword(),
                $model->department(),
                $model->company(),
                $model->roles()
            );

            $registerUser->__invoke($registerUserRequest);

            return $this->redirectToRoute('app_register');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
