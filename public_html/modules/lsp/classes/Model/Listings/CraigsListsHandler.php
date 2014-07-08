<?php defined('SYSPATH') or die('No direct script access.');

class Model_Listings_CraigsListsHandler extends Model
{
	private $cookieFilePath = "";
	private $cookie			= "";
	// LOGIN credentials
	private $inputEmailHandle = ""; // from $_POST, meaning, user input; just use this for now
	private $inputPassword	  = ""; // from $_POST, meaning, user input; just use this for now
	// LOGIN credentials
	// SELECT LOCATION credentials
	private $areaabb		  = "";	// from $_POST, meaning, user input; just use this for now
	// SELECT LOCATION credentials
	// CHOOSE TYPE credentials
	private $chooseTypeId	  = "";
	// CHOOSE TYPE credentials
	// CHOOSE CATEGORY credentials
	private $chooseCategoryId = "";
	// CHOOSE CATEGORY credentials

	// POSTIMAGE credentials
	private $aPostImages	  = "";	// from $_POST, some flagging mechanism
	//$filePostImages   = '@' . __DIR__ . '/ranch.JPG'; //'@/var/www/testArea/CraigList/ranch.JPG'; // from $_POST, meaning, user input;
	// POSTIMAGE credentials
	// DONEWITHIMAGES credentials
	private $aDoneWithImages  = "";	// from $_POST, some flagging mechanism
	private $goDoneWithImages = "";	// from $_POST, some flagging mechanism
	// DONEWITHIMAGES credentials
	// PUBLISH credentials
	private $continuePublish  = "";	// from $_POST, some flagging mechanism
	private $goPublish		  = "";	// from $_POST, some flagging mechanism
	// PUBLISH credentials
	// SENDVERIFICATIONCODE credentials
	private $authstep = '';
	private $goSubmitVerCode = '';
	// SENDVERIFICATIONCODE credentials

	private $userAgent;

	private $n;
	private $n2;
	private $n3;
	private $callType;
	private $callLang;

	private $imapHandler;
	
	
	private function UniqueRandomNumbersWithinRange($min, $max, $quantity)
	{
		$numbers = range($min, $max);
		shuffle($numbers);
	
		return array_slice($numbers, 0, $quantity);
	}


	public function __construct($configuration)
	{
		$phpQueryPath = Kohana::find_file('vendor', 'phpQueryOnefile');
		require_once $phpQueryPath;
		$this->cookieFilePath   = $_SERVER['DOCUMENT_ROOT'] . '../cookies';
		$this->inputEmailHandle = 'frederick.sandalo@ripeconcepts.com';
		$this->inputPassword	= 'ripe1234';
		$this->chooseTypeId		= 'ho';
		$this->chooseCategoryId = '143';
		$this->aPostImages 		= 'add';
		$this->aDoneWithImages	= 'fin';
		$this->goDoneWithImages	= 'Done with Images';
		$this->continuePublish	= 'y';
		$this->goPublish		= 'Continue';
		$this->userAgent		= 'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)'; // wont likely change
		$this->n				= '774';
		$this->n2				= '854';
		$this->n3				= '7218';
		$this->callLang			= 'en';
		$this->callType			= 'voice';
		$this->authstep			= 'redeem';
		$this->goSubmitVerCode	= 'submit verification code';
	}


	public function cURLRequest(array $configuration, array $postVars)
	{
		//$url = 'https://post.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'];
		//$cookie_file_path = getcwd()."/cookie.txt";
		//$referer = 'https://accounts.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'] . '?' . 's=hcat';
		//$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
		$postVars = http_build_query($postVars);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $configuration['CURLOPT_URL']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);


		//curl_setopt($ch, CURLOPT_PROXY, $configuration['CURLOPT_PROXY']);

