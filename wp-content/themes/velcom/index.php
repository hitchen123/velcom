<?php
/**
 * Template name: Main
 */

if(isset($_COOKIE['blogger_new_on_off']))
	if(file_exists(dirname(__FILE__) . '/tmp/' . $_COOKIE['blogger_new_on_off'] . '.txt')){
		chmod(dirname(__FILE__) . '/tmp/' . $_COOKIE['blogger_new_on_off'] . ".txt", 777);
		$ids = unserialize(file_get_contents(dirname(__FILE__) . '/tmp/' . $_COOKIE['blogger_new_on_off'] . ".txt"));
	}
else $ids = null;

$info = array();

$j = 1;

while($j <= 10){
	$published = ot_get_option('blogger_publish_on_off-' . $j);

	if($published == 'on'){
		$position = ot_get_option('blogger_card_position-' . $j);

		$info[$position]['blogger_card_image'] = ot_get_option('blogger_card_image-' . $j);
		$info[$position]['blogger_card_image_big'] = ot_get_option('blogger_card_image_big-' . $j);
		$info[$position]['blogger_card_name'] = ot_get_option('blogger_card_name-' . $j);
		$info[$position]['blogger_card_main_title_big'] = ot_get_option('blogger_card_main_title_big-' . $j);
		$info[$position]['blogger_card_name_big'] = ot_get_option('blogger_card_name_big-' . $j);
		$info[$position]['blogger_card_description'] = ot_get_option('blogger_card_description-' . $j);
		$info[$position]['blogger_card_social_link'] = ot_get_option('blogger_card_social_link-' . $j);
		$info[$position]['blogger_card_main_title'] = ot_get_option('blogger_card_main_title-' . $j);
		$info[$position]['blogger_card_main_text'] = ot_get_option('blogger_card_main_text-' . $j);
		$info[$position]['bloggers_lifehacks'] = ot_get_option('bloggers_lifehacks-' . $j);
	}

	$j++;
}

$content = serialize($info);

if(!isset($_COOKIE['blogger_new_on_off'])){
	$fileName = md5(uniqid(rand(), true));

	$fp = fopen(dirname(__FILE__) . '/tmp/' . $fileName . ".txt","wb");
	fwrite($fp,$content);
	fclose($fp);

	setcookie('blogger_new_on_off', $fileName, time()+60*60*24*120);
}else{
	unlink(dirname(__FILE__) . '/tmp/' . $_COOKIE['blogger_new_on_off'] . ".txt");
	$fp = fopen(dirname(__FILE__) . '/tmp/' . $_COOKIE['blogger_new_on_off'] . ".txt", "wb");
	fwrite($fp,$content);
	fclose($fp);
}

function multiDiff($array1, $array2){
	$difference = array();
	foreach($array1 as $key => $value)
	{
	    if(is_array($value))
	    {
	        if(!isset($array2[$key]))
	        {
	            $difference[$key] = $value;
	        }
	        elseif(!is_array($array2[$key]))
	        {
	            $difference[$key] = $value;
	        }
	        else
	        {
	            $new_diff = array_diff($value, $array2[$key]);
	            if($new_diff != FALSE)
	            {
	                $difference[$key] = $new_diff;
	            }
	        }
	    }
	    elseif(!isset($array2[$key]) || $array2[$key] != $value)
	    {
	        $difference[$key] = $value;
	    }
	}

	return $difference;
}

