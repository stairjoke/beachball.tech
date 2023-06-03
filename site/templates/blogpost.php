<!DOCTYPE html>
<html lang="en">
	<?= snippet('HTMLhead') ?>
	<!--
		<a href="#my-dads-office-was-interesting" title="Click to copy the permalink to this position." onclick="navigator.clipboard.writeText(window.location + event.target.href).then(function(){window.alert('success')}, function(){window.alert('error')}); return false;">My dad’s office was interesting</a>
	-->
	<body>
		<?= snippet('header') ?>
		<main>
			<article>
				<h1><?= $page->title() ?></h1>
				<div class="contain-text">
					<?= markdown($page->text()) ?>
				</div>
			</article>
			<div class="contain visually-grouped">
				<p><a class="simple" href="<?= $page->url() ?>" title="permalink">⌞w⌝</a> | <time datetime="<?= $page->date()->toDate('Y-m-d H:i') ?>"><?= $page->date()->toDate('l, j F \1\2\,\0y') ?>  <a class="simple" href="/time">HE</a></time></p>
			</div>
		</main>
		<?= snippet('footer') ?>
	</body>
</html>
