<?php 
	$src = '';

	if (isset($this->args['src']))
		$src = $this->args['src'];
?>

<div class="component-video-popup">
	<div class="popup">
		<button class="close-button"></button>
		<div class="popup-content-container flex-grid">
			<iframe src="<?= $src ?>"></iframe>
		</div>
	</div>
</div>