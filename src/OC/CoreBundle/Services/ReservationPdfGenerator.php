<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 23/05/16
 * Time: 17:44
 */

namespace OC\CoreBundle\Services;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ReservationPdfGenerator
{
    /**
     * @param $html = vue twig de la page à convertir
     * @param $codeReservation = nommage du fichier de reservation
     */
    public function generate($html, $codeReservation)
    {
        $html2pdf = new \HTML2PDF();
        // Utilise la taille réel du document
        $html2pdf->pdf->SetDisplayMode('real');
        // Conversion html en pdf
        $html2pdf->writeHTML($html);
        // Enregistrement fichier de sortie
        $html2pdf->pdf->Output('./pdf/reservation'.$codeReservation.'.pdf',"F");
    }

}