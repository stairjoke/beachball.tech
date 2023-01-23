<!DOCTYPE html>
<html lang="en">
	<?= snippet('HTMLhead') ?>
	<!--
		<a href="#my-dads-office-was-interesting" title="Click to copy the permalink to this position." onclick="navigator.clipboard.writeText(window.location + event.target.href).then(function(){window.alert('success')}, function(){window.alert('error')}); return false;">My dad’s office was interesting</a>
	-->
	<body class="blog">
		<?= snippet('header') ?>
		<main class="contain">
			<h1><?= $page->title() ?></h1>
				<dl>
					<?php foreach($page->children()->listed()->flip() as $post):
						if(!isset($pubdateFormatted)) {
							$pubdateFormatted = "Empty";
						}
						$pubdateFormattedLast = $pubdateFormatted;
						$pubdateFormatted = $post->date()->toDate('l, j. F o');
						
						if(strcmp($post->date()->toDate('j-n-o'), date('j-n-o', time())) == 0) {
							//Pubdate = today
							$pubdateFormatted .= ' <span class="today-flag">today</span>';
						}

						if(strcmp($pubdateFormattedLast, $pubdateFormatted) !== 0) {
							//If anything about the pubdate string has changed
							echo("<dt>$pubdateFormatted</dt>");
						}
					?>
					<dd><a href="<?= $post->url() ?>"><?= $post->title() ?></a></dd>
					<?php endforeach; //post ?>
				</dl>
		</main>
		<?= snippet('footer') ?>
	</body>
</html>
