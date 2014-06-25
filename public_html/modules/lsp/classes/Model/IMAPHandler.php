<?php defined('SYSPATH') or die('No direct script access.');

class Model_IMAPHandler extends Model
{
	private $hostname;
	private $username;
	private $password;
	private $mailboxType;
	private $inbox;

	public function configure($username, $password, $mailboxType)
	{
		$this->username = $username;
		$this->password = $password;
		$this->mailboxType = $mailboxType;
	}

	public function connectToIMAPMailbox()
	{
		switch($this->mailboxType)
		{
			case 'google':
				$this->hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
				break;
			case 'yahoo':
				$this->hostname = '{imap.mail.yahoo.com:993/imap/ssl}INBOX';
				break;
			case 'aol':
				$this->hostname = '{imap.aol.com:993/imap/ssl}INBOX';
				break;
			default:
				$this->hostname = '{example.com:143/notls}INBOX'; // Horde used by Plesk control panel
				break;
		}	
		
		// try to connect

		$this->inbox = imap_open($this->hostname, $this->username, $this->password) or exit('Cannot connect to Gmail: ' . imap_last_error()); // this is now a mailbox if this succeeds.

		return ($this->inbox) ? true : exit('Cannot connect to Gmail: ' . imap_last_error());
	}

	
	public function disconnectFromIMAPMailbox()
	{
		imap_close($this->inbox);
	}
	
	
	public function deleteAllEmails()
	{
		// grab emails
		if( $this->connectToIMAPMailbox() )
		{
			$emails = imap_search($this->inbox, 'ALL');
			
			if($emails)
			{
				foreach($emails as $emailNumber)
				{
					imap_delete($this->inbox, $emailNumber);
				}
					
				$result = imap_expunge($this->inbox);
			}
			
			$this->disconnectFromIMAPMailbox();
			return true;
		}
		
		return false;
	}
	
	
	public function readEmail()
	{
		$emails = imap_search($this->inbox, 'FROM "Landhub"');
	}


	public function getCraigslistPostingURL()
	{
		if($this->connectToIMAPMailbox())
		{
			// read email, always the first email, since all other emails are pre-deleted before attempting to post
			$this->connectToIMAPMailbox();

			$emails = imap_search($this->inbox, 'ALL');

			if($emails)
			{
				$output = "";
				rsort($emails);

				foreach($emails as $email_number)
				{
					$emailMessage  = imap_fetchbody($this->inbox,$email_number,2);
					preg_match_all('/[\/u\/][\w-]+/', $emailMessage, $result);
					$craigslistPostingURL = 'https://post.craigslist.org/u' . $result[0][8] . $result[0][9];

					break;
				}

				//$this->deleteAllEmails();
				
				return $craigslistPostingURL;
			}
		}

		return false;
	}
	
	
	
}