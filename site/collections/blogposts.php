<?php
	return function($site) {
		$articles = new Collection();
		foreach($site->find('blog')->children()->listed()->flip() as $year) {
			foreach($year->children()->listed()->flip() as $month) {
				foreach($month->children()->listed()->flip() as $post) {
					$articles->append($post);
				}
			}
		}
		
		return $articles;
	}
?>