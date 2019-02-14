<?php
namespace tests;

use Germania\SwiftMailerCallable\SwiftMailerCallable;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use \Swift_Mailer;
use \Swift_Message;
use Prophecy\Argument;

class SwiftMailerCallableTest extends \PHPUnit\Framework\TestCase
{

    public function testInstantiation()
    {

        $mailer = $this->prophesize( Swift_Mailer::class );
        $mailer_mock = $mailer->reveal();

        $message = $this->prophesize( Swift_Message::class );
        $message_mock = $message->reveal();

        $message_factory = function() use ($message_mock){
            return $message_mock;
        };

        $sut = new SwiftMailerCallable( $mailer_mock, $message_factory, new NullLogger );
    }


    /**
     * @dataProvider provideBoolResults
     */
    public function testInvokation( $bool_result )
    {

        $message = $this->prophesize( Swift_Message::class );
        $message->getSubject()->shouldBeCalled();
        $message->setSubject( Argument::any() )->shouldBeCalled();
        $message->setBody( Argument::any() )->shouldBeCalled();
        $message_mock = $message->reveal();

        $mailer = $this->prophesize( Swift_Mailer::class );
        $mailer->send( $message_mock )->willReturn( $bool_result );
        $mailer_mock = $mailer->reveal();


        $message_factory = function() use ($message_mock){
            return $message_mock;
        };

        $sut = new SwiftMailerCallable( $mailer_mock, $message_factory, new NullLogger );

        $sut_result = $sut("subject line", "hello", null);
        $this->assertEquals( $bool_result, $sut_result);
    }


    /**
     * @dataProvider provideRecipients
     */
    public function testVariousRecipients( $recipient )
    {

        $message = $this->prophesize( Swift_Message::class );
        $message->getSubject()->shouldBeCalled();
        $message->setSubject( Argument::any() )->shouldBeCalled();
        $message->setBody( Argument::any() )->shouldBeCalled();

        if ($recipient):
            $message->setTo( Argument::any() )->shouldBeCalled();
        endif;
        $message_mock = $message->reveal();

        $mailer = $this->prophesize( Swift_Mailer::class );
        $mailer->send( $message_mock )->willReturn( true );
        $mailer_mock = $mailer->reveal();


        $message_factory = function() use ($message_mock){
            return $message_mock;
        };

        $sut = new SwiftMailerCallable( $mailer_mock, $message_factory, new NullLogger );

        $sut_result = $sut("subject line", "hello", $recipient);
        $this->assertTrue( $sut_result);
    }



    public function testRuntimeExceptionOnWrongMessageFactoryResult()
    {

        $mailer = $this->prophesize( Swift_Mailer::class );
        $mailer_mock = $mailer->reveal();

        $message_factory = function() {
            return "wrong thing";
        };

        $sut = new SwiftMailerCallable( $mailer_mock, $message_factory, new NullLogger );

        $this->expectException( \RuntimeException::class );
        $sut_result = $sut("subject line", "hello", null);
    }


    public function provideRecipients()
    {
        return array(
            [ false ],
            [ null ],
            [ "me@test.com" ],
            [ [ "me@test.com", "you@test.com" ] ]
        );
    }

    public function provideBoolResults()
    {
        return array(
            [ true ],
            [ false ],
        );
    }
}
