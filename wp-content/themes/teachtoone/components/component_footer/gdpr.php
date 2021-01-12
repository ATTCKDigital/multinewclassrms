<?php //GDPR Pop-up ?>

<div class="component component-gdpr hideGDPR" data-component-name="GDPR">
	<div class="component-row-full">
		<div class="flex-grid component-alignment-center">
			<div class="flex-desktop-2-12 flex-tablet-landscape-2-12 flex-tablet-portrait-0-12 flex-0-12"></div>
			<div class="flex-desktop-8-12 flex-tablet-landscape-8-12 flex-tablet-portrait-12-12 flex-12-12">
				<div class="gdpr-message body-text padding-top-5x padding-bottom-5x padding-tablet-portrait-top-10x padding-tablet-portrait-bottom-10x padding-left-5x padding-right-5x">
					<?= get_field('gdpr_message', 'options');?>
					<span class="cta gdprAgree">Close and accept</span>
				</div>
			</div>
		</div>
	</div>
</div>