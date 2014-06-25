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

		/***** Proxies
		 * 173.208.36.19:3128
		173.234.250.107:3128
		173.208.36.179:3128
		173.208.36.143:3128
		173.234.250.239:3128
		173.234.250.52:3128
		173.208.36.223:3128
		173.234.250.82:3128 
		173.234.250.129:3128 <---
		173.208.36.154:3128
		*****/
		$proxy = '173.234.250.129:3128';
		$listingsModel = ORM::factory('Listing');
		$listingsModel->postToCraigslistPart2($verificationCode, $proxy);
	}


}
