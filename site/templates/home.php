<!DOCTYPE html>
<html lang="en">
	<?= snippet('HTMLhead') ?>
	<!--
		<a href="#my-dads-office-was-interesting" title="Click to copy the permalink to this position." onclick="navigator.clipboard.writeText(window.location + event.target.href).then(function(){window.alert('success')}, function(){window.alert('error')}); return false;">My dad’s office was interesting</a>
	-->
	<body>
		<?= snippet('header') ?>
		<main>
			<h1><?= $page->title() ?></h1>
			<section class="contain">
				<?php
				$numberOfpostsToShowonHome = 5;
				
				foreach(page('blog')->children()->listed()->flip() as $year) {
					foreach($year->children()->listed()->flip() as $month) {
						foreach($month->children()->listed()->flip() as $blogPost) {
							
							?>
							<article>
							<h2><a href="<?= $blogPost->url() ?>"><?= $blogPost->title() ?></a></h2>
							<?= $blogPost->teaser()->kt() ?>
							<p>
								<a href="<?= $blogPost->url() ?>"">Continue reading,</a> or <a href="<?= page('blog')->url() ?>">browse all posts.</a>
							</p>
							</article>
							<?php
							
							$numberOfpostsToShowonHome--;
							if($numberOfpostsToShowonHome < 1) {
								break;
							}
						}
						if($numberOfpostsToShowonHome < 1) {
							break;
						}
					}
					if($numberOfpostsToShowonHome < 1) {
						break;
					}
				}
				?>
			</section>
		</main>
		<?= snippet('footer') ?>
	</body>
</html>
