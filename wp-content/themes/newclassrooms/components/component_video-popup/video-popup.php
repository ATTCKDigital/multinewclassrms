<?php 
	$src = '';

	if (isset($this->args['src']))
		$src = $this->args['src'];
?>

<div class="component-video-popup">
	<div class="popup">
		<button class="close-button" aria-label="close popup"></button>
		<div class="popup-content-container flex-grid">
			<iframe title="video popup content" src="<?= $src ?>"></iframe>
		</div>
	</div>
</div>