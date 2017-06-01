<?php
	$email = $follow->getUserFollower()->getEmail();
	
	$userFollowerName = $name = $follow->getUserFollower()->getName();
	
	$userFollowingName = $follow->getUserFollowing()->getName();
	$userFollowingImg = $follow->getUserFollowing()->getImageUrl(__PATH_FULL_PREFIX__.'img/user/50-50/');
	$userFollowingUrl = __PATH_FULL_PREFIX__.$follow->getUserFollowing()->getUrlSufix();
	
	$subject = $userFollowingName.' está seguindo você no vuup';
	$body = <<<HTML
		<html>
			<body>
				<div style="font-family: Arial, sans-serif; font-size: 13px; line-height: 22px; color: #000000; width: 550px;">
					<div style="padding: 10px; color: #ffffff;">
						<a href="http://www.vuup.com.br" title="vuup">
							<img src="http://www.vuup.com.br/img/system/logo/vuup-140x40.png" alt="vuup logo" width="140" height="40" />
						</a>
					</div>
					
					<div style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; padding-left: 20px;">
						Olá $userFollowerName
						<br /><br />
						<div>
							<a href="$userFollowingUrl" title="$userFollowingName" style="border: 1px solid #eee; display: block; float: left; margin-right: 5px; border-radius: 3px;">
								<img src="$userFollowingImg" width="50" height="50" style="display: block;" />
							</a>
							<div style="float: left;">
								<a href="$userFollowingUrl" title="$userFollowingName">$userFollowingName</a>
								está seguindo você agora no <a href="http://www.vuup.com.br" title="vuup">vuup</a>
							</div>
							<div style="clear: both;"></div>
						</div>
					</div>
					--
					<br />
					<a href="http://www.vuup.com.br" title="Vuup Events">vuup.com.br</a>
					<br />
					Brasil
				</div>
			</body>
		</html>
HTML;
?>