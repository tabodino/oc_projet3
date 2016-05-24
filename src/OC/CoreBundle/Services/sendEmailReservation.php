<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 23/05/16
 * Time: 18:31
 */

namespace OC\CoreBundle\Services;


class sendEmailReservation
{
    protected $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function send()
    {
        $this->mailer->send($message);
    }

    private function getMessage()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject()
            ->setFrom('noreply@louvre.fr')
            ->setTo($customer->getEmail())
            ->setBody(
                $this->renderView(
                    'OCCoreBundle:Emails:confirmReservation.html.twig'
                ), 'text/html'
        );

        return $message;
    }

    private function addAttachment($message)
    {
        foreach ($visitors as $visitor) {
            // $codeReservation = $visitor->getTicket();
            $message->attach(\Swift_Attachment::fromPath('./pdf/reservationtest.pdf'));
        }
    }
}