<?php
	$html = '';
	$tam = count($arrayObj);
	
	
	if(preg_match('/^(vu-get-followings-dashboard|vu-get-followings-load-more|vu-get-followers-dashboard|vu-get-followers|vu-get-followers-load-more|vu-get-followers-page|vu-get-followers-page-load-more|vu-get-followings-page|vu-get-followings-page-load-more){1}$/', $_POST['method'])){
		
		for($i = 0; $i < $tam; $i++){
			// LOAD MORE
				if($tam == __LIMIT_FOLLOWS_PAGE__){
					$methodLoadMore = '';
					if(preg_match('/^(vu-get-followers-page|vu-get-followers-page-load-more){1}$/', $_POST['method'])){
						$methodLoadMore = 'vu-get-followers-page-load-more';
					}
					else if(preg_match('/^(vu-get-followers-dashboard|vu-get-followers|vu-get-followers-load-more){1}$/', $_POST['method'])){
						$methodLoadMore = 'vu-get-followers-load-more';
					}
					else if(preg_match('/^(vu-get-followings-dashboard|vu-get-followings|vu-get-followings-load-more){1}$/', $_POST['method'])){
						$methodLoadMore = 'vu-get-followings-load-more';
					}
					else{
						$methodLoadMore = 'vu-get-followings-page-load-more';
					}
					//$methodLoadMore = preg_match('/^(vu-get-followers-dashboard|vu-get-followers|vu-get-followers-page|vu-get-followers-page-load-more|vu-get-followers-load-more){1}$/', $_POST['method']) ? 'vu-get-followers-page-load-more' : 'vu-get-followings-page-load-more';
					$html_LoadMore = <<<HTML
						<a class="link-more br-3" title="Carregar mais" href="package/ctrl/CtrlUser.php|$methodLoadMore">
							Carregar mais
							<i class="fa fa-angle-down"></i>
						</a>
HTML;
					$tam--;
				}
				
			$id = $arrayObj[$i]->getId();
			$followUser = is_object($arrayObj[$i]->getUserFollower()) ? $arrayObj[$i]->getUserFollower() : $arrayObj[$i]->getUserFollowing();
			$imgUrl = $followUser->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/50-50/');
			$name = $followUser->getName();
			$url = __PATH_FOR_LONG_URL__.$followUser->getUrlSufix();
			$numberEventLabel = $followUser->getNumberEventLabel();
			$numberFollower = $followUser->getNumberFollowerLabel();
			$numberFollowing = $followUser->getNumberFollowingLabel();
			
			// BUTTON
				$html_Button = '';
				if(preg_match('/^(vu-get-followers-dashboard|vu-get-followers|vu-get-followers-load-more){1}$/', $_POST['method'])
					|| preg_match('/^(vu-get-followings-dashboard|vu-get-followings|vu-get-followings-load-more){1}$/', $_POST['method'])){
					
					$label = preg_match('/^(vu-get-followers-dashboard|vu-get-followers|vu-get-followers-load-more){1}$/', $_POST['method']) ? 'Deixar de seguir' : 'Remover de seguidores';
					$methodUrl = preg_match('/^(vu-get-followers-dashboard|vu-get-followers|vu-get-followers-load-more){1}$/', $_POST['method']) ? 'vu-user-follow' : 'vu-user-unfollow-me';
					$html_Button = __PATH_FOR_LONG_URL__.'package/ctrl/CtrlUser.php|'.$methodUrl.'|'.$followUser->getId();
					$html_Button = <<<HTML
						<div class="box-buttons">
							<a href="$html_Button" class="bt br-3 bt-unfollow" title="$label">
								<i class="fa fa-remove"></i>
								$label
							</a>
						</div>
HTML;
				}
			
			$html .= <<<HTML
				<div class="event" id="us-$id">
					<img src="$imgUrl" class="banner" width="50" height="50" />
					<div class="info">
						<a href="$url" class="name" title="$name">
							$name
						</a>
						<div class="cl normal-info">
							$numberEventLabel
						</div>
						<div class="cl normal-info">
							$numberFollower
							&nbsp;&nbsp;&nbsp;&nbsp;
							$numberFollowing
						</div>
					</div>
					$html_Button
					<div class="cl"></div>
				</div>
HTML;
		}
		$html .= $html_LoadMore;
		
		
		// EMPTY
			if(empty($html)){
				$title = preg_match('/^(vu-get-followers-dashboard|vu-get-followers){1}$/', $_POST['method']) ? 'Você não está seguindo nenhum usuário' : 'Não há seguidores';
				$html = <<<HTML
					<p class="no-content">
						<i class="fa fa-frown-o"></i>
						$title
					</p>
HTML;
			}
		
		
		// WRAP
			if(preg_match('/^(vu-get-followings-dashboard|vu-get-followings|vu-get-followers-dashboard|vu-get-followers){1}$/', $_POST['method'])){
				$html = <<<HTML
					<div class="box-events">
						$html
					</div>
HTML;
			}
	
		// DASHBOARD
			if(preg_match('/^(vu-get-followings-dashboard|vu-get-followers-dashboard){1}$/', $_POST['method'])){
				$urlMethod = preg_match('/^(vu-get-followers-dashboard){1}$/', $_POST['method']) ? 'vu-get-followers' : 'vu-get-followings';
				$title = preg_match('/^(vu-get-followers-dashboard){1}$/', $_POST['method']) ? 'Seguindo' : 'Seguido por';
				$html = <<<HTML
					<nav>
						<ul class="box-header-buttons">
							<li>
								<a href="package/ctrl/CtrlUser.php|$urlMethod" class="selected" title="$title">
									<i class="fa fa-chevron-down"></i>
									$title
								</a>
							</li>
							<li class="cl"></li>
						</ul>
						<div class="cl"></div>
					</nav>
					<div class="sub-content">
						$html
					</div>
HTML;
			}
			
		// ORGANIZER PAGE
			if(preg_match('/^(vu-get-followers-page|vu-get-followings-page){1}$/', $_POST['method'])){
				$title = preg_match('/^(vu-get-followers-page){1}$/', $_POST['method']) ? 'Seguindo' : 'Seguido por';
				$html = <<<HTML
					<h2>
						<i class="fa fa-check-circle"></i>
						$title
					</h2>
					<div class="vl"></div>
					<div class="box-followers">
						$html
					</div>
HTML;
			}
	}
	
	
	
	echo json_encode(array('html'=>$html));
?>