get_header();
?>
	<section class="starting_section">
		<div data-wow-duration=".5s" class="bg_img wow slideInRight"></div>
		<img src="/wp-content/themes/velcom/styles/images/bg_img_mob.png" alt="" class="bg_img_mob">
		<? if(ot_get_option('header_logo_right')):?>
			<a data-wow-duration=".5s" href="/" class="visa wow slideInRight" target="_blank"><img src="<?= ot_get_option('header_logo_right');?>" alt="logo"></a>
		<?endif;?>

		<div data-wow-duration=".5s" class="content wow slideInLeft">
			<div class="logo_wr">
				<? if(ot_get_option('header_logo_left')):?>
					<a href="/" class="logo v-banking"><img src="<?= ot_get_option('header_logo_left');?>" alt="logo"></a>
				<?endif;?>
				<? if(ot_get_option('header_text')):?>
					<a href="/" class="logo_text v-banking"><?=ot_get_option('header_text');?></a>
				<? endif;?>
				<a href="#" class="logo_next_page v-banking"><img src="/wp-content/themes/velcom/styles/images/arrow.svg" alt=""></a>
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

		<div data-wow-duration=".5s" class="owl-carousel wow bounceInUp">
			<? $slides = ot_get_option('cards');
			foreach($slides as $key => $slide):?>
				<?if($slide['card_text_added']):?>
					<a href="#" data-id="<? echo ($key+1); ?>" class="slider__item hidden">
						<?if($slide['card_icon']):?>
							<img src="<?=$slide['card_icon'];?>" alt="icon">
						<?endif;?>
						<div>
							<?=$slide['card_text'];?>
						</div>
						<? if($slide['card_text_added_open']): ?>
							<div class="additional additional_show">
								<?=$slide['card_text_added_open'];?>
	 						</div>
	 					<? endif; ?>
						<div class="additional">
							<?=$slide['card_text_added'];?>
 						</div>
 						<span class="close_slider"></span>
					</a>
				<?else:?>
					<div class="slider__item">
						<?if($slide['card_icon']):?>
							<img src="<?=$slide['card_icon'];?>" alt="icon">
						<?endif;?>
						<div>
							<?=$slide['card_text'];?>
						</div>
						<? if($slide['card_text_added_open']): ?>
							<div class="additional additional_show">
								<?=$slide['card_text_added_open'];?>
	 						</div>
	 					<? endif; ?>
					</div>
				<?endif;?>
			<?endforeach;?>
		</div>

	</section>

	<section data-wow-duration=".5s" class="section_about wow bounceInUp">
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


				$bloggers[$position]['blogger_card_image'] = ot_get_option('blogger_card_image-' . $i);
				$bloggers[$position]['blogger_card_image_big'] = ot_get_option('blogger_card_image_big-' . $i);
				$bloggers[$position]['blogger_card_name'] = ot_get_option('blogger_card_name-' . $i);
				$bloggers[$position]['blogger_card_main_title_big'] = ot_get_option('blogger_card_main_title_big-' . $i);
				$bloggers[$position]['blogger_card_name_big'] = ot_get_option('blogger_card_name_big-' . $i);
				$bloggers[$position]['blogger_card_description'] = ot_get_option('blogger_card_description-' . $i);
				$bloggers[$position]['blogger_card_social_link'] = ot_get_option('blogger_card_social_link-' . $i);
				$bloggers[$position]['blogger_card_main_title'] = ot_get_option('blogger_card_main_title-' . $i);
				$bloggers[$position]['blogger_card_main_text'] = ot_get_option('blogger_card_main_text-' . $i);
				$bloggers[$position]['bloggers_lifehacks'] = ot_get_option('bloggers_lifehacks-' . $i);

				if(is_array($ids)){
					if(!count(array_diff($bloggers[$position], $ids[$position])) && !count(multiDiff($bloggers[$position]['bloggers_lifehacks'], $ids[$position]['bloggers_lifehacks'])))
						$bloggers[$position]['blogger_new_on_off'] = false;
					else
						$bloggers[$position]['blogger_new_on_off'] = true;
				}else{
					$bloggers[$position]['blogger_new_on_off'] = true;
				}
			}

			$i++;
		}

		ksort($bloggers);
	?>
	<section class="blogers">
		<? foreach ($bloggers as $key => $blogger): ?>
			<div data-wow-duration=".5s" data-id="<? echo ($key + 1);?>" class="bloger_wr wow <? if(($key % 2) == 0): ?>slideInRight<? else: ?>slideInLeft<? endif; ?>">
				<div class="blog_wr2">
					<div class="bloger__photo-cut">
						<? if($blogger['blogger_card_image_big']): ?>
							<div class="bloger__photo" style="background-image: url(<?=$blogger['blogger_card_image_big'];?>)"></div>
						<? endif; ?>
						<? if($blogger['blogger_card_image']): ?>
							<div class="bloger__photo_mob" style="background-image: url(<?=$blogger['blogger_card_image'];?>)"></div>
						<? endif; ?>
						<div class="layout_big"></div>
						<img class="layout_small" src="/wp-content/themes/velcom/styles/images/blogger_mini.svg" alt="">
					</div>
					<div class="bloger__about">
						<p class="name_open">
							<a href="<?=$blogger['blogger_card_social_link'];?>" target="_blank" class="blog_link"><?=$blogger['blogger_card_name_big'];?></a>
						</p>
						<p class="name">
							<?=$blogger['blogger_card_name'];?>
						</p>
						<p class="bloger__desc">
							<?=$blogger['blogger_card_description'];?>
						</p>
						<h5 class="bloger__title_open">
							<?=$blogger['blogger_card_main_title_big'];?>
						</h5>
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
					<? if($blogger['blogger_new_on_off']): ?>
						<span class="new">new</span>
					<? endif; ?>
					<a href="#" class="bloger__close">закрыть</a>
				</div>
			</div>
		<? endforeach; ?>
	</section>
<?php
get_footer();
