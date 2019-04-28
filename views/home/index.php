<a href="<?= URL_BASE; ?>/home/create">Create</a>
<ul>
	<?php foreach ($users as $user): ?>
	<li><?= $user['id']; ?> - <?= $user['name']; ?></li>
	<?php endforeach;?>
</ul>