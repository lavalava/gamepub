<?php
/**
 * Shaishai, the distributed microblog
 *
 * action handler for message inbox
 *
 * PHP version 5
 *
 * @category  Login
 * @package   Shaishai
 * @author    Guofu Xie <guofu85@gmail.com>
 * @author    Ben Cao <benb88@gmail.com>
 * @copyright 2009-2010 Shaier, Inc.
 * @link      http://www.shaishai.com/
 */

if (!defined('SHAISHAI')) {
    exit(1);
}

/**
 * action handler for message inbox
 *
 * @category Personal
 * @package  Shaishai
 * @author    Guofu Xie <guofu85@gmail.com>
 * @copyright 2009-2010 Shaier, Inc.
 * @link      http://www.shaishai.com/
 */

require_once INSTALLDIR . '/lib/mailbox.php';

class InboxAction extends MailboxAction
{
    function handle($args)
    {
        parent::handle($args);
        
    	$message = $this->getMessages();
        $total = $this->cur_user->inboxCount();
        $this->addPassVariable('message', $message);
        $this->addPassVariable('total', $total);
		$this->displayWith('InboxHTMLTemplate');
    }
    
    
    /**
     * Retrieve the messages for this user and this page
     *
     * Does a query for the right messages
     *
     * @return Message data object with stream for messages
     *
     * @see MailboxAction::getMessages()
     */

    function getMessages()
    {
    	Message::setRead($this->cur_user->id);
        $message = new Message();

        $message->to_user = $this->cur_user->id;
        $message->orderBy('created DESC, id DESC');
        $message->is_deleted_to = 0;
        $message->limit((($this->cur_page - 1) * MESSAGES_PER_PAGE),
            MESSAGES_PER_PAGE + 1);

        if ($message->find()) {
            return $message;
        } else {
            return null;
        }
    }
}