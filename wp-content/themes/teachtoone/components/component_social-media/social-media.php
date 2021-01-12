<?php 
	// Social Media 
	// vars are declared in header.php so that they are always acccessible.
	global $facebook;
	global $twitter;
	global $instagram;
	global $linkedin;
	global $medium;
	global $youtube;
	global $pinterest;
	global $github;

?>

<div class="component-social-media component">
	<?php if($facebook || $twitter || $instagram || $linkedin || $medium || $youtube || $pinterest || $github) { ?>
		<?php if($this->displayTitle){ ?>
			<h3 class="<?= $this->displayTitleClass;?> <?= $this->alignment;?> margin-global-bottom-2x"><?= $this->displayTitle;?></h3>
		<?php } ?>
		<div class="social-media-list <?= $this->colorClass;?> <?= $this->alignment;?>">
			<?php if($twitter) { ?>
				<mark class="social-icon margin-global-right-2x <?= $this->iconStyle;?>"><a href="<?= $twitter;?>" target="_blank" aria-label="Visit our Twitter page"><i class="fab fa-twitter"></i></a></mark>
			<?php } ?>
			<?php if($instagram) { ?>
				<mark class="social-icon margin-global-right-2x <?= $this->iconStyle;?>"><a href="<?= $instagram;?>" target="_blank" aria-label="Visit our Instagram page"><i class="fab fa-instagram"></i></a></mark>
			<?php } ?>
			<?php if($facebook) { ?>
				<mark class="social-icon margin-global-right-2x <?= $this->iconStyle;?>"><a href="<?= $facebook;?>" target="_blank" aria-label="Visit our Facebook page"><i class="fab fa-facebook-f"></i></a></mark>
			<?php } ?>
			<?php if($linkedin) { ?>
				<mark class="social-icon margin-global-right-2x <?= $this->iconStyle;?>"><a href="<?= $linkedin;?>" target="_blank" aria-label="Visit our LinkedIn page"><i class="fab fa-linkedin-in"></i></a></mark>
			<?php } ?>
			<?php if($medium) { ?>
				<mark class="social-icon margin-global-right-2x <?= $this->iconStyle;?>"><a href="<?= $medium;?>" target="_blank" aria-label="Visit our Medium page"><i class="fab fa-medium-m"></i></a></mark>
			<?php } ?>
			<?php if($youtube) { ?>
				<mark class="social-icon margin-global-right-2x <?= $this->iconStyle;?>"><a href="<?= $youtube;?>" target="_blank" aria-label="Visit our YouTube page"><i class="fab fa-youtube"></i></a></mark>
			<?php } ?>
			<?php if($pinterest) { ?>
				<mark class="social-icon margin-global-right-2x <?= $this->iconStyle;?>"><a href="<?= $pinterest;?>" target="_blank" aria-label="Visit our Pinterest page"><i class="fab fa-pinterest-p"></i></a></mark>
			<?php } ?>
			<?php if($github) { ?>
				<mark class="social-icon margin-global-right-2x <?= $this->iconStyle;?>"><a href="<?= $github;?>" target="_blank" aria-label="Visit our Github page"><i class="fab fa-github"></i></a></mark>
			<?php } ?>
		</div>
	<?php } ?>
</div>

