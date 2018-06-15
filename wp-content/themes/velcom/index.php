<?php
/**
 * Template name: Main
 */
get_header();
?>
	<section class="starting_section">
		<div class="bg_img wow slideInRight"></div>
		<img src="/wp-content/themes/velcom/styles/images/bg_img_mob.png" alt="" class="bg_img_mob">
		<? if(ot_get_option('header_logo_right')):?>
			<a href="/" class="visa wow slideInRight" target="_blank"><img src="<?= ot_get_option('header_logo_right');?>" alt="logo"></a>
		<?endif;?>

		<div class="content wow slideInLeft">
			<div class="logo_wr">
				<? if(ot_get_option('header_logo_left')):?>
					<a href="/" class="logo v-banking"><img src="<?= ot_get_option('header_logo_left');?>" alt="logo"></a>
				<?endif;?>
				<? if(ot_get_option('header_text')):?>
					<a href="/" class="logo_text v-banking"><?=ot_get_option('header_text');?></a>
				<? endif;?>
				<a href="#" class="logo_next_page"><img src="/wp-content/themes/velcom/styles/images/arrow.svg" alt=""></a>
			</div>
			<div class="content_middle">
				<h1><?=ot_get_option('main_title');?></h1>
				<?=ot_get_option('main_text');?>
				<div class="download_wr">
					<p><?=ot_get_option('download_text');?></p>
					<? if(ot_get_option('apps_android')):?>
						<a data-target="google" href="<?=ot_get_option('apps_android_link');?>" target="_blank"><img src="<?=ot_get_option('apps_android');?>" alt="app"></a>
					<?endif;?>
					<? if(ot_get_option('apps_ios')):?>
						<a data-target="apple" href="<?=ot_get_option('apps_ios_link');?>" target="_blank"><img src="<?=ot_get_option('apps_ios');?>" alt="app"></a>
					<?endif;?>
				</div>
			</div>
		</div>

		<div class="owl-carousel wow bounceInUp">
			<? $slides = ot_get_option('cards');
			foreach($slides as $key => $slide):?>
				<?if($slide['card_text_added'] && $slide['card_text_added_show_on_off'] !== 'on'):?>
					<a href="#" data-id="<? echo ($key+1); ?>" class="slider__item hidden">
						<?if($slide['card_icon']):?>
							<img src="<?=$slide['card_icon'];?>" alt="icon">
						<?endif;?>
						<span>
							<?=str_ireplace(PHP_EOL,'<br>', $slide['card_text']);?>
						</span>
						<span class="additional">
							(<?=$slide['card_text_added'];?>)
 						</span>
 						<span class="close_slider"></span>
					</a>
				<?else:?>
					<div class="slider__item">
						<?if($slide['card_icon']):?>
							<img src="<?=$slide['card_icon'];?>" alt="icon">
						<?endif;?>
						<span>
							<?=str_ireplace(PHP_EOL,'<br>', $slide['card_text']);?>
						</span>
						<? if($slide['card_text_added_show_on_off'] == 'on'): ?>
							<span class="additional additional_show">
								(<?=$slide['card_text_added'];?>)
	 						</span>
	 					<? endif; ?>
					</div>
				<?endif;?>
			<?endforeach;?>
		</div>

	</section>

	<section class="section_about wow bounceInUp">
		<div class="content section_about__content">
			<h1><?=str_ireplace(PHP_EOL,'<br>', ot_get_option('guide_title'));?></h1>
			<?=ot_get_option('guide_text');?>
		</div>

		<? if(ot_get_option('guide_image')):?>
			<img class="section_about__img" src="<?=ot_get_option('guide_image');?>" alt="image">
		<?endif;?>
	</section>

	<?	$i = 1;
		$bloggers = array();
		while($i <= 10){
			$published = ot_get_option('blogger_publish_on_off-' . $i);

			if($published == 'on'){
				$position = ot_get_option('blogger_card_position-' . $i);

				$bloggers[$position]['blogger_new_on_off'] = ot_get_option('blogger_new_on_off-' . $i);
				$bloggers[$position]['blogger_card_image'] = ot_get_option('blogger_card_image-' . $i);
				$bloggers[$position]['blogger_card_name'] = ot_get_option('blogger_card_name-' . $i);
				$bloggers[$position]['blogger_card_description'] = ot_get_option('blogger_card_description-' . $i);
				$bloggers[$position]['blogger_card_social_link'] = ot_get_option('blogger_card_social_link-' . $i);
				$bloggers[$position]['blogger_card_main_title'] = ot_get_option('blogger_card_main_title-' . $i);
				$bloggers[$position]['blogger_card_main_text'] = ot_get_option('blogger_card_main_text-' . $i);
				$bloggers[$position]['bloggers_lifehacks'] = ot_get_option('bloggers_lifehacks-' . $i);
			}

			$i++;
		}

		ksort($bloggers);
	?>
	<section class="blogers">
		<? foreach ($bloggers as $key => $blogger): ?>
			<div data-id="<? echo ($key + 1);?>" class="bloger_wr wow <? if(($key % 2) == 0): ?>slideInRight<? else: ?>slideInLeft<? endif; ?>">
				<div class="blog_wr2">
					<div class="bloger__photo-cut">
						<? if($blogger['blogger_card_image']): ?>
							<div class="bloger__photo" style="background-image: url(<?=$blogger['blogger_card_image'];?>)"></div>
						<? endif; ?>
						<div class="layout_big"></div>
						<img class="layout_small" src="/wp-content/themes/velcom/styles/images/blogger_mini.svg" alt="">
					</div>
					<div class="bloger__about">
						<p class="name">
							<?=$blogger['blogger_card_name'];?>
						</p>
						<p class="bloger__desc">
							<?=$blogger['blogger_card_description'];?>
						</p>
						<h5 class="bloger__title">
							<?=$blogger['blogger_card_main_title'];?>
						</h5>
						<p class="bloger__profile">
							<?=$blogger['blogger_card_main_text'];?>
						</p>
					</div>
					<div class="bloger__profile_mob">
						<?=$blogger['blogger_card_main_text'];?>
					</div>
					<? if(count($blogger['bloggers_lifehacks'])): ?>
						<div class="bloger__tips">
							<ul>
								<? foreach ($blogger['bloggers_lifehacks'] as $lifehack): ?>
									<li>
										<? if($lifehack['blogger_card_list_num-' . $key]): ?>
											<span><?=$lifehack['blogger_card_list_num-' . $key];?></span>
										<? endif; ?>
										<?=$lifehack['blogger_card_list_text-' . $key];?>
									</li>
								<? endforeach; ?>
							</ul>
						</div>
					<? endif; ?>
					<? if($blogger['blogger_new_on_off'] == 'on'): ?>
						<span class="new">new</span>
					<? endif; ?>
					<a href="#" class="bloger__close">закрыть</a>
				</div>
			</div>
		<? endforeach; ?>
	</section>
<?php
get_footer();
