<?php defined('SYSPATH') or die('No direct script access.');

class Model_Listings_CraigsListsHandler extends Model
{
	private $cookieFilePath = "";
	private $cookie			= "";
	// LOGIN credentials
	private $inputEmailHandle = ""; // from $_POST, meaning, user input; just use this for now
	private $inputPassword	  = ""; 			  // from $_POST, meaning, user input; just use this for now
	// LOGIN credentials
	// SELECT LOCATION credentials
	private $areaabb		  = "";				      // from $_POST, meaning, user input; just use this for now
	// SELECT LOCATION credentials
	// CHOOSE TYPE credentials
	private $chooseTypeId	  = "";
	// CHOOSE TYPE credentials
	// CHOOSE CATEGORY credentials
	private $chooseCategoryId = "";
	// CHOOSE CATEGORY credentials

	// POSTIMAGE credentials
	private $aPostImages	  = "";					  // from $_POST, some flagging mechanism
	//$filePostImages   = '@' . __DIR__ . '/ranch.JPG'; //'@/var/www/testArea/CraigList/ranch.JPG'; // from $_POST, meaning, user input;
	// POSTIMAGE credentials
	// DONEWITHIMAGES credentials
	private $aDoneWithImages  = "";					  // from $_POST, some flagging mechanism
	private $goDoneWithImages = "";		  // from $_POST, some flagging mechanism
	// DONEWITHIMAGES credentials
	// PUBLISH credentials
	private $continuePublish  = "";					  // from $_POST, some flagging mechanism
	private $goPublish		  = "";				  // from $_POST, some flagging mechanism
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


