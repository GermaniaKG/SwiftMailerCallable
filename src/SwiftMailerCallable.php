<?php
namespace Germania\SwiftMailerCallable;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Psr\Log\LoggerAwareInterface;

class SwiftMailerCallable implements LoggerAwareInterface
{

    /**
     * @var Swift_Mailer
     */
    public $mailer;

    /**
     * @var Callable
     */
    public $message_factory;

    /**
     * @var LoggerInterface
     */
    public $logger;



    /**
     * @param Swift_Mailer $mailer
     * @param Callable $message_factory Factory returning new Swift_Message instance
     */
    public function __construct( \Swift_Mailer $mailer, Callable $message_factory, LoggerInterface $logger = null )
    {
        $this->mailer  = $mailer;
        $this->message_factory = $message_factory;
        $this->setLogger($logger ?: new NullLogger);
    }

    /**
     * @param  string       $subject Mail Subject
     * @param  string       $text    Mail Body
     * @param  string|array $to      Recipients
     *
     * @return int
     *
     * @throws RuntimeException if factory did not return instance of Swift_Message
     */
    public function __invoke($subject, $text, $to = null)
    {
        $message_factory = $this->message_factory;
        $message = $message_factory();

        if (!$message instanceOf \Swift_Message) {
            throw new \RuntimeException( 'Factory did not return Swift_Message instance.');
        }

        $subject = trim(implode(" ", [
            $message->getSubject(),
            $subject
        ]));


        $message->setSubject( $subject );

        $message->setBody( $text );

        if ($to) {
            $to = is_array($to) ? $to : [ $to ];
            $message->setTo( $to );
        }


        if ($result = $this->mailer->send( $message )):
            $this->logger->info("Successfully sent mail", ['to' => implode(", ", $to) ]);
        else:
            $this->logger->error("Failed sending mail", ['to' => implode(", ", $to) ]);
        endif;

        return $result;
    }

    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
