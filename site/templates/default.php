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
					<?= kirbytext($page->text()) ?>
				</div>
			</article>
			<div class="contain">
				<p class="signature"><a href="<?= $page->url() ?>">⌞w⌝</a></p>
			</div>
		</main>
		<?= snippet('footer') ?>
	</body>
</html>
