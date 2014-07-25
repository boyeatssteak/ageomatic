		</div><!-- .content -->
	</section><!-- #body -->
	<footer>
		<?php if($_GET) { ?>
			<section id="timezones">
				<div class="content">
					<h6>NOTE: I have not yet made the necessary updates to accommodate timezones in this revision, so for the time being, you'll need to make manual adjustments to the data submitted or retrieved to accommodate for your start and current location timezones. My server is in the Pacific timezone, where it is currently <?php echo $now->format('F j, Y h:i:sa') ?></h6>
				</div>
			</section>
		<?php } ?>
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
			<div id="tell">Want to Share?</div>
			<div id="twitter">
				<?php if($_GET) { ?>
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.letterxdesign.com/apex/ageomatic" data-text="#ageomatic tells me <?php echo $name; ?> is <?php echo $bday->age($now, '3', $secsIn); ?> old." data-via="ageomatic">Tweet</a>
				<?php } else { ?>
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.letterxdesign.com/apex/ageomatic" data-text="Find out how old you are with the #ageomatic" data-via="ageomatic">Tweet</a>
				<?php } ?>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div>
		</section>
		<section id="contact">
			<a href="https://twitter.com/ageomatic"><img src="img/twitter.png" /></a>&nbsp;
			<a href="https://github.com/sevx/ageomatic"><img src="img/github-mark.png" /></a>
		</section>
		<script>
			$('#body').css('padding-top', ($('header').outerHeight()) + 'px');
			$('#body').css('padding-bottom', ($('footer').outerHeight() + 20 + 'px'));
			$('footer #share').css('margin-right', 0 - ($('footer #contact').outerWidth()) + 'px');
		</script>
	</footer>
	</div><!-- #container -->
</body>
</html>