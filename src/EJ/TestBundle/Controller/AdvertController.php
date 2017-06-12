<?php

// src/EJ/TestBundle/Controller/AdvertController.php

namespace EJ\TestBundle\Controller;

use EJ\TestBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        // Notre liste d'annonce en dur
        $listAdverts = array(
            array(
                'title'   => 'Actualité',
                'id'      => 1,
                'content' => 'Nos dernières actualités'
            ),
            array(
                'title'   => 'Nos services',
                'id'      => 2,
                'content' => 'Ce que nous pouvons vous offrir'
            ),
            array(
                'title'   => 'Equipe',
                'id'      => 3,
                'content' => 'Waouhhh, l équipe'
            ),
            array(
                'title'   => 'Nos projets',
                'id'      => 4,
                'content' => 'Nos projets en cours'
            ),
            array(
                'title'   => 'Galerie',
                'id'      => 5,
                'content' => 'Visionnez notre superbe galerie'
            ),
            array(
                'title'   => 'Contacts',
                'id'      => 6,
                'content' => 'Ma page Contact'
            )
        );

        return $this->render('EJTestBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts,
        ));
    }

    public function viewAction($id)
    {
        $advert = array(
            'title'   => 'Actualité',
            'id'      => $id,
            'content' => 'Nos dernières actualités',

        );

        return $this->render('EJTestBundle:Advert:view.html.twig', array(
            'advert' => $advert
        ));
    }


    public function addAction(Request $request)
    {
        $advert = new Advert();
        $advert->setTitle('Mon second Article en db');
        $advert->setAuthor('Jamar Eric');
        $advert->setContent('Ca n\'en fini pas les ajouts en db');
        $date = new \DateTime();
        $advert->setDate($date);


        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();

        if($request->isMethod('POST')){
            $request->getSession()->getFlashBag()->add('notice','annonce bien enregistrée');
            return $this->redirectToRoute('ej_platform_view',array('id' =>$advert->getId()));
        }
        return $this->render('EJTestBundle:Advert:add.html.twig',array('advert'=>$advert));
    }
}

