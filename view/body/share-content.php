<div class="box-network">
	<div class="button">
		<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode('http://www.capixi.com/'.$post->getUrl()); ?>&width=100&layout=button_count&action=like&show_faces=false&share=false&height=21&appId=574639209279867&locale=pt_BR" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
	</div>
	<div class="button">
		<div class="g-plusone" data-size="medium" data-href="http://www.capixi.com/<?php echo $post->getUrl(); ?>"></div>
	</div>
	<div class="button"> <?php //echo &text=  $post->getTitle(); ?>
		<iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?url=<?php echo urlencode('http://www.capixi.com/'.$post->getUrl()); ?>&via=osCapixi&lang=pt"></iframe>
	</div>
	<div class="cl"></div>
</div>
<div class="cl"></div>