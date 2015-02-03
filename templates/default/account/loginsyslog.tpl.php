<div class="row">

    <div class="span10 offset1">
        <?= $this->draw('account/menu') ?>
        <h1>Account Activity</h1>
    </div>

</div>
<div class="row">
    <div class="span10 offset1 pane">
        <?php
	    echo $this->draw('LoginSyslog/logs');
	?>
    </div>
</div>