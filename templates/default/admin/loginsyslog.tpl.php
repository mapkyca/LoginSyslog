<div class="row">

    <div class="col-md-10 col-md-offset-1">
	            <?=$this->draw('admin/menu')?>
        <h1>System Account Activity</h1>
    </div>

</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1 pane">
        <?php 
	    echo $this->draw('LoginSyslog/logs');
	?>
    </div>
</div>