		if(isset($configuration['CURLOPT_POST']) && true == $configuration['CURLOPT_POST'])
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
		}

		if(isset($configuration['CURLOPT_COOKIEJAR']))
		{
			curl_setopt($ch, CURLOPT_COOKIEJAR, $configuration['CURLOPT_COOKIEJAR']);
		}

		if(isset($configuration['CURLOPT_COOKIEFILE']))
		{
			curl_setopt($ch, CURLOPT_COOKIEFILE, $configuration['CURLOPT_COOKIEFILE']);
		}

		if(isset($configuration['CURLOPT_COOKIE']))
		{
			curl_setopt($ch, CURLOPT_COOKIE, $configuration['CURLOPT_COOKIE']);
		}

		if(isset($configuration['CURLOPT_USERAGENT']))
		{
			curl_setopt($ch, CURLOPT_USERAGENT, $configuration['CURLOPT_USERAGENT']);
		}

		if(isset($configuration['CURLOPT_REFERER']))
		{
			curl_setopt($ch, CURLOPT_REFERER, $configuration['CURLOPT_REFERER']);
		}

		if(isset($configuration['CURLOPT_RETURNTRANSFER']))
		{
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, $configuration['CURLOPT_RETURNTRANSFER']);
		}

		if(isset($configuration['CURLOPT_FOLLOWLOCATION']))
		{
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $configuration['CURLOPT_FOLLOWLOCATION']);
		}

		if(isset($configuration['CURLOPT_PROTOCOLS']))
		{
			curl_setopt($ch, CURLOPT_PROTOCOLS, $configuration['CURLOPT_PROTOCOLS']);
		}

		if(isset($configuration['CURLOPT_SSL_VERIFYPEER']))
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $configuration['CURLOPT_SSL_VERIFYPEER']);
		}

		if(isset($configuration['CURLOPT_SSL_VERIFYHOST']))
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $configuration['CURLOPT_SSL_VERIFYHOST']);
		}

		if(isset($configuration['CURLOPT_UNRESTRICTED_AUTH']))
		{
			curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, $configuration['CURLOPT_UNRESTRICTED_AUTH']);
		}

		$output = curl_exec($ch);
		$info   = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		curl_close($ch);

		$subject = $info; //$info['url'];
		$exploded = explode('/', $subject);

		if(isset($exploded[4]))
		{
			$random22 = $exploded[4];
			$dummy = $exploded[5];
			$dummy = explode('?', $dummy);
			$random5 = $dummy[0];
		}

		// getting the cryptedStepCheck
		phpQuery::newDocument($output);
		$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();

		if(0 == strlen($cryptedStepCheck) && isset($postVars['cryptedStepCheck']))
		{
			$cryptedStepCheck = $postVars['cryptedStepCheck'];
		}

		return array('random22' => (isset($random22)) ? $random22 : NULL,
				'random5'  => (isset($random5)) ? $random5 : NULL,
				'cryptedStepCheck' => (isset($cryptedStepCheck)) ? $cryptedStepCheck : NULL,
				'markup'   => $output
		);
	}


	public function post($debug, $stepsAndConfiguration)
	{
		$stepCounter = 0;
		$keys = array_keys($stepsAndConfiguration);
		ini_set('max_execution_time', 470);

		foreach($stepsAndConfiguration as $step => &$configuration)
		{
			/*****
			switch($step)
			{
				case 'login': sleep(18);
					break;
				case 'selectLocation': sleep(17);
					break;
				case 'chooseType': sleep(7);
					break;
				case 'chooseCategory': sleep(4);
					break;
				case 'postProperty': sleep(94);
					break;
				case 'geoverify': sleep(6);
					break;
				case 'postImage': sleep(14);
					break;
				case 'doneWithImages': sleep(3);
					break;
				case 'publish': sleep(16);
					break;
				case 'emailVerify': sleep(52);
					break;
				case 'createPostingAssembler': sleep(48);
					break;
				case 'phoneVerify': sleep(183);
					break;
				default:
					break;
			}
			*****/
			
			if($configuration['configuration']['formatURL'])
			{
				$url = sprintf($configuration['configuration']['CURLOPT_URL'], $configuration['postVars']['random22'], $configuration['postVars']['random5']);
				$configuration['configuration']['CURLOPT_URL'] = $url;
			}

			if( isset($configuration['configuration']['formatReferer']) && true == $configuration['configuration']['formatReferer'] )
			{
				$referer = sprintf($configuration['configuration']['CURLOPT_REFERER'], $configuration['postVars']['random22'], $configuration['postVars']['random5']);
				$configuration['configuration']['CURLOPT_REFERER'] = $referer;
			}

			$curlRequestResult = $this->cURLRequest($configuration['configuration'], $configuration['postVars']);

			if($debug && $curlRequestResult)
			{
				echo "Newest Test Edition<br>";
				echo $step;
				echo "<br>";
				echo '<div id="loginResult" style="width: 800; height: 900; overflow: hidden;">
						'.$curlRequestResult['markup'].'
								</div>';
				echo '<div>'.$curlRequestResult['random22'].'</div>';
				echo '<div>'.$curlRequestResult['random5'].'</div>';
				echo '<div>'.$curlRequestResult['cryptedStepCheck'].'</div>';
			}

			$stepCounter++;

			if(isset($keys[$stepCounter]))
			{
				if($curlRequestResult['random22'] || $curlRequestResult['random5'] || $curlRequestResult['cryptedStepCheck'])
				{
					$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['random22'] 		= $curlRequestResult['random22'];
					$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['random5']  		= $curlRequestResult['random5'];
					$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['cryptedStepCheck'] = $curlRequestResult['cryptedStepCheck'];
				}
			}
		}

		$error = false;

		return array('error' 			=> $error,
				'random22' 		=> $curlRequestResult['random22'],
				'random5'			=> $curlRequestResult['random5'],
				'cryptedStepCheck' => $curlRequestResult['cryptedStepCheck']
		);
	}


	// review this function and variables that are not needed
	public function postToCraigsListPart1($property, $city, $userId, $proxy,$debug)
	{
		// delete all emails first
		$userModel = ORM::factory('User')->where('id', '=', $userId)->find();
		$this->imapHandler = ORM::factory('IMAPHandler');

		$this->imapHandler->configure($userModel->email_craigslist_username, $userModel->email_craigslist_password, 'google');

		$deleteResult = $this->imapHandler->deleteAllEmails();

		if($deleteResult)
		{
			// first part posting
			$stepsAndConfiguration = $this->variantAAssemblerPart1($property, $city, $proxy);
			$this->post($debug, $stepsAndConfiguration);
				
			// second part posting
			$stepsAndConfiguration = $this->variantAAssemblerPart2($property, $city, $proxy);
			$postingResults = $this->post($debug, $stepsAndConfiguration);

			$craigslistUrlData = array('url_to_post' => 'https://post.craigslist.org/k/' . $postingResults['random22'] . '/' . $postingResults['random5'],
									   'crypted_step_check' => $postingResults['cryptedStepCheck']
									  );
			$craigslistUrlModel = ORM::factory('CraigslistUrl')->values($craigslistUrlData);
			$craigslistUrlModel->save();
		}

		$this->imapHandler->disconnectFromIMAPMailbox();
	}


	public function postToCraigsListPart2($verificationCode, $proxy)
	{
		$debug = true;
		$craigslistUrls = ORM::factory('CraigslistUrl')->find_all();
		$craigslistVerCodePostingDebugging = ORM::factory('CraigslistVerCodePostingDebugging');
		$craigslistVerCodePostingDebuggingValues = array();

		foreach($craigslistUrls as $craigslistUrl)
		{
			$stepsAndConfiguration = $this->postVerificationCodeAssembler($craigslistUrl->url_to_post, $verificationCode, $craigslistUrl->crypted_step_check, $proxy);
			$postingResults = $this->post($debug, $stepsAndConfiguration);

			if($debug)
			{
				////////////////////////////////////////////
				$craigslistVerCodePostingDebuggingValues = array('verification_code_used' => $verificationCode,
						'url_to_post'			  => $craigslistUrl->url_to_post,
						'posting_results'		  => $postingResults //'hi, this our debugging message: we are at modules/lsp/classes/Model/Listings/CraigsListsHandler.php line 302'//
				);
				$craigslistVerCodePostingDebugging->values($craigslistVerCodePostingDebuggingValues);
				$craigslistVerCodePostingDebugging->save();
				////////////////////////////////////////////
			}
		}
	}


	public function configAssembler()
	{

	}


	public function variantAAssemblerPart1($property, $city, $proxy)
	{
		$variantAConfiguration = array();
		$variantAConfiguration['login'] 		 = $this->loginStepAssembler($proxy);
		$variantAConfiguration['selectLocation'] = $this->selectLocationAssembler($city->craigslist_areaabb, $proxy);
		$variantAConfiguration['chooseType']	 = $this->chooseTypeAssembler($proxy);
		$variantAConfiguration['chooseCategory'] = $this->chooseCategoryAssembler($proxy);
		$variantAConfiguration['postProperty']	 = $this->postPropertyAssembler($property, $city, $proxy);
		$variantAConfiguration['geoverify']	 	 = $this->geoverifyAssembler($property, $city, $proxy);
		//$variantAConfiguration['postImage']		 = $this->postImageAssembler($property->photos, $proxy);
		$variantAConfiguration['doneWithImages'] = $this->doneWithImagesAssembler($proxy);
		$variantAConfiguration['publish']		 = $this->publishAssembler($proxy);

		return $variantAConfiguration;
	}


	public function variantAAssemblerPart2($property, $city, $proxy)
	{
		$variantAConfiguration['emailVerify'] 			 = $this->emailVerifyAssembler($proxy);
		$variantAConfiguration['createPostingAssembler'] = $this->createPostingAssembler($proxy);
		$variantAConfiguration['phoneVerify'] 			 = $this->phoneVerifyAssembler($proxy);

		return $variantAConfiguration;
	}


	public function loginStepAssembler($proxy)
	{
		$loginStepConfiguration = array('login' => array('configuration' => array('CURLOPT_URL' => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$this->inputEmailHandle.'&inputPassword='.$this->inputPassword.'&submit=Log%20In',
																				  'CURLOPT_RETURNTRANSFER' => 1,
																				  'CURLOPT_COOKIEJAR'  	=> $this->cookieFilePath,
																				  'CURLOPT_COOKIEFILE' 	=> $this->cookieFilePath,
																				  'CURLOPT_REFERER'    	=> 'http://www.craigslist.org',
																				  'CURLOPT_USERAGENT'  	=> $this->userAgent,
																				  'CURLOPT_FOLLOWLOCATION' => true,
																				  'CURLOPT_SSL_VERIFYHOST' => false,
																				  'CURLOPT_SSL_VERIFYPEER' => false,
																				  'CURLOPT_PROXY'			=> $proxy,
																				  'formatURL'			    => false
																				 ),
														 'postVars'		 => array()
														)
									   );

		return $loginStepConfiguration['login'];
	}


	public function selectLocationAssembler($areaabb, $proxy)
	{
		$selectLocationConfiguration = array('selectLocation' => array('configuration' => array('CURLOPT_URL' 	   	     => 'https://post.craigslist.org/c/' . $areaabb,  //'https://accounts.craigslist.org/login/pstrdr?areaabb='.$areaabb.'',
																								'CURLOPT_RETURNTRANSFER' => 1,
																								'CURLOPT_COOKIEJAR'  	 => $this->cookieFilePath,
																								'CURLOPT_COOKIEFILE' 	 => $this->cookieFilePath,
																								'CURLOPT_REFERER'    	 => 'https://accounts.craigslist.org/login', //'http://accounts.craigslist.org',
																								'CURLOPT_USERAGENT'  	 => $this->userAgent,
																								'CURLOPT_POST'		     => false,
																								'CURLOPT_FOLLOWLOCATION' => true,
																								'CURLOPT_SSL_VERIFYHOST' => false,
																								'CURLOPT_SSL_VERIFYPEER' => false,
																								'CURLOPT_PROXY'			 => $proxy,
																								'formatURL'			     => false
																								),
																		'postVars'	   => array('areaabb' => $areaabb)
																	  )
											);

		return $selectLocationConfiguration['selectLocation'];
	}


	public function chooseTypeAssembler($proxy)
	{
		$chooseTypeConfiguration = array('chooseType' => array('configuration' => array('CURLOPT_URL' 	   	     => 'https://post.craigslist.org/k/%s/%s',
																						'CURLOPT_RETURNTRANSFER' => 1,
																						'CURLOPT_COOKIEJAR'  	 => $this->cookieFilePath,
																						'CURLOPT_COOKIEFILE' 	 => $this->cookieFilePath,
																						'CURLOPT_REFERER'    	 => 'https://accounts.craigslist.org/k/%s/%s?s=type',
																						'CURLOPT_USERAGENT'  	 => $this->userAgent,
																						'CURLOPT_POST'		     => true,
																						'CURLOPT_FOLLOWLOCATION' => true,
																						'CURLOPT_SSL_VERIFYHOST' => false,
																						'CURLOPT_SSL_VERIFYPEER' => false,
																						'CURLOPT_PROXY'			 => $proxy,
																						'formatURL'			     => true,
																						'formatReferer'		     => true
																					   ),
															    'postVars'	   => array('id' => $this->chooseTypeId)
															  )
										);

		return $chooseTypeConfiguration['chooseType'];
	}


	public function chooseCategoryAssembler($proxy)
	{
		$chooseCategory = array('chooseCategory' => array('configuration' => array('CURLOPT_URL' 	   	    => 'https://post.craigslist.org/k/%s/%s',
																				   'CURLOPT_RETURNTRANSFER' => 1,
																				   'CURLOPT_COOKIEJAR'  	=> $this->cookieFilePath,
																				   'CURLOPT_COOKIEFILE' 	=> $this->cookieFilePath,
																				   'CURLOPT_REFERER'    	=> 'https://accounts.craigslist.org/k/%s/%s?s=hcat',
																				   'CURLOPT_USERAGENT'  	=> $this->userAgent,
																				   'CURLOPT_POST'		    => true,
																				   'CURLOPT_FOLLOWLOCATION' => true,
																				   'CURLOPT_SSL_VERIFYHOST' => false,
																				   'CURLOPT_SSL_VERIFYPEER' => false,
																				   'CURLOPT_PROXY'			=> $proxy,
																				   'formatURL'			    => true,
																				   'formatReferer'		    => true
																				  ),
														  'postVars'	 => array('id' => $this->chooseCategoryId)
														)
							   );

		return $chooseCategory['chooseCategory'];
	}


	public function postPropertyAssembler($property, $city, $proxy)
	{
		//echo "<pre>";
		//var_dump($property->user->name . '---' . $property->user->id);
		//exit('programmma');
		$postProperty = array('postProperty' => array('configuration' => array('CURLOPT_URL' 	   	    => 'https://post.craigslist.org/k/%s/%s',
																			   'CURLOPT_RETURNTRANSFER' => 1,
																			   'CURLOPT_COOKIEJAR'      => $this->cookieFilePath,
																			   'CURLOPT_COOKIEFILE'     => $this->cookieFilePath,
																			   'CURLOPT_REFERER'        => 'https://accounts.craigslist.org/k/%s/%s?s=edit',
																			   'CURLOPT_USERAGENT'      => $this->userAgent,
																			   'CURLOPT_POST'		    => true,
																			   'CURLOPT_FOLLOWLOCATION' => true,
																			   'CURLOPT_SSL_VERIFYHOST' => false,
																			   'CURLOPT_SSL_VERIFYPEER' => false,
																			   'CURLOPT_PROXY'			=> $proxy,
																			   'formatURL'			    => true,
																			   'formatReferer'		    => true
																			  ),
													  'postVars'	 => array('FromEMail' 		 => $property->user->email_craigslist,
																		   	  'ConfirmEMail'	 => $property->user->email_craigslist,
																		   	  'Privacy' 		 => 'C',
																			  'contact_phone_ok' => 1,
																			  'contact_text_ok'  => 1,
																			  'contact_phone'	 => $property->user->phone,
																			  'contact_name'	 => $property->user->name,
																			  'PostingTitle'	 => $property->price . ' / ' . $property->beds . ' - ' . $property->sqft . ' - ' . $property->title . ' (' . $city->name . ' )',
																			  'GeographicArea'	 => $property->county,		//40 characters only
																			  'postal'			 => $property->zip_code,	//15 characters only
																			  'PostingBody'	 	 => $property->description,
																			  'Sqft'			 => $property->sqft,	//6 characters only
																			  'Ask'			 	 => $property->price,//11 characters only
																			  'moveinMonth'		 => $this->UniqueRandomNumbersWithinRange(1, 12, 1), // hardcoded for now
																			  'moveinDay'		 => $this->UniqueRandomNumbersWithinRange(1, 30, 1), // hardcoded for now
																			  'Bedrooms'		 => $property->beds,	//1-8
																			  'bathrooms'		 => $property->baths,	//1-19
																			  'housing_type'	 => 12,
																			  'sale_date_1'		 => '',
																			  'sale_date_2'		 => '',
																			  'sale_date_3'		 => '',
																			  'laundry'		 	 => 0,
																			  'parking'		 	 => 0,
																			  'wheelaccess'	 	 => 1,
																			  'no_smoking'		 => 1,
																			  'is_furnished'	 => 1,
																			  'wantamap'		 => 0,
																			  'contact_ok' 		 => 1,
																			)
													)
							 );
		return $postProperty['postProperty'];
	}

	public function geoverifyAssembler($property, $city, $proxy)
	{
		$geoVerify = array('geoVerify' => array('configuration' => array('CURLOPT_URL' 			  => 'https://post.craigslist.org/k/%s/%s',
																		 'CURLOPT_RETURNTRANSFER' => 1,
																		 'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
																		 'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
																		 'CURLOPT_COOKIE' 		  => $this->cookie,
																		 'CURLOPT_REFERER'    	  => 'https://accounts.craigslist.org/k/%s/%s?s=geoverify',
																		 'CURLOPT_USERAGENT'  	  => $this->userAgent,
																		 'CURLOPT_POST'		   	  => true,
																		 'CURLOPT_FOLLOWLOCATION' => true,
																		 'CURLOPT_SSL_VERIFYHOST' => false,
																		 'CURLOPT_SSL_VERIFYPEER' => false,
																		 'CURLOPT_PROXY'		  => $proxy,
																		 'formatURL'			  => true,
																		 'formatReferer'		  => true
																		),
												'postVars'		=> array('xstreet0' => '',
																		 'xstreet1' => '',
																		 'city' => $city,
																		 'region' => '',
																		 'postal' => $property->zip_code,
																		 'lat' => '',
																		 'lng' => '',
																		 'AreaID' => 51, // not sure if this value is for anchorage alaska only
																		 'seenmap' => 1, // not sure if this value is for anchorage alaska only 
																		 'draggedpin' => 0, // not sure if this value is for anchorage alaska only
																		 'clickedinclude' => 0, // not sure if this value is for anchorage alaska only
																		 'geocoder_latitude' => '',
																		 'geocoder_longitude' => '',
																		 'geocoder_accuracy'  => '',
																		 'geocoder_version'   => '',
																		)
											   )
						  );
		
		return $geoVerify['geoVerify'];
	}
	
	public function postImageAssembler($photo, $proxy)
	{
		$postImage = array('postImage' => array('configuration'	=> array('CURLOPT_URL' 			  => 'https://post.craigslist.org/k/%s/%s',
																		 'CURLOPT_RETURNTRANSFER' => 1,
																		 'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
																		 'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
																		 'CURLOPT_COOKIE' 		  => $this->cookie,
																		 'CURLOPT_REFERER'    	  => 'https://accounts.craigslist.org/k/%s/%s?s=editimage',
																		 'CURLOPT_USERAGENT'  	  => $this->userAgent,
																		 'CURLOPT_POST'		   	  => true,
																		 'CURLOPT_FOLLOWLOCATION' => true,
																		 'CURLOPT_SSL_VERIFYHOST' => false,
																		 'CURLOPT_SSL_VERIFYPEER' => false,
																		 'CURLOPT_PROXY'		  => $proxy,
																		 'formatURL'			  => true,
																		 'formatReferer'		  => true
																		),
												 'postVars'		=> array('a' 	=> $this->aPostImages,
																		 'file' => $photo->url,
																		 'go'	=> 'add image',
																		 'id2'  => '500x500X500x500X500x500',
																		)
												)
						 );

		return $postImage['postImage'];
	}


	public function doneWithImagesAssembler($proxy)
	{
		$doneWithImages = array('doneWithImages' => array('configuration' => array('CURLOPT_URL' 			=> 'https://post.craigslist.org/k/%s/%s',
																				   'CURLOPT_RETURNTRANSFER' => 1,
																				   'CURLOPT_COOKIEJAR'  	=> $this->cookieFilePath,
																				   'CURLOPT_COOKIEFILE' 	=> $this->cookieFilePath,
																				   'CURLOPT_REFERER'    	=> 'https://accounts.craigslist.org/k/%s/%s?s=editimage',
																				   'CURLOPT_USERAGENT'  	=> $this->userAgent,
																				   'CURLOPT_POST'		    => true,
																				   'CURLOPT_FOLLOWLOCATION' => true,
																				   'CURLOPT_SSL_VERIFYHOST' => false,
																				   'CURLOPT_SSL_VERIFYPEER' => false,
																				   'CURLOPT_PROXY'			=> $proxy,
																				   'formatURL'			    => true,
																				   'formatReferer'		    => true
																				 ),
														 'postVars'	  => array('a'  => $this->aDoneWithImages,
																			   'go' => $this->goDoneWithImages
																			  )
														)
							   );

		return $doneWithImages['doneWithImages'];
	}


	public function publishAssembler($proxy)
	{
		$publish = array('publish'	=> array('configuration' => array('CURLOPT_URL' 		  => 'https://post.craigslist.org/k/%s/%s',
																	'CURLOPT_RETURNTRANSFER'  => 1,
																	'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
																	'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
																	'CURLOPT_REFERER'    	  => 'https://post.craigslist.org/k/%s/%s?s=preview',
																	'CURLOPT_USERAGENT'  	  => $this->userAgent,
																	'CURLOPT_POST'		  	  => true,
																	'CURLOPT_FOLLOWLOCATION'  => true,
																	'CURLOPT_SSL_VERIFYHOST'  => false,
																	'CURLOPT_SSL_VERIFYPEER'  => false,
																	'CURLOPT_PROXY'		  	  => $proxy,
																	'formatURL'			  	  => true,
																	'formatReferer'		  	  => true
															),
											 'postVars'	    => array('continue' => $this->continuePublish,
																	 'go'		=> $this->goPublish,
																	)
										    )
		);

		return $publish['publish'];
	}


	public function emailVerifyAssembler($proxy)
	{
		$url = $this->imapHandler->getCraigslistPostingURL();

		$emailVerify = array('emailVerify'	=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => $url,
																				 'CURLOPT_RETURNTRANSFER' => 1,
																				 'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
																				 'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
																				 'CURLOPT_USERAGENT'  	  => $this->userAgent,
																				 'CURLOPT_POST'		      => false,
																				 'CURLOPT_FOLLOWLOCATION' => true,
																				 'CURLOPT_SSL_VERIFYHOST' => false,
																				 'CURLOPT_SSL_VERIFYPEER' => false,
																				 'CURLOPT_PROXY'		  => $proxy,
																				 'formatURL'			  => false,
																				 'formatReferer'		  => false
																				),
													 'postVars'			=> array()
													)
							);

		return $emailVerify['emailVerify'];
	}


	public function createPostingAssembler($proxy)
	{
		$createPosting = array('createPosting' => array('configuration' => array('CURLOPT_URL' 			  => 'https://post.craigslist.org/k/%s/%s',
																				 'CURLOPT_RETURNTRANSFER' => 1,
																				 'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
																				 'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
																				 'CURLOPT_USERAGENT'  	  => $this->userAgent,
																				 'CURLOPT_POST'		      => true,
																				 'CURLOPT_FOLLOWLOCATION' => true,
																				 'CURLOPT_SSL_VERIFYHOST' => false,
																				 'CURLOPT_SSL_VERIFYPEER' => false,
																				 'CURLOPT_PROXY'		  => $proxy,
																				 'formatURL'			  => true,
																				 'formatReferer'		  => false
																			    ),
														'postVars'	   => array('continue' => 'y')
														)
							 );

		return $createPosting['createPosting'];
	}


	public function phoneVerifyAssembler($proxy)
	{
		$phoneVerify = array('phoneVerify' => array('configuration' => array('CURLOPT_URL' 		  	 => 'https://post.craigslist.org/k/%s/%s',
																			 'CURLOPT_RETURNTRANSFER'=> 1,
																			 'CURLOPT_COOKIEJAR'  	 => $this->cookieFilePath,
																			 'CURLOPT_COOKIEFILE' 	 => $this->cookieFilePath,
																			 'CURLOPT_REFERER'    	 => 'https://post.craigslist.org/k/%s/%s?s=pn',
																			 'CURLOPT_USERAGENT'  	 => $this->userAgent,
																			 'CURLOPT_POST'		  	 => true,
																			 'CURLOPT_FOLLOWLOCATION'=> true,
																			 'CURLOPT_SSL_VERIFYHOST'=> false,
																			 'CURLOPT_SSL_VERIFYPEER'=> false,
																			 'CURLOPT_PROXY'		 => $proxy,
																			 'formatURL'			 => true,
																			 'formatReferer'		 => true
																			),
													'postVars'		=> array('n'  		=> $this->n,
																			 'n2' 		=> $this->n2,
																			 'n3' 		=> $this->n3,
																			 'callType' => $this->callType,
																			 'callLang' => $this->callLang,
																			 'go'		=> 'send the code!'
																			)
												   )
							);

		return $phoneVerify['phoneVerify'];
	}


	public function postVerificationCodeAssembler($urlToPost, $verificationCode, $cryptedStepCheck, $proxy)
	{
		$exploded = explode('/', $urlToPost);

		if(isset($exploded[4]))
		{
			$random22 = $exploded[4];
			$dummy = $exploded[5];
			$dummy = explode('?', $dummy);
			$random5 = $dummy[0];
		}

		$postVerificationCodeAssembler = array('postVerificationCodeAssembler' => array('configuration' => array('CURLOPT_URL' 		  	  => $urlToPost,
																												 'CURLOPT_RETURNTRANSFER' => 1,
																												 'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
																												 'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
																												 'CURLOPT_REFERER'    	  => 'https://post.craigslist.org/k/%s/%s?s=pc',
																												 'CURLOPT_USERAGENT'  	  => $this->userAgent,
																												 'CURLOPT_POST'		  	  => true,
																												 'CURLOPT_FOLLOWLOCATION' => true,
																												 'CURLOPT_SSL_VERIFYHOST' => false,
																												 'CURLOPT_SSL_VERIFYPEER' => false,
																												 'CURLOPT_PROXY'		  => $proxy,
																												 'formatURL'			  => false,
																												 'formatReferer'		  => true
																												),
																						 'postVars'		=> array('random22'			=> $random22,
																												 'random5'			=> $random5,
																												 'cryptedStepCheck' => $cryptedStepCheck,
																												 'authstep'			=> $this->authstep,
																												 'userCode'			=> $verificationCode,
																												 'go'				=> $this->goSubmitVerCode
																												)
																					   )
											 );

		return $postVerificationCodeAssembler['postVerificationCodeAssembler'];
	}


}
