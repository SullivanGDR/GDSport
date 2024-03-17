<?php

namespace App\EventListener;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;


class AuthenticationSuccessListener{

  /**
    * @param AuthenticationSuccessEvent $event
  */
  public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
  {
    $data = $event->getData();
    $user = $event->getUser();

    if (!$user instanceof UserInterface) {
        return;
    }

    $data['data'] = array(
        'roles' => $user->getRoles(),
        'id' => $user->getId(),
        'email' => $user->getEmail(), 
        'nom' => $user->getNom(),
        'prenom' => $user->getPrenom(),
        'adresse' => $user->getAdresse(),
        'pays' => $user->getPays(),
        'ville' => $user->getVille(),
        'codePostal' => $user->getCodePostal(),
    );

    $event->setData($data);
  }
}
        

     