<?php

  //**************************************************************************************
  //**************************************************************************************
  // compose an invitation email
  static private function composeInvitation($email, $book, $fromName, $toName, $user) {
		// set the subject for the email message
		$email->Subject = 'Join '.$authorNamePlural.' VoiceThread discussion, '.$bookTitle;
		// create the body for this email
		// add the header information to this email
		$htmlData = self::getEmailHtmlProperty('header', $base_url, $user, 'VoiceThread Invitation');
		
		$htmlData .= '
						<tr>
							<td></td>
							<td></td>
							<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-blue-corner.gif"></td>
						</tr>

						<tr>
							<td colspan="2">
								<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
									<tr>
									<td class="mobile_spacer"></td>
									<td class="invitation section_header_cell">
										<span>
										<p class="section_header_title">'.$bookTitle.'</p>
										<p class="section_header_subtitle">'.$fromName.' wants you to join the discussion.</p>
										</span>
									</td>
									</tr>
								</table>
							</td>
							<td class="right_bg invitation"></td>

						</tr>
						
						<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
						<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
<tr>	
	<td colspan="2">
			<table id="invitation_table" cellspacing="0" cellpadding="0" border="0" align="left">
				<tr>
					<td valign="top"  class="invitation_image_cell"><a href="'.$bookLink.'"><img src="'.$previewImageUrl.'" alt="'. addslashes($bookTitle).'"  class="invitation_image" border="0" /></a></td>
					<td class="invitation_text_cell" valign="middle" align="center">
						<p  class="invitation_text">'. $description_excerpt .'</p>
						<a href="'.$bookLink.'" ><img id="invitation_join_image" src="'.CDN_URL.'/media/custom/notifications/join-button.gif"></a>
					</td>
				</tr>
			</table>
	</td>
	<td class="right_bg"></td>
</tr>

				<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td>
</tr>
				<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td>
</tr>


<tr>
	<td colspan="2">
		<table id="what_is_vt_table">
			<tbody>
				<tr>
					<td id="what_is_vt_image_cell" align="center" valign="middle">
						<img src="'.CDN_URL.'/media/custom/notifications/discussion.gif">
					</td>
					<td id="what_is_vt_cell">
							<p class="what_is_vt_title">If you\'ve never seen a VoiceThread, it\'s a...</p>
							<p>
								<span  class="what_is_vt_text">Media presentation that invites collaboration 
								from anyone, at anytime, anywhere in the world.</span> A VoiceThread allows you 
								and the people you invite to discuss media using voice and drawing annotations 
								while navigating through a collection of media. There\'s no scheduling required 
								because the conversation isn\'t live, it just feels that way.
							</p>
							<br />
							<p>
								To get started, we recommend you take a look at 
								<a href="'.$base_url.'/share/2008268/">commenting in a VoiceThread</a> or learn 
								<a href="'.$base_url.'/about/">more about VoiceThread</a>.
							</p>
					</td>
				</tr>
			</tbody>
		</table>
		
	</td>
	<td class="right_bg"></td>

</tr>	

	<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>

	';
		
  	$textData .= 
			"VoiceThread Invitation\r".
			"$fromName wants you to join the discussion.\r".
			"-------\r\r".
			 
			"Visit: ".$bookLink." to join the discussion.\r\r\r".
			 
			"If you've never seen a VoiceThread, it's a...\r\r".
			"Media presentation that invites collaboration from anyone, at anytime, anywhere in the ".
			"world. A VoiceThread allows you and the people you invite to discuss media using voice ".
			"and drawing annotations while navigating through a collection of media. There's no ".
			"scheduling required because the conversation isn't live, it just feels that way.\r\r".
			 
		  "To get started, we recommend you take a look at how to comment in a VoiceThread ".
			SITE_URL."/share/2008268/ or learn more about VoiceThread at ".$base_url."/about/";		

  }
  
  //**************************************************************************************
  //**************************************************************************************
  // compose a email informing the user of an upcoming renewal
  static private function composeRenewal($email, $targetUser, $properties) {
    // make sure that a subject is set
    if (! isset($properties['subject']))
    	$subject = 'VoiceThread Renewal';
    else
    	$subject = $properties['subject'];
		$htmlData .= 	'<tr>
		<td></td>
		<td></td>
		<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-black-corner.gif"></td>
	</tr>				
	<tr>
		<td colspan="2" align="left">
			<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
				<tr>
						<td class="mobile_spacer"></td>								
						<td class="receipt section_header_cell">
							<p class="section_header_title">VoiceThread Renewal - '.date('M d, Y', time()).'</p>
							<p class="section_header_subtitle">Renewal for '.$renewal_product.'</p>
						</td>
				</tr>
			</table>
		</td>
		<td class="right_bg receipt"></td>
	</tr>
	<tr class="spacer10">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="right_bg"></td>
	</tr>
	<tr>
		<td colspan="2">
			<table id="what_is_vt_table">
				<tbody>
					<tr>
						<td id="what_is_vt_image_cell" align="left" valign="middle"></td>
						<td id="what_is_vt_cell" align="left">'.
						$message_text.
						
					'</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td class="right_bg"></td>
	</tr>	
	<tr class="spacer10">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="right_bg"></td>
	</tr>
	
	<tr>
		<td colspan="2">
			<table id="what_is_vt_table">
				<tbody>
					<tr>
						<td id="what_is_vt_image_cell" align="center" valign="middle"></td>
						<td id="what_is_vt_cell">
							<p class="group_created_letter small">View the VoiceThread Terms of Sale and Sale Policies on our <a href="'.$base_url.'/termsofuse/">Terms of Use</a> page.</p>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td class="right_bg"></td>
	</tr>	
		
	<tr class="spacer10">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="right_bg"></td>
	</tr>	
	<tr class="spacer10">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="right_bg"></td>
	</tr>	
';

  }


  //**************************************************************************************
  //**************************************************************************************  
  // compose extended information about a product
  static private function composePurchaseInfo($email, $sourceUser, $targetUser, $properties) {
		$email->Subject = 'Welcome to VoiceThread';
		// create the body for this email
		// add the header information to this email
		$htmlData = self::getEmailHtmlProperty('header', $base_url, $user, 'Getting Started with VoiceThread');
		
		// determine the type of introduction the user should receive
		$introduction = 
			'<p class="group_created_letter">Below is a summary and any start-up information for your new license.</p>
				<p>&nbsp;</p>
				<p class="group_created_letter">
					Access the <a href="http://voicethread.com/support/howto/">Support Center</a> for 
					instant answers to the most common questions about VoiceThread, and please don\'t 
					hesitate to <a href="mailto:pro-support@voicethread.com">contact us</a> if you need
					any help getting started.
				</p>
				<p>&nbsp;</p>
				<p class="group_created_letter">
								Sincerely,<br />
								The VoiceThread Team
						</p>';
		// user gets a personalized message
		if ((isset($properties['personalized'])) && ($properties['personalized']))
			$introduction = 
				'<p class="group_created_letter"p>
					Thank you for your recent VoiceThread  purchase, and welcome to our 
					growing community.  I would like to introduce myself as your account manager.  
					I\'ll be offering direct support for you, as well as the members of your 
					organization, as you get started. 
				</p>
				<p class="group_created_letter">
					Below is a summary of the items that you purchased, and I have also attached 
					some printable start-up documents and guides for your convenience.
				</p>
				<p class="group_created_letter">
					For instant answers to the most common questions about VoiceThread, please 
					visit the <a href="http://voicethread.com/support">Support Center</a>. 
					Please don\'t hesitate to contact me for support at 
					this <a href="mailto:enhanced-support@voicethread.com">email address</a> 
					if you need anything at all.
				</p>
				<p class="group_created_letter">
					Sincerely,<br />
					Sadie Anderson
			</p>';		
		
		// get the introduction text for users who are gifted a product
		if ($sourceUser->getId() != $targetUser->getId()) 
			$introduction = 
				'<p class="group_created_letter">Dear '.$targetUser->getFirstName().',</p>
				
				<p class="group_created_letter">Congratulations! '.$sourceUser->getUsername().' has made a 
				purchase at VoiceThread and has given it to your account registered under '.
				$targetUser->getEmail().'. Below is a summary and any start-up information for your 
				new license or items.</p>
			
				<p class="group_created_letter">If you have never used this VoiceThread account,
				 you may <a href="http://voicethread.com/reset/">set your password on this page</a>.</p>
				 
				<p class="group_created_letter">Access the 
				<a href="http://voicethread.com/support/howto/Basics/">Support Center</a> for instant 
				answers to the most common questions about VoiceThread, and please don\'t hesitate to 
				<a href="mailto:pro-support@voicethread.com">contact us</a> if you need any help 
				getting started.</p>

				<p class="group_created_letter">Sincerely,<br />
				The VoiceThread Team</p>';
		
		$htmlData .= '
						<tr>
							<td></td>
							<td></td>
							<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-black-corner.gif"></td>
						</tr>
						<tr>
							<td colspan="2">
								<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
									<tr>
									<td class="mobile_spacer"></td>
									<td class="receipt section_header_cell">
										<span>
										<p class="section_header_title">Welcome to VoiceThread</p>
										<p class="section_header_subtitle">Getting Started Documentation</p>
										</span>
									</td>
									</tr>
								</table>
							</td>
							<td class="right_bg receipt"></td>

						</tr>
						

				<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>

				<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>


<tr>
	<td colspan="2">
		<table id="what_is_vt_table">
			<tbody>
				<tr>
					<td id="what_is_vt_image_cell" align="center" valign="middle">
					</td>
					<td id="what_is_vt_cell">
							<p class="group_created_letter group_created_subject">Hello '.$targetUser->getUsername().',</p>'.
						$introduction.
							'
							<p>&nbsp;</p>
							<p class="divider"></p>							
							<p>&nbsp;</p>
							<p class="group_created_letter"><strong>Your VoiceThread Products</strong></p>
						<div id="margin_box">	
						'.
					// include the mail description file
					$message.
						
					'</div>
					</td>
				</tr>
			</tbody>
		</table>
		
	</td>
	<td class="right_bg"></td>

</tr>	

	<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>

	';
		
  	$textData .= 
			"Welcome To VoiceThread\r".
			"Getting Started Document\r".
			"-------\r\r".
			
			"Hello ".$targetUser->getUsername().",\r\r\r".
			 
			"Below is a summary and any start-up information for your new license.\r\r".
			
			"Access the Support Center (http://voicethread.com/support/howto/) for ".
			"instant answers to the most common questions about VoiceThread, and please don't ".
			"hesitate to contact us (pro-support@voicethread.com) if you need any help getting started.\r\r".
			 
			"Thanks,\r".
			"The VoiceThread Team\r\r\r".
			
			 $text_message;

  }


  //**************************************************************************************
  //**************************************************************************************
 static private function composeRegistration($email, $referrer, $user) {
    $email->Subject = 'VoiceThread Account Activation';

		//Build the text version of the HTML
		$textData = 'Hello ' . $user->getFirstName() . ",\r\n";
		$textData .= "Thank you for registering an account with VoiceThread. Click the following link to activate your VoiceThread account:\r\n \r\n";
		$textData .= $base_url."/register/confirm/__VTSECURITYSTRING__/ \r\n \r\n";
		$textData .= 'If you did not register for an account, please delete this email. If we find evidence of abuse, we reserve the right to remove your account and content.';
		// construct the HTML email to send to the user
		$htmlData = RequestPeer::getEmailHtmlProperty('header', null, $user, 'VoiceThread');
    
		$htmlData .= '
						<tr>
							<td></td>
							<td></td>
							<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-blue-corner.gif"></td>
						</tr>

						<tr align="left">
							<td colspan="2">
								<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
									<tr>
									<td class="mobile_spacer"></td>
									<td class="invitation section_header_cell">
										<span>
										<p class="section_header_title">VoiceThread Account Activation</p>
										<p class="section_header_subtitle"></p>
										</span>
									</td>
									</tr>
								</table>
							</td>
							<td class="right_bg invitation">
						</tr>


		<tr align="left">
			<td colspan="2">
				<table cellspacing="0" border="0" >
					<tbody>
						<tr>
						<td class="mobile_spacer"></td>
						<td>
							<p>&nbsp;</p>
							<p class="group_created_letter group_created_subject">Hello '.$user->getFirstName().',</p>
							<p class="group_created_letter">Thank you for registering an account with VoiceThread. Click the following link to activate your VoiceThread account:</p>
							<p>&nbsp;</p>
							<p class="group_created_letter"><a href="'.$base_url.'/register/confirm/__VTSECURITYSTRING__/">'.$base_url.'/register/confirm/__VTSECURITYSTRING__/</a></p>
							<p>&nbsp;</p>
							<p class="group_created_letter">If you did not register for an account, please delete this email. If we find evidence of abuse, we reserve the right to remove your account and content.</p>

						</td>
						</tr>
					</tbody>
				</table>
						
						</td>
						<td class="right_bg"></td>
					</tr>

						
						<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
						<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>

		';
  }


  
  //**************************************************************************************
  //**************************************************************************************  
  static private function composePurchaseReceipt($email, $user, $props) {
   	$email->Subject = 'VoiceThread Invoice (Order '.$transaction->getOrderId().')';
		$htmlEmail .= 
	'<tr>
		<td></td>
		<td></td>
		<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-black-corner.gif"></td>
	</tr>				
	<tr>
		<td colspan="2" align="left">
			<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
				<tr>
						<td class="mobile_spacer"></td>								
						<td class="receipt section_header_cell">
							<p class="section_header_title">VoiceThread Invoice</p>
							<p class="section_header_subtitle">Order Number '.$transaction->getOrderId().'</p>
						</td>
				</tr>
			</table>
		</td>
		<td class="right_bg receipt"></td>
	</tr>
	<tr class="spacer10">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="right_bg"></td>
	</tr>
	<tr>
		<td colspan="2">
			<table id="what_is_vt_table">
				<tbody>
					<tr>
						<td id="what_is_vt_image_cell" align="left" valign="middle"></td>
						<td id="what_is_vt_cell" align="left">
							<p class="group_created_thanks group_created_subject">Hello '.$user->getUsername().',</p>
							<p>&nbsp;</p>
							<p class="group_created_letter">
								Thank you for your purchase!  Your invoice is attached.  
								You can also access your invoice any time on your 
								<a href="'.$base_url.'/account/purchases/">Purchases page</a>. 
							</p>
							<p class="group_created_thanks">
								Please <a href="mailto:billing@voicethread.com">contact us</a> with any questions.</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p class="group_created_thanks">Thank you,</p>
							<p class="group_created_thanks">The VoiceThread Team</p>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td class="right_bg"></td>
	</tr>	
	<tr class="spacer10">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="right_bg"></td>
	</tr>
	
	<tr>
		<td colspan="2">
			<table id="what_is_vt_table">
				<tbody>
					<tr>
						<td id="what_is_vt_image_cell" align="center" valign="middle"></td>
						<td id="what_is_vt_cell">
							<p class="group_created_letter small">View the VoiceThread Terms of Sale and Sale Policies on our <a href="'.$base_url.'/termsofuse/">Terms of Use</a> page.</p>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td class="right_bg"></td>
	</tr>	
		
	<tr class="spacer10">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="right_bg"></td>
	</tr>	
	<tr class="spacer10">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="right_bg"></td>
	</tr>	
	';
	

		// now create the text version of this email
		$textEmail =	
			"Hello ".$user->getUsername().",\r\r
			
			Thank you for your purchase! Your invoice is attached. You can also access your invoice ".
			"any time on your Purchases page [http://voicethread.com/account/purchases/].\r\r

			Please contact us [mailto:billing@voicethread.com] with any questions.
			
			Thank you,\r".
			"The VoiceThread Team\r\r\r".
			
			"View the VoiceThread Terms of Sale and Sale Policies on our Terms of Use page at:
			".$base_url."/termsofuse/";
  }

  //**************************************************************************************
  //**************************************************************************************
  static private function composeGroupCreated($email, $user, $org) {
  	$email->Subject = 'VoiceThread Group - '.htmlentities(stripslashes($org->getName()), ENT_QUOTES, "UTF-8");
		$htmlData .= '
		<tr align="left">
			<td></td>
			<td></td>
			<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-orange-corner.gif"></td>
		</tr>
		<tr align="left">
			<td colspan="2">
				<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
					<tr align="left">
							<td class="mobile_spacer"></td>								
							<td class="section_header_cell group_created">
								<p class="section_header_title">Group Created</p>
								<p class="section_header_subtitle">'.htmlentities(stripslashes($org->getName()), ENT_QUOTES, "UTF-8").'</p>
							</td>
					</tr>
				</table>
			</td>
			<td class="right_bg group_created"></td>
		</tr>

		<tr align="left" class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
		
		<tr align="left">
			<td colspan="2">
			<table cellspacing="0" border="0" align="left>
			<tbody>
			<tr align="left">
			<td class="mobile_spacer"></td>
			<td>
';
  	// message specific to non ed users
  	if (! $user->isEd()) {
			$htmlData .= 
					'<p class="group_created_letter group_created_subject">Hello '.$user->getUsername().',</p>
					
					<p class="group_created_letter">Your group, '.htmlentities(stripslashes($org->getName()), ENT_QUOTES, "UTF-8").', has been created
					and you now need to add some people to it. The simplest and easiest way is to 
					send this link to anyone you\'d like to join:<br />'.
					'<a href="'.SITE_URL.'/'.$org->getSignUpLink().'">'.SITE_URL.'/'.$org->getSignUpLink().'</a></p>';
				
				$textData = 'Hello '.$user->getUsername().',
					
					Your group, '.stripslashes($org->getName()).', has been created
					and you now need to add some people to it. The simplest and easiest way is to 
					send this link to anyone you\'d like to join:'.
					SITE_URL.'/'.$org->getSignUpLink();
  		}
  		// for user of the ed community
  		else {
 				$htmlData .= 
					'<p class="group_created_letter group_created_subject">Hello '.$user->getUsername().',</p>
					
					<p class="group_created_letter">You\'ve just created the Group called '.htmlentities(stripslashes($org->getName()), ENT_QUOTES, "UTF-8").'. 
					Now you\'ll need to add some people to your Group!</p>  
					
					<p class="group_created_letter">There are two options:</p>
					
					<p class="group_created_letter">* Add people who are already part of your Ed.VoiceThread school or class.  
					Watch how to do that here: <a href="'.SITE_URL.'/share/343705/">'.SITE_URL.'/share/343705/</a></p>

					<p class="group_created_letter">* Add people by having them click this link:<br />
					<a href="'.SITE_URL.'/'.$org->getSignUpLink().'">'.SITE_URL.'/'.$org->getSignUpLink().'</a></p>			';
  			
  			$textData = 'Hello '.$user->getUsername().',
					
					You\'ve just created the Group/Class called '.stripslashes($org->getName()).'. 
					Now you\'ll need to add some people to your Group!  There are two options:
					
					Option A:
					Add people who are already part of your Ed.VoiceThread school or class.  
					Watch how to do that here: '.SITE_URL.'/share/343705/
					
					Option B:
					Add people by having them click this link:<br />'
					.SITE_URL.'/'.$org->getSignUpLink(); 		
  		}
  	
  	$htmlData .= 
		'<p class="group_created_letter">You can put this link in an email, on a blog, in a wiki, or on a printed document,
				and anyone who clicks it will be able to join your Group without you having to add them 
				manually. This method of Group creation and growth is 100% organic and management-free.</p>
				
				<p class="group_created_letter">Groups are very powerful tools for sharing and organizing content because once they 
				are created, sharing is simple.</p>
				
				<p class="group_created_letter"><a href="'.SITE_URL.'/share/343705/"><img id="group-creation-pic" src="'.CDN_URL.'/media/custom/notifications/groups-howto.gif" border="0"/></a></p>
				
				<p class="group_created_letter">If you have any questions about using or managing Groups, please 
				<a href="'.SITE_URL.'/share/343705/">watch this short tutorial</a>.</p>
				
				<p class="group_created_letter">For more information about sharing, please read our 
				<a href="'.CDN_URL.'/media/misc/sharing_voicethreads.pdf">sharing guide</a>.</p>
				
				<p class="group_created_letter">Thanks,<br />
				<strong>The VoiceThread Team</strong></p>
				';
		
  	$textData .= 
			'You can put this link in an email, on a blog, in a wiki, or on a printed document,
				and anyone who clicks it will be able to join your Group without you having to add them 
				manually. This method of Group creation and growth is 100% organic and management-free.
				
				Groups are very powerful tools for sharing and organizing content because once they 
				are created, sharing is simple.
				
				If you have any questions about using or managing Groups, please 
				watch this short tutorial at: '.SITE_URL.'/share/343705/
				
				For more information about sharing, please read our sharing guide at:
				http://cdn.voicethread.com/media/misc/sharing_voicethreads.pdf
				
				Thanks,
				The VoiceThread Team';
		
		$htmlData .= '	</td></tr></tbody></table>
						
						</td>
						<td class="right_bg"></td>
					</tr>';
  }

  //**************************************************************************************
  //**************************************************************************************
  static private function composeManageAddUser($email, $sourceUser, $targetUser, $event) {
  	$email->Subject = 'VoiceThread Invitation - '.
  				htmlentities(stripslashes($org->getName()), ENT_QUOTES, "UTF-8");
		$htmlData .= '
		<tr>
			<td></td>
			<td></td>
			<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-blue-corner.gif"></td>
		</tr>
		<tr>
			<td colspan="2">
				<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
					<tr>
							<td class="mobile_spacer"></td>								
							<td class="section_header_cell invitation">
								<p class="section_header_title">VoiceThread Organization Invite</p>
								<p class="section_header_subtitle">'.htmlentities(stripslashes($org->getName()), ENT_QUOTES, "UTF-8").'</p>
							</td>
					</tr>
				</table>
			</td>
			<td class="right_bg invitation"></td>
		</tr>

		<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
		
		<tr>
			<td colspan="2">
			<table cellspacing="0" border="0" >
			<tbody>
			<tr>
			<td class="mobile_spacer"></td>
			<td>
			
		';
  	// compose the email information
		
		// the user declined the invitation to join the organization
		if ($event->getType() == EventPeer::MANAGE_USER_REQUEST_DECLINED) {
			$htmlData .= 
				'<p class="group_created_letter group_created_subject">Hello '.stripslashes($targetUser->getUsername()).',</p>
				
				<p class="group_created_letter">You invited '.stripslashes($sourceUser->getUsername()).' to your VoiceThread Organization, 
				<b>'.htmlentities(stripslashes($org->getName()), ENT_QUOTES, "UTF-8").'</b> but they have
				declined your invitation. </p>
				
				<p class="group_created_letter">If you think this happened in error, please resend your invitation from the 
				VoiceThread Manager.</p>

				<p class="]group_created_thanks">Thanks,</p>
				<p class="group_created_letter group_created_signed"><strong>The VoiceThread Team</strong></p>';	
				
			$textData = 'Hello '.stripslashes($targetUser->getUsername()).',		
			
				You invited '.stripslashes($sourceUser->getUsername()).' to your VoiceThread Organization,  
				'.stripslashes($org->getName()).' but they have declined your invitation.
				
				If you think this happened in error, please resend your invitation from the 
				VoiceThread Manager.
					
				Thanks,
				The VoiceThread Team';
			
		}
		// send the normal email invitation
		else {
			$htmlData .= 
				'<p class="group_created_letter group_created_subject">Hello '.stripslashes($targetUser->getUsername()).',</p>
				
				<p class="group_created_letter">'.stripslashes($sourceUser->getUsername()).' has just invited you to join the 
				VoiceThread Organization: <b>'.htmlentities(stripslashes($org->getName()), ENT_QUOTES, "UTF-8").'</b>.</p>
				
				<p class="group_created_letter">Please click this link to accept this invitation and become a member:
				
				<a href="'.SITE_URL.'/account/join/'.$targetUser->getId().'/'.$event->getId().'/__VTSECURITYSTRING__/">Invitation Link</a></p>
					
				<p class="group_created_letter">If you have any questions about this invitation, please contact '.
				htmlentities(stripslashes($sourceUser->getFirstName()), ENT_QUOTES, "UTF-8").' directly at '.
				'<a href="mailto:'.$sourceUser->getEmail().'">'.$sourceUser->getEmail().'</a>.</p>
				
				<p class="group_created_letter">If you have any questions about what it means to join to an Organization, please 
				<a class="wrap_link" href="'.SITE_URL.'/support/howto/Notifications/Notifications/Why_should_I_accept_an_invitation_to_a_VoiceThread_Organization/">click here.</a></p>
	
				<p class="group_created_letter">Thanks<br />
				<strong>The VoiceThread Team</strong></p>';	
			
			$textData = 'Hello '.stripslashes($targetUser->getUsername()).',
				
				'.stripslashes($sourceUser->getUsername()).' has just invited you to join the 
				VoiceThread Organization: '.stripslashes($org->getName()).'.
				Please follow this link to accept this invitation and become a member:
				
				'.SITE_URL.'/account/join/'.$targetUser->getId().'/'.$event->getId().'/__VTSECURITYSTRING__/
				
				If you have any questions about this invitation, please contact '.
				stripslashes($sourceUser->getFirstName()).' directly at '.$sourceUser->getEmail().'.
				
				If you have any questions about what it means to join to an Organization, 
				please follow this link:
				http://'.SITE_URL.'/support/howto/Notifications/Notifications/Why_should_I_accept_an_invitation_to_a_VoiceThread_Organization/
				
				Thanks,
				The VoiceThread Team';
		}
		// add a footer to the HTML document
		$htmlData .= '</td></tr></tbody></table>
						
						</td>
						<td class="right_bg"></td>
					</tr>		
				<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
				<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>

		';
  }

  //**************************************************************************************
  //**************************************************************************************
	// compose an email to the user informing them that their product was canceled
  static private function composeCancelProduct($email, $targetUser, $account) {
  	// compose the email
  	$email->Subject = 'VoiceThread Product Cancellation';
		// add the header information to this email
		$htmlData = self::getEmailHtmlProperty('header', $base_url, $targetUser);
		$htmlData .= '		<tr>
			<td></td>
			<td></td>
			<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-red-corner.gif"></td>
		</tr>
		<tr align="left">
			<td colspan="2">
				<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
					<tr>
							<td class="mobile_spacer"></td>								
							<td class="section_header_cell product_cancel">
								<p class="section_header_title">VoiceThread Product Cancellation</p>
								<p class="section_header_subtitle"></p>
							</td>
					</tr>
				</table>
			</td>
			<td class="right_bg product_cancel"></td>
		</tr>

		<tr align="left" class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>		
		
		<tr align="left">
			<td colspan="2">
			<table cellspacing="0" border="0" >
			<tbody>
			<tr align="left">
			<td class="mobile_spacer"></td>
			<td>
		
';
		// compose the email information
		$htmlData .= 
			'<p class="group_created_letter group_created_subject">Hello '.htmlentities(stripslashes($targetUser->getUsername()), ENT_QUOTES, "UTF-8").',</p>
			
			<p class="group_created_letter">Your '.$item_name.' has been cancelled. You will still have 
			full access to your license until your expiration date. <a 
			href="http://voicethread.com/account/purchases/">Restart automatic billing</a> at any time 
			before the expiration date, or reactivate within 90 days of expiration.</p>
			
			<p class="group_created_letter">Please <a href="mailto:billing@voicethread.com">contact us</a> with any questions.</p>
			
			<p>&nbsp;</p>
			<p class="group_created_thanks">Thank you,</p>
			<p class="group_created_letter group_created_subject">The VoiceThread Team</p>';	
			
		$textData = "Hello ".stripslashes($targetUser->getUsername()).",\r\r".
		
			"Your ".$item_name." has been cancelled. You will still have full access to your ".
			"license until your expiration date. Restart automatic billing ".
			"[ http://voicethread.com/account/purchases/] at any time before the expiration date, 
			or reactivate within 90 days of expiration.r\r".
			
			"Please contact us [mailto:billing@voicethread.com] with any questions.\r\r".
			
			"Thank you,
			The VoiceThread Team";
			
		$htmlData .= '</td></tr></tbody></table>
						
						</td>
						<td class="right_bg"></td>
					</tr>';
		
  }



  //**************************************************************************************
  //**************************************************************************************
  static private function composeReset($email, $referrer, $user) {
  	$email->Subject = 'Reset your VoiceThread password';
		//Build the text version of the HTML
		$textData = 'Hello ' . $user->getFirstName() . ",\r\n";
		$textData .= "We\'ve received a request to reset your password. Click the following link to create a new password:\r\n \r\n";
		$textData .= $base_url."/reset/confirm/__VTSECURITYSTRING__/ \r\n \r\n";
    $textData .= 'If you didn\'t request a password reset, please disregard this email.';
		// construct the HTML email to send to the user
		$htmlData = RequestPeer::getEmailHtmlProperty('header', null, $user, 'VoiceThread');
		$htmlData .= '
						<tr>
							<td></td>
							<td></td>
							<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-blue-corner.gif"></td>
						</tr>

						<tr align="left">
							<td colspan="2">
								<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
									<tr>
									<td class="mobile_spacer"></td>
									<td class="invitation section_header_cell">
										<span>
										<p class="section_header_title">Reset your VoiceThread password</p>
										<p class="section_header_subtitle"></p>
										</span>
									</td>
									</tr>
								</table>
							</td>
							<td class="right_bg invitation">
						</tr>


		<tr align="left">
			<td colspan="2">
				<table cellspacing="0" border="0" >
					<tbody>
						<tr>
						<td class="mobile_spacer"></td>
						<td>
							<p>&nbsp;</p>
							<p class="group_created_letter group_created_subject">Hello '.$user->getFirstName().',</p>
							<p class="group_created_letter">We\'ve received a request to reset your password. Click the following link to create a new password:</p>
							<p>&nbsp;</p>
							<p class="group_created_letter"><a href="'.$base_url.'/reset/confirm/__VTSECURITYSTRING__/">'.$base_url.'/reset/confirm/__VTSECURITYSTRING__/</a></p>
							<p>&nbsp;</p>
							<p class="group_created_letter">If you didn\'t request a password reset, please disregard this email.</p>

						</td>
						</tr>
					</tbody>
				</table>
						
						</td>
						<td class="right_bg"></td>
					</tr>

						
						<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
						<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>

		';

  }
  
  //**************************************************************************************
  //**************************************************************************************
  static private function composeExportComplete($email, $ticket, $user) {
	
	$email->Subject = 'Your VoiceThread movie is ready...';   
	//Add email body
	$htmlData .= '<tr>
							<td></td>
							<td></td>
							<td class="right_bg" align="left" valign="bottom"><img src="'.CDN_URL.'/media/custom/notifications/ribbon-corner-purple.gif"></td>
						</tr>

						<tr>
							<td colspan="2">
								<table cellspacing="0" cellpadding="0" border="0" class="section_header_table">
									<tr>
									<td class="mobile_spacer"></td>
									<td class="export_complete section_header_cell">
										<span>
										<p class="section_header_title">Download your VoiceThread Archival Movie</p>
										<p class="section_header_subtitle">"'.$title.'" is ready for downloading.</p>
										</span>
									</td>
									</tr>
								</table>
							</td>
							<td class="right_bg export_complete"></td>

						</tr>
						
						<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
						<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>
<tr>	
	<td colspan="2">
			<table id="invitation_table" cellspacing="0" cellpadding="0" border="0" align="left">
				<tr>
					<td valign="top"  class="invitation_image_cell"><a href="'.EXPORT_DOWNLOAD_LIST . $user->getId().'/">'.$image.'</a></td>
					<td class="invitation_text_cell" valign="middle" align="center">
						<p  class="invitation_text">We\'ve finished making a movie of "'.$title.'" and it\'s ready for you to download. Simply click the button below: </p>
						<a href="'.EXPORT_DOWNLOAD_LIST . $user->getId().'/" ><img alt="Download VoiceThread Movie" id="invitation_join_image" src="'.CDN_URL.'/media/custom/notifications/download-purple.gif"></a>
					</td>
				</tr>
			</table>
	</td>
	<td class="right_bg"></td>
</tr>


				<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td>
</tr>
				<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td>
</tr>


	<tr class="spacer10"><td>&nbsp;</td><td>&nbsp;</td><td class="right_bg"></td></tr>';

	//Create text only email
		$textData = "Download your VoiceThread Archival Movie\r\r".		
			"We've finished making a movie of '".$title."' and it's ready for you to download. Simply go to the link below:\r\r".
			EXPORT_DOWNLOAD_LIST . $user->getId().'/';
  }
