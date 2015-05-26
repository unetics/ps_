<ul>
<?php foreach( $instance['list'] as $i => $feature ) : ?>
<li><div class='icon'><svg><use xlink:href='#:<?=$feature['icon'];?>' /></svg></div><?= $feature['content']; ?></li>
<?php endforeach; ?>
</ul>
<?php var_dump($instance);?>