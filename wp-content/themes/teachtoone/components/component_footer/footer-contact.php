<?php 
	// Global Footer Contact 
	$address = get_field('address', 'options');
	$email = antispambot(get_field('email_address', 'options'));
	$secondaryEmail = antispambot(get_field('secondary_email_address', 'options'));
	$phone = antispambot(get_field('phone_number', 'options'));
	$secondaryPhone = antispambot(get_field('secondary_phone_number', 'options'));

?>
			<div class="footer-contact">
				<h4 class="headline4 margin-global-bottom-1x"><?= $this->displayTitle;?></h4>
				<?php if($address){ ?>
					<address class="margin-global-bottom-1x">
						<?= $address;?>
					</address>
				<?php } ?>
				<?php if($email){ ?>
					<a href="mailto:<?= $email;?>" target="_blank" class="footer-link"><?= $email;?></a>
				<?php } ?>
				<?php if($secondaryEmail){ ?>
					<a href="mailto:<?= $secondaryEmail;?>" target="_blank" class="footer-link"><?= $secondaryEmail;?></a>
				<?php } ?>
				<?php if($phone){ ?>
					<a href="tel:<?= $phone;?>" target="_blank" class="footer-link"><?= $phone;?></a>
				<?php } ?>
				<?php if($secondaryPhone){ ?>
					<a href="tel:<?= $secondaryPhone;?>" target="_blank" class="footer-link"><?= $secondaryPhone;?></a>
				<?php } ?>
			</div>
