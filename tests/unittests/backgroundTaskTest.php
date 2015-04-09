<?php
require_once(dirname(__FILE__).'/../../scripts/backgroundTask.php');
require_once(dirname(__FILE__).'/../../scripts/messageAdapter.php');
require_once(dirname(__FILE__).'/../../scripts/models/carrierEnum.php');
require_once(dirname(__FILE__).'/../../scripts/controllers/notificationMessageController.php');
require_once(dirname(__FILE__).'/../../scripts/controllers/notificationMessageFactory.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

/**
 * Class backgroundTaskTest
 *
 * Integration test for the backgroundTask class.
 */
class backgroundTaskTest extends unitTestBase {
    private $mockMailer;
    private $mockMessageFactory;

    /**
     * Setup
     */
    public function setUp(){
        //Construct a mock mailer object and factory for dependency injection.
        $this->mockMailer = $this->getMock('emailer', array('sendMail','sendSMS'));
        $this->mockMessageFactory = $this->getMock('notificationMessageFactory', array('create'));

        $this->mockMessageFactory->expects($this->any())->method('create')->will($this->returnCallback(
            function($child, $messageStatus){
                return new notificationMessageController($child, $messageStatus, $this->mockMailer);
            }
        ));

        parent::setUp();
    }

    /**
     * Tests the backgroundTask using default test database.
     */
    public function testBackgroundEmailsDefault(){
        $expectedEmailTos = array(
            'parent19@gmail.com',
            'parent19@gmail.com',
            'parent19@gmail.com',
            'parent19@gmail.com',
            'parent19@gmail.com'
        );

        $expectedEmailSubjs = array(
            'Urgent Message from CheckinChildren',
            'Urgent Message from CheckinChildren',
            'Message from CheckinChildren',
            'Message from CheckinChildren',
            'Urgent Message from CheckinChildren'
        );

        $expectedEmailMsgs = array(
            'Your child Ludvig Beethoven has not arrived to daycare yet',
            'Your child Child Missing2 has not arrived to daycare yet',
            'Your child Late Parent2 is ready to be picked up',
            'Your child Late Parent1 is ready to be picked up',
            'Your child Child Missing1 has not arrived to daycare yet'
        );

        $expectedSmsTos = array(
            '6786546789',
            '6786546789',
            '6786546789',
            '6786546789',
            '6786546789'
        );

        $expectedSmsCarriers = array(
            carrier::boost,
            carrier::boost,
            carrier::boost,
            carrier::boost,
            carrier::boost
        );

        $expectedSmsMsgs = array(
            'Your child Ludvig Beethoven has not arrived to daycare yet',
            'Your child Child Missing2 has not arrived to daycare yet',
            'Your child Late Parent2 is ready to be picked up',
            'Your child Late Parent1 is ready to be picked up',
            'Your child Child Missing1 has not arrived to daycare yet'
        );

        /*$this->mockMailer->expects($this->exactly(5))
            ->method('sendMail')
            ->withConsecutive(
                array($this->equalTo($expectedEmailTos[0]), $this->equalTo($expectedEmailSubjs[0]), $this->equalTo($expectedEmailMsgs[0])),
                array($this->equalTo($expectedEmailTos[1]), $this->equalTo($expectedEmailSubjs[1]), $this->equalTo($expectedEmailMsgs[1])),
                array($this->equalTo($expectedEmailTos[2]), $this->equalTo($expectedEmailSubjs[2]), $this->equalTo($expectedEmailMsgs[2])),
                array($this->equalTo($expectedEmailTos[3]), $this->equalTo($expectedEmailSubjs[3]), $this->equalTo($expectedEmailMsgs[3])),
                array($this->equalTo($expectedEmailTos[4]), $this->equalTo($expectedEmailSubjs[4]), $this->equalTo($expectedEmailMsgs[4]))
            );

        $this->mockMailer->expects($this->exactly(5))
            ->method('sendSMS')
            ->withConsecutive(
                array($this->equalTo($expectedSmsTos[0]), $this->equalTo($expectedSmsCarriers[0]), $this->equalTo($expectedSmsMsgs[0])),
                array($this->equalTo($expectedSmsTos[1]), $this->equalTo($expectedSmsCarriers[1]), $this->equalTo($expectedSmsMsgs[1])),
                array($this->equalTo($expectedSmsTos[2]), $this->equalTo($expectedSmsCarriers[2]), $this->equalTo($expectedSmsMsgs[2])),
                array($this->equalTo($expectedSmsTos[3]), $this->equalTo($expectedSmsCarriers[3]), $this->equalTo($expectedSmsMsgs[3])),
                array($this->equalTo($expectedSmsTos[4]), $this->equalTo($expectedSmsCarriers[4]), $this->equalTo($expectedSmsMsgs[4]))
            );



        $task = new backgroundTask($this->mockMessageFactory);
        $task->sendEmailsAndTexts();

        //Multiple send calls only send each message once.
        $task->sendEmailsAndTexts();*/
    }

    /**
     * Tests the backgroundTask using custom test database.
     */
    public function testBackgroundMessagesCustom(){
        $sql = file_get_contents(dirname(__FILE__).'/../../sql/generateMessageTestData.sql');
        $dbConn = DbConnectionFactory::create();
        $dbConn->exec($sql);

        $expectedEmailTos = array(
            'mwallic2@illinois.edu',
            'mcwallick@gmail.com'
        );

        $expectedEmailSubjs = array(
            'Urgent Message from CheckinChildren',
            'Message from CheckinChildren'
        );

        $expectedEmailMsgs = array(
            'Your child Late Wallick has not arrived to daycare yet',
            'Your child Late Kennedy is ready to be picked up'
        );

        $expectedSmsTos = array(
            '6163895565'
        );

        $expectedSmsCarriers = array(
            carrier::sprint
        );

        $expectedSmsMsgs = array(
            'Your child Late Wallick has not arrived to daycare yet'
        );
/*
        $this->mockMailer->expects($this->exactly(2))
            ->method('sendMail')
            ->withConsecutive(
                array($this->equalTo($expectedEmailTos[0]), $this->equalTo($expectedEmailSubjs[0]), $this->equalTo($expectedEmailMsgs[0])),
                array($this->equalTo($expectedEmailTos[1]), $this->equalTo($expectedEmailSubjs[1]), $this->equalTo($expectedEmailMsgs[1]))
            );

        $this->mockMailer->expects($this->exactly(1))
            ->method('sendSMS')
            ->withConsecutive(
                array($this->equalTo($expectedSmsTos[0]), $this->equalTo($expectedSmsCarriers[0]), $this->equalTo($expectedSmsMsgs[0]))
            );


        $task = new backgroundTask($this->mockMessageFactory);
        $task->sendEmailsAndTexts();
        $task->sendEmailsAndTexts();*/
    }
}