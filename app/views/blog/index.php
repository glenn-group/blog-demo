<h1>Blog posts</h1>
<?=$extra?>
<ul>
	<? foreach ($posts as $post): ?>
		<li><strong><?= $post->title ?></strong> <?= $post->content ?></li>
	<? endforeach ?>
</ul>