	public function __construct($configuration)
	{
		$phpQueryPath = Kohana::find_file('vendor', 'phpQueryOnefile');
		require_once $phpQueryPath;
		
		// some configurations that are least likely to change
		$this->cookieFilePath   = $_SERVER['DOCUMENT_ROOT'] . '../cookies';//getcwd()."/cookie.txt";
		//$this->cookie 			= 'cl_session=PGgtR7DmT1yOv1tU5fWh8y950wjPmZUee1qTphA4Wut5QiNGvP5kDw3ivIUJyLkE; cl_b=3llV7fiw4xG3hVEpTen2WAAn/Ks'; //'cl_session=swlpIftY9s5tP96gAwVe5thcEZzP1aRsEunxGmfePCoFBEVuQiOXxbmMWWOteOJA; cl_b=3jlt2GKq4xGW70Ald6nfpQ5GkLg',
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
		
		foreach($stepsAndConfiguration as $step => &$configuration)
		{
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
	public function postToCraigsListPart1($property, $city, $userId, $debug)
	{		
		// delete all emails first
		$userModel = ORM::factory('User')->where('id', '=', $userId)->find();
		$this->imapHandler = ORM::factory('IMAPHandler');
		
		$this->imapHandler->configure($userModel->email_craigslist_username, $userModel->email_craigslist_password, 'google');

		$deleteResult = $this->imapHandler->deleteAllEmails();

		if($deleteResult)
		{
			// first part posting
			$stepsAndConfiguration = $this->variantAAssemblerPart1($property, $city);
			$this->post($debug, $stepsAndConfiguration);
			
			// second part posting
			$stepsAndConfiguration = $this->variantAAssemblerPart2($property, $city);
			$postingResults = $this->post($debug, $stepsAndConfiguration);

			$craigslistUrlData = array('url_to_post' 		=> 'https://post.craigslist.org/k/' . $postingResults['random22'] . '/' . $postingResults['random5'],
									   'crypted_step_check' => $postingResults['cryptedStepCheck']
									  );
			$craigslistUrlModel = ORM::factory('CraigslistUrl')->values($craigslistUrlData);
			$craigslistUrlModel->save();
		}

		$this->imapHandler->disconnectFromIMAPMailbox();
	}
	
	
	public function postToCraigsListPart2($verificationCode)
	{
		// anhi to ibutang ang matching sa tanan urls nga naka store sa craigslisturls table sa data_synd_platform
		$debug = true;

		$craigslistUrls = ORM::factory('CraigslistUrl')->find_all();

		$craigslistVerCodePostingDebugging = ORM::factory('CraigslistVerCodePostingDebugging');
		$craigslistVerCodePostingDebuggingValues = array();
		
		foreach($craigslistUrls as $craigslistUrl)
		{
			$stepsAndConfiguration = $this->postVerificationCodeAssembler($craigslistUrl->url_to_post, $verificationCode, $craigslistUrl->crypted_step_check);
			$postingResults = $this->post($debug, $stepsAndConfiguration);

			if($debug)
			{
				$craigslistVerCodePostingDebuggingValues = array('verification_code_used' => '',
						'url_to_post'			  => '',
						'posting_results'		  => ''
				);
				$craigslistVerCodePostingDebugging->values($craigslistVerCodePostingDebuggingValues);
				$craigslistVerCodePostingDebugging->saved();
			}
		}
	}


	public function configAssembler()
	{
		
	}


	public function variantAAssemblerPart1($property, $city)
	{
		$variantAConfiguration = array();
		$variantAConfiguration['login'] 		 		 = $this->loginStepAssembler();
		$variantAConfiguration['selectLocation'] 		 = $this->selectLocationAssembler($city->craigslist_areaabb);
		$variantAConfiguration['chooseType']	 		 = $this->chooseTypeAssembler();
		$variantAConfiguration['chooseCategory'] 		 = $this->chooseCategoryAssembler();
		$variantAConfiguration['postProperty']	 		 = $this->postPropertyAssembler($property, $city);
		$variantAConfiguration['postImage']		 		 = $this->postImageAssembler($property->photos);
		$variantAConfiguration['doneWithImages'] 		 = $this->doneWithImagesAssembler();
		$variantAConfiguration['publish']		 		 = $this->publishAssembler();
		
		return $variantAConfiguration;
	}


	public function variantAAssemblerPart2($property, $city)
	{
		$variantAConfiguration['emailVerify'] 			 		= $this->emailVerifyAssembler();
		$variantAConfiguration['createPostingAssembler'] 		= $this->createPostingAssembler();
		$variantAConfiguration['phoneVerify'] 			 		= $this->phoneVerifyAssembler();

		return $variantAConfiguration;
	}


	public function loginStepAssembler()
	{
		 $loginStepConfiguration = array('login' => array('configuration' => array('CURLOPT_URL' => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$this->inputEmailHandle.'&inputPassword='.$this->inputPassword.'&submit=Log%20In',
																				   'CURLOPT_RETURNTRANSFER' => 1,
																				   'CURLOPT_COOKIEJAR'  	=> $this->cookieFilePath,
																				   'CURLOPT_COOKIEFILE' 	=> $this->cookieFilePath,
																				   'CURLOPT_REFERER'    	=> 'http://www.craigslist.org',
																				   'CURLOPT_USERAGENT'  	=> $this->userAgent,
																				   'CURLOPT_FOLLOWLOCATION' => true,
																				   'formatURL'			    => false
																				  ),
									  					  'postVars'		 => array()
									 					 )
										);
		 return $loginStepConfiguration['login'];
	}


	public function selectLocationAssembler($areaabb)
	{
		$selectLocationConfiguration = array('selectLocation' => array('configuration' => array('CURLOPT_URL' 	   	     => 'https://post.craigslist.org/c/' . $areaabb,  //'https://accounts.craigslist.org/login/pstrdr?areaabb='.$areaabb.'',
																							    'CURLOPT_RETURNTRANSFER' => 1,
																							    'CURLOPT_COOKIEJAR'  	 => $this->cookieFilePath,
																							    'CURLOPT_COOKIEFILE' 	 => $this->cookieFilePath,
																							    'CURLOPT_REFERER'    	 => 'https://accounts.craigslist.org/login', //'http://accounts.craigslist.org',
																							    'CURLOPT_USERAGENT'  	 => $this->userAgent,
																							    'CURLOPT_POST'		     => false,
																							    'CURLOPT_FOLLOWLOCATION' => true,
																							    'formatURL'			     => false
										   													   ),
								   							 			'postVars'		 => array('areaabb' => $areaabb)
								   									  )
											);
		return $selectLocationConfiguration['selectLocation'];
	}


	public function chooseTypeAssembler()
	{
		$chooseTypeConfiguration = array('chooseType' => array('configuration' => array('CURLOPT_URL' 	   	   => 'https://post.craigslist.org/k/%s/%s',
																					    'CURLOPT_RETURNTRANSFER' => 1,
																					    'CURLOPT_COOKIEJAR'  	   => $this->cookieFilePath,
																					    'CURLOPT_COOKIEFILE' 	   => $this->cookieFilePath,
																					    'CURLOPT_REFERER'    	   => 'https://accounts.craigslist.org/k/%s/%s?s=type',
																					    'CURLOPT_USERAGENT'  	   => $this->userAgent,
																					    'CURLOPT_POST'		   => true,
																					    'CURLOPT_FOLLOWLOCATION' => true,
																					    'formatURL'			   => true,
																					    'formatReferer'		   => true
								   													   ),
								   							 	'postVars'	  => array('id' => $this->chooseTypeId)
								   							  )
										);
		return $chooseTypeConfiguration['chooseType'];
	}


	public function chooseCategoryAssembler()
	{
		$chooseCategory = array('chooseCategory' => array('configuration' => array('CURLOPT_URL' 	   	    => 'https://post.craigslist.org/k/%s/%s',
																				   'CURLOPT_RETURNTRANSFER' => 1,
																				   'CURLOPT_COOKIEJAR'  	=> $this->cookieFilePath,
																				   'CURLOPT_COOKIEFILE' 	=> $this->cookieFilePath,
																				   'CURLOPT_REFERER'    	=> 'https://accounts.craigslist.org/k/%s/%s?s=hcat',
																				   'CURLOPT_USERAGENT'  	=> $this->userAgent,
																				   'CURLOPT_POST'		    => true,
																				   'CURLOPT_FOLLOWLOCATION' => true,
																				   'formatURL'			    => true,
																				   'formatReferer'		    => true
								   												  ),
								   						   'postVars'		 => array('id' => $this->chooseCategoryId)
								   						  )
							  );
		return $chooseCategory['chooseCategory'];
	}


	public function postPropertyAssembler($property, $city)
	{
		//echo "<pre>";
		//var_dump($property->user->name . '---' . $property->user->id);
		//exit('programmma');
		$postProperty = array('postProperty' => array('configuration' => array('CURLOPT_URL' 	   	   => 'https://post.craigslist.org/k/%s/%s',
																			   'CURLOPT_RETURNTRANSFER'=> 1,
																			   'CURLOPT_COOKIEJAR'     => $this->cookieFilePath,
																			   'CURLOPT_COOKIEFILE'    => $this->cookieFilePath,
																			   'CURLOPT_REFERER'       => 'https://accounts.craigslist.org/k/%s/%s?s=edit',
																			   'CURLOPT_USERAGENT'     => $this->userAgent,
																			   'CURLOPT_POST'		   => true,
																			   'CURLOPT_FOLLOWLOCATION'=> true,
																			   'formatURL'			   => true,
																			   'formatReferer'		   => true
								   											  ),
								   					  'postVars'	  => array('FromEMail' 		 => $property->user->email_craigslist,
								   							 				   'ConfirmEMail'	 => $property->user->email_craigslist,
																			   'Privacy' 		 => 'C',
																			   'contact_phone_ok'=> 1,
																			   'contact_text_ok' => 1,
																			   'contact_phone'	 => $property->user->phone,
																			   'contact_name'	 => $property->user->name,
																			   'PostingTitle'	 => $property->price . ' / ' . $property->beds . ' - ' . $property->sqft . ' - ' . $property->title . ' (' . $city->name . ' )',
																			   'GeographicArea'	 => '',		//40 characters only
																			   'postal'			 => $property->zip_code,	//15 characters only
																			   'PostingBody'	 => $property->description,
																			   'Sqft'			 => $property->sqft,	//6 characters only
																			   'Ask'			 => $property->price,//11 characters only
																			   'Bedrooms'		 => $property->beds,	//1-8
																			   'bathrooms'		 => $property->baths,	//1-19
																			   'housing_type'	 => 12,
																			   'laundry'		 => 0,
																			   'parking'		 => 0,
																			   'wheelaccess'	 => 1,
																			   'no_smoking'		 => 1,
																			   'is_furnished'	 => 1,
																			   'outsideContactOK'=> 1,
								   											  )
								   					 )
							 );
		return $postProperty['postProperty'];
	}


	public function postImageAssembler($photo)
	{
		$postImage = array('postImage' => array('configuration'	=> array('CURLOPT_URL' => 'https://post.craigslist.org/k/%s/%s',
																		 'CURLOPT_RETURNTRANSFER' => 1,
																		 'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
																		 'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
																		 'CURLOPT_COOKIE' 		  => $this->cookie,
																		 'CURLOPT_REFERER'    	  => 'https://accounts.craigslist.org/k/%s/%s?s=editimage',
																		 'CURLOPT_USERAGENT'  	  => $this->userAgent,
																		 'CURLOPT_POST'		   	  => true,
																		 'CURLOPT_FOLLOWLOCATION' => true,
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


	public function doneWithImagesAssembler()
	{
		$doneWithImages = array('doneWithImages' => array('configuration' => array('CURLOPT_URL' 			=> 'https://post.craigslist.org/k/%s/%s',
																				   'CURLOPT_RETURNTRANSFER' => 1,
																				   'CURLOPT_COOKIEJAR'  	=> $this->cookieFilePath,
																				   'CURLOPT_COOKIEFILE' 	=> $this->cookieFilePath,
																				   'CURLOPT_REFERER'    	=> 'https://accounts.craigslist.org/k/%s/%s?s=editimage',
																				   'CURLOPT_USERAGENT'  	=> $this->userAgent,
																				   'CURLOPT_POST'		    => true,
																				   'CURLOPT_FOLLOWLOCATION' => true,
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


	public function publishAssembler()
	{
		$publish = array('publish'	=> array('configuration' => array('CURLOPT_URL' 		  => 'https://post.craigslist.org/k/%s/%s',
																	  'CURLOPT_RETURNTRANSFER'=> 1,
																	  'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
																	  'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
																	  'CURLOPT_REFERER'    	  => 'https://post.craigslist.org/k/%s/%s?s=preview',
																	  'CURLOPT_USERAGENT'  	  => $this->userAgent,
																	  'CURLOPT_POST'		  => true,
																	  'CURLOPT_FOLLOWLOCATION'=> true,
																	  'formatURL'			  => true,
																	  'formatReferer'		  => true
								   									 ),
								   			 'postVars'		 => array('continue' => $this->continuePublish,
								   									  'go'		 => $this->goPublish
								   									 )
								   		     )
						);
		return $publish['publish'];
	}


	public function emailVerifyAssembler()
	{
		$url = $this->imapHandler->getCraigslistPostingURL();
		
		$emailVerify = array('emailVerify'	=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => $url,
													   							 'CURLOPT_RETURNTRANSFER' => 1,
													   							 'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
													   							 'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
													   							 'CURLOPT_USERAGENT'  	  => $this->userAgent,
													   							 'CURLOPT_POST'		      => false,
													   							 'CURLOPT_FOLLOWLOCATION' => true,
													   							 'formatURL'			  => false,
													   							 'formatReferer'		  => false
													   							),
													 'postVars'			=> array()
													)
							);
		
		return $emailVerify['emailVerify'];
	}

	
	public function createPostingAssembler()
	{
		$createPosting = array('createPosting' => array('configuration' => array('CURLOPT_URL' 			  => 'https://post.craigslist.org/k/%s/%s',
													   							 'CURLOPT_RETURNTRANSFER' => 1,
													   							 'CURLOPT_COOKIEJAR'  	  => $this->cookieFilePath,
													   							 'CURLOPT_COOKIEFILE' 	  => $this->cookieFilePath,
													   							 'CURLOPT_USERAGENT'  	  => $this->userAgent,
													   							 'CURLOPT_POST'		      => true,
													   							 'CURLOPT_FOLLOWLOCATION' => true,
													   							 'formatURL'			  => true,
													   							 'formatReferer'		  => false
																			    ),
														'postVars'	   => array('continue' => 'y')
													   )
							  );
		
		return $createPosting['createPosting'];
	}
	

	public function phoneVerifyAssembler()
	{
		$phoneVerify = array('phoneVerify' => array('configuration' => array('CURLOPT_URL' 		  	 => 'https://post.craigslist.org/k/%s/%s',
																			 'CURLOPT_RETURNTRANSFER'=> 1,
																			 'CURLOPT_COOKIEJAR'  	 => $this->cookieFilePath,
																			 'CURLOPT_COOKIEFILE' 	 => $this->cookieFilePath,
																			 'CURLOPT_REFERER'    	 => 'https://post.craigslist.org/k/%s/%s?s=pn',
																			 'CURLOPT_USERAGENT'  	 => $this->userAgent,
																			 'CURLOPT_POST'		  	 => true,
																			 'CURLOPT_FOLLOWLOCATION'=> true,
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

	
	public function postVerificationCodeAssembler($urlToPost, $verificationCode, $cryptedStepCheck)
	{
		$postVerificationCodeAssembler = array('postVerificationCodeAssembler' => array('configuration' => array('CURLOPT_URL' 		  	 => $urlToPost,
																												 'CURLOPT_RETURNTRANSFER'=> 1,
																												 'CURLOPT_COOKIEJAR'  	 => $this->cookieFilePath,
																												 'CURLOPT_COOKIEFILE' 	 => $this->cookieFilePath,
																												 'CURLOPT_REFERER'    	 => 'https://post.craigslist.org/k/%s/%s?s=pc',
																												 'CURLOPT_USERAGENT'  	 => $this->userAgent,
																												 'CURLOPT_POST'		  	 => true,
																												 'CURLOPT_FOLLOWLOCATION'=> true,
																												 'formatURL'			 => true,
																												 'formatReferer'		 => true
																											   	),
																						'postVars'		=> array('cryptedStepCheck' => $cryptedStepCheck,
																												 'authstep'			=> $this->authstep,
																												 'userCode'			=> $verificationCode,
																												 'go'				=> $this->goSubmitVerCode
																												)
																					   )
											  );
		return $postVerificationCodeAssembler['postVerificationCodeAssembler'];
	}
	
	
}