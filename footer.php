		</div><!-- .content -->
	</section><!-- #body -->
	<footer>
		<section id="share" class="content">
			<div id="facebook">
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=257163947752145&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like" data-href="http://www.letterxdesign.com/apex/ageomatic" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
			</div>
			<div id="tell"> &#8592; Tell People &#8594; </div>
			<div id="twitter">
				<?php if($_GET) { ?>
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.letterxdesign.com/apex/ageomatic" data-text="#ageomatic tells me I'm <?php echo $bday->age($now, '3', $secsIn); ?> old." data-via="ageomatic">Tweet</a>
				<?php } else { ?>
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.letterxdesign.com/apex/ageomatic" data-text="Find out how old you are with the #ageomatic" data-via="ageomatic">Tweet</a>
				<?php } ?>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div>
		</section>
		<section id="contact">
			<a href="https://twitter.com/boy_eats_steak">Twitter</a> &bull; 
			<a href="https://github.com/sevx/ageomatic">GitHub</a>
		</section>
	</footer>
	</div><!-- #container -->
</body>
</html>