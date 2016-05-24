<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 24/05/16
 * Time: 09:22
 */

namespace OC\CoreBundle\Services;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class Mailer
{
    private $mailer;
    private $templating;
    private $html2pdf;
    private $subject;
    private $body;

    /**
     * @param $mailer
     * @param EngineInterface $templating
     */
    public function __construct($mailer, EngineInterface $templating, $html2pdf)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->html2pdf = $html2pdf;
    }

    /**
     * @param $customerEmail
     * @param $visitors
     */
    public function reservationConfirm($customerEmail, $visitors)
    {
        $this->subject = 'Réservation billet - Musée du Louvre';
        $this->doTemplate('OCCoreBundle:Emails:confirmReservation.html.twig', array());

        $this->send($customerEmail, $visitors);
    }

    /**
     * @param $template
     * @param array $options
     */
    private function doTemplate($template, array $options)
    {
        $this->body = $this->templating->render($template, $options);
    }

    /**
     * @param $customerEmail
     * @param $visitors
     */
    public function send($customerEmail, $visitors)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom('no-reply@louvre.fr')
            ->setTo($customerEmail)
            ->setBody($this->body, 'text/html')
        ;

        $this->addAttachment($visitors, $message);

        $this->mailer->send($message);
    }

    /**
     * @param $visitors
     * @param $message
     */
    private function addAttachment($visitors, $message)
    {
        foreach ($visitors as $visitor) {
            $html = $this->templating->render('OCCoreBundle:Emails:reservation.html.twig', array('visitor' => $visitor));
            $codeReservation = $visitor->getTicket()->getCodeReservation();
            $this->html2pdf->generate($html, $codeReservation);
            $message->attach(\Swift_Attachment::fromPath('./pdf/reservation'.$codeReservation.'.pdf'));
        }

        return $message;
    }

}