<?php 
if (!empty($vars['items']) && is_array($vars['items'])) { 
    foreach ($vars['items'] as $item) {

	$user = $item->getOwner(); 
	?>

	<div class="row <?= strtolower(str_replace('\\', '-', get_class($user))); ?>">
	    <div class="span3">
		<p>
		    <?php
		    if ($item->email) { ?>
			<span style="margin-right: 10px; margin-left: 10px; margin-top: 3px; margin-bottom: 3em;"><?= $item->email ?></span>
		    <?php
		    } else {
		    ?>
		    <img src="<?= $user->getIcon() ?>" style="width: 35px; float: left; margin-right: 10px; margin-left: 10px; margin-top: 3px; margin-bottom: 3em">
		    <a href="<?= $user->getDisplayURL() ?>"><?= htmlentities($user->getTitle()) ?></a> (<a href="<?= $user->getDisplayURL() ?>"><?= $user->getHandle() ?></a>)<br>
		    <small><?= $user->email ?></small>
		    <?php } ?>
		</p>
	    </div>
	    <div class="span2">
		<p>
		    <small><strong><?= $item->action; ?></strong><br><time datetime="<?= date('r', $item->created) ?>" class="dt-published"><?= date('r', $item->created) ?></time></small>
		</p>
	    </div>
	    <div class="span2">
		<p>
		    <small>From <strong><?= $item->ip; ?></strong></small>
		</p>
	    </div>
	</div>

	<?php 
    }
} 
?>