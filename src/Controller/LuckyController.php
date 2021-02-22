<?php


namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number", name="app_lucky_number")
     */
    public function number()
    {
        $number = mt_rand(0,100);
        return $this->render(
            'lucky/number.html.twig',
            [
                'number' => $number
            ]
        );
    }

    /**
     * @Route("/time/now", name="app_time_now")
     */
    public function timeNow()
    {
        $date = new \DateTime('now');
        return $this->render('lucky/timeNow.html.twig',
        [
            'date' => $date
        ]);
    }

    /**
     * @Route("/color/{couleur}", name="app_color")
     *
     */
    public function color($couleur)
    {
        return $this->render('lucky/color.html.twig', [
           'couleur' => $couleur
        ]);
    }

    /**
     * @Route("/toto", name="app_toto")
     *
     */
    public function toto(Request $request)
    {
        //dump($request);

        return $this->render('lucky/boucle.html.twig', [
            'tableau' => [
                'H001',
                'H002',
                'H003',
                'H004',
                'H005',
                'H006',
                'H007',
                'H008',
                'H009'
            ]
        ]);

    }

}
