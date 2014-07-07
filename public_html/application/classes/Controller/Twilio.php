<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Twilio extends Controller_Template
{
	public $template = 'templates/twilio';

	public function extractVerificationCodeVersion1($transcription)
	{
		preg_match_all('/\s[0-9]{3,5}\s/', $transcription, $result);
		$verificationCode = trim($result[0][0], ' ');
		
		return $verificationCode;
	}
	
	public function extractVerificationCodeVersion2($transcription)
	{
		$explodedTranscription = explode(' ', $transcription);
		$verificationCode = array();

		foreach($explodedTranscription as $word)
		{
			switch($word)
			{
				case 'zero':
					$verificationCode[] = 0;
					break;
				case 'one':
					$verificationCode[] = 1;
					break;
				case 'two';
					$verificationCode[] = 2;
					break;
				case 'three':
					$verificationCode[] = 3;
					break;
				case 'four':
					$verificationCode[] = 4;
					break;
				case 'five':
					$verificationCode[] = 5;
					break;
				case 'six':
					$verificationCode[] = 6;
					break;
				case 'seven':
					$verificationCode[] = 7;
					break;
				case 'eight':
					$verificationCode[] = 8;
					break;
				case 'nine':
					$verificationCode[] = 9;
					break;
				default:
					continue;
					break;
			}
		}

		$verificationCode = array_slice($verificationCode, 0, count($verificationCode)/2 ); // first half would do
		$verificationCode = implode('', $verificationCode);
		
		return $verificationCode;
	}

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
		
		//preg_match_all('/\s[0-9]{3,5}\s/', $debugMessage, $result);
		//$verificationCode = trim($result[0][0], ' ');
		$verificationCode = $this->extractVerificationCodeVersion2($debugMessage);

		/***** Proxies
		 * 173.208.36.19:3128
		173.234.250.107:3128
		173.208.36.179:3128
		173.208.36.143:3128
		173.234.250.239:3128
		173.234.250.52:3128
		173.208.36.223:3128
		173.234.250.82:3128 
		173.234.250.129:3128
		173.208.36.154:3128  <---
		*****/
		$proxy = '173.208.36.154:3128';
		$listingsModel = ORM::factory('Listing');
		$listingsModel->postToCraigslistPart2($verificationCode, $proxy);
	}


}
