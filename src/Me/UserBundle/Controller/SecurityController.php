<?php
namespace Me\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_form")
     */
    public function loginAction(Request $request)
    {
        //
        $session = $request->getSession();


       //get login error if there is one
    //    if ( $request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR) ) {
    //        $error = $request->attribute->get(SecurityContextInterface::AUTHENTICATION_ERROR);
    //    } else  {
    //        $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
    //        $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
    //    }

    //get the login error if there is one
    $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
    $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);

    // $errors = [];
       
    //     //Last username entered by the user
    //     $errors['last_username'] = is_null($error) ? null : $error->get(SecurityContextInterface::LAST_USERNAME);
    //     $errors['error'] = $error;

        $errors = array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
            'error'         => $error,
        );
   
       return $this->render('UserBundle:Security:login.html.twig', $errors);
    }

    /**
     * @Route("/login_check", name="login_check")
    */
    public function loginCheckAction(Request $request)
    {
        //
        //var_dump($request);exit;
    }

    /**
     * @Route("/logout", name="logout")
    */
    public function logoutAction()
    {
        //
    }
}
?>