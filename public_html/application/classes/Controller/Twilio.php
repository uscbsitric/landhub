<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Twilio extends Controller_Template
{
	public $template = 'templates/twilio';


	public function action_craigslistland()
	{
	}

	
	public function action_parsetwilio()
	{
		$debugMessage = "";

		if(!isset($_REQUEST['RecordingUrl']))
		{
			$debugMessage .= "Must specify recording url --- the $ _ REQUEST['RecordingUrl']. " . "\r\n";
		}
		
		if(!isset($_REQUEST['TranscriptionStatus']))
		{
			$debugMessage .= "Must specify transcription status --- the $ _ REQUEST['TranscriptionStatus']" . "\r\n";
		}
		else
		{
			if(strtolower($_REQUEST['TranscriptionStatus']) != "completed")
			{
				$debugMessage .= " --- Error transcribing voicemail from ${_REQUEST['Caller']}\n\n";
				$debugMessage .= "New have a new voicemail from ${_REQUEST['Caller']}\n\n";
				$debugMessage .= "Click this link to listen to the message:\n";
				$debugMessage .= $_REQUEST['RecordingUrl'];
			}
			else
			{
				$debugMessage .= " --- New voicemail from ${_REQUEST['Caller']}\n\n";
				$debugMessage .= "New have a new voicemail from ${_REQUEST['Caller']}\n\n";
				$debugMessage .= "Text of the Twilio transcribed voicemail:\n";
				$debugMessage .= $_REQUEST['TranscriptionText']."\n\n";
				$debugMessage .= "Click this link to listen to the message:\n";
				$debugMessage .= $_REQUEST['RecordingUrl'];
			}
		}

		$twilioModel = ORM::factory('Twilio')->values(array('debug_message' => $debugMessage), array('debug_message'));
		$twilioModel->save();
		
		preg_match_all('/\s[0-9]{3,5}\s/', $debugMessage, $result);
		$verificationCode = trim($result[0][0], ' ');


			$craigslistVerCodePostingDebugging = ORM::factory('CraigslistVerCodePostingDebugging');
			$craigslistVerCodePostingDebuggingValues = array('verification_code_used' => $verificationCode,
															 'url_to_post'			  => 'http://something.somewhere.com',
															 'posting_results'		  => 'hi, this our debugging message: we are at application/classes/Controller/Twilio.php line 57 kai nag debugg ko'
															);
			$craigslistVerCodePostingDebugging->values($craigslistVerCodePostingDebuggingValues);
			$result = $craigslistVerCodePostingDebugging->save();
			var_dump($result);
			exit(' <--- Frederick Debugging here');


		$listingsModel = ORM::factory('Listing');

		$listingsModel->postToCraigslistPart2($verificationCode);

	}


}
