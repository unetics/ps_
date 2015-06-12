<ul class="<?= $instance['style']?>">
<?php foreach( $instance['list'] as $i => $feature ) : ?>
	<li><?= $feature['content']; ?></li>
<?php endforeach; ?>
</ul>

