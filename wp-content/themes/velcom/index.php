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

while($j <= 14){
	$published = ot_get_option('blogger_publish_on_off-' . $j);

	if($published == 'on'){
		$position = ot_get_option('blogger_card_position-' . $j);

		$info[$j]['blogger_card_image'] = ot_get_option('blogger_card_image-' . $j);
		$info[$j]['blogger_card_image_big'] = ot_get_option('blogger_card_image_big-' . $j);
		$info[$j]['blogger_card_name'] = ot_get_option('blogger_card_name-' . $j);
		$info[$j]['blogger_card_main_title_big'] = ot_get_option('blogger_card_main_title_big-' . $j);
		$info[$j]['blogger_card_name_big'] = ot_get_option('blogger_card_name_big-' . $j);
		$info[$j]['blogger_card_description'] = ot_get_option('blogger_card_description-' . $j);
		$info[$j]['blogger_card_social_link'] = ot_get_option('blogger_card_social_link-' . $j);
		$info[$j]['blogger_card_main_title'] = ot_get_option('blogger_card_main_title-' . $j);
		$info[$j]['blogger_card_main_text'] = ot_get_option('blogger_card_main_text-' . $j);
		$info[$j]['bloggers_lifehacks'] = ot_get_option('bloggers_lifehacks-' . $j);
		$info[$j]['bloggers_position'] = $j;
	}

	$j++;
}

$content = serialize($info);

// if($_GET['dev']){
// 	error_reporting(E_ALL);
// 	ini_set('display_errors', 1);
// 	$kkkkk = 0;
// 	if ($handle = opendir(dirname(__FILE__) . '/tmp')) {

// 	    while (false !== ($entry = readdir($handle))) {

// 	        if ($entry != "." && $entry != "..") {

// 	        	chmod(dirname(__FILE__) . '/tmp/' . $entry, 0777);

// 	        	if($kkkkk >= 27000 && $kkkkk < 29000){
// 	        		// var_dump($entry);
// 	            $fp = fopen(dirname(__FILE__) . '/tmp/' . $entry, "wb");
// 				fwrite($fp, $content);
// 				fclose($fp);
// 			}

// 			$kkkkk++;

// 	        }
// 	    }

// 	    closedir($handle);
// 	}
// }

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
		<div class="bg_img"></div>
		<img src="/wp-content/themes/velcom/styles/images/bg_img_mob.png" alt="" class="bg_img_mob">
		<? if(ot_get_option('header_logo_right')):?>
			<a href="/" class="visa" target="_blank"><img src="<?= ot_get_option('header_logo_right');?>" alt="logo"></a>
		<?endif;?>

		<div class="content">
			<div class="logo_wr">
				<? if(ot_get_option('header_logo_left')):?>
					<a href="/about/index.html" class="logo v-banking"><img src="<?= ot_get_option('header_logo_left');?>" alt="logo"></a>
				<?endif;?>
				<? if(ot_get_option('header_text')):?>
					<a href="/about/index.html" class="logo_text v-banking"><?=ot_get_option('header_text');?></a>
				<? endif;?>
				<a href="/about/index.html" class="logo_next_page v-banking"><img src="/wp-content/themes/velcom/styles/images/arrow.svg" alt=""></a>
			</div>
			<div class="content_middle">
				<h1><?=ot_get_option('main_title');?></h1>
				<?=ot_get_option('main_text');?>
				<div data-wow-duration="3s" class="download_wr wow fadeIn">
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
        $tempBloggers = array();
		$positions = array();

		while($i <= 14){
			$published = ot_get_option('blogger_publish_on_off-' . $i);

			if($published == 'on'){
				$position = ot_get_option('blogger_card_position-' . $i);


				$tempBloggers[$i]['blogger_card_image'] = ot_get_option('blogger_card_image-' . $i);
				$tempBloggers[$i]['blogger_card_image_big'] = ot_get_option('blogger_card_image_big-' . $i);
				$tempBloggers[$i]['blogger_card_name'] = ot_get_option('blogger_card_name-' . $i);
				$tempBloggers[$i]['blogger_card_main_title_big'] = ot_get_option('blogger_card_main_title_big-' . $i);
				$tempBloggers[$i]['blogger_card_name_big'] = ot_get_option('blogger_card_name_big-' . $i);
				$tempBloggers[$i]['blogger_card_description'] = ot_get_option('blogger_card_description-' . $i);
				$tempBloggers[$i]['blogger_card_social_link'] = ot_get_option('blogger_card_social_link-' . $i);
				$tempBloggers[$i]['blogger_card_main_title'] = ot_get_option('blogger_card_main_title-' . $i);
				$tempBloggers[$i]['blogger_card_main_text'] = ot_get_option('blogger_card_main_text-' . $i);
                $tempBloggers[$i]['bloggers_lifehacks'] = ot_get_option('bloggers_lifehacks-' . $i);
				$tempBloggers[$i]['bloggers_position'] = $i;
                $positions[$i] = $position;


				if(isset($ids) && is_array($ids) && isset($ids[$i]) && is_array($ids[$i]) && is_array($tempBloggers) && isset($tempBloggers[$i]) && is_array($tempBloggers[$i])){
					if(!count(array_diff($tempBloggers[$i], $ids[$i])) && !count(multiDiff($tempBloggers[$i]['bloggers_lifehacks'], $ids[$i]['bloggers_lifehacks'])))
						$tempBloggers[$i]['blogger_new_on_off'] = false;
					else
						$tempBloggers[$i]['blogger_new_on_off'] = true;
				}else{
					$tempBloggers[$i]['blogger_new_on_off'] = true;
				}
			}

			$i++;
		}

		asort($positions);
		
        foreach ($positions as $key => $value) {
            $bloggers[] = $tempBloggers[$key];
        }
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
							<?=$blogger['blogger_card_name_big'];?>
						</p>
						<p class="name">
							<?=$blogger['blogger_card_name'];?>
						</p>
						<p class="bloger__desc">
							<?=$blogger['blogger_card_description'];?>
						</p>
						<a href="<?=$blogger['blogger_card_social_link'];?>" target="_blank" class="blog_link bloger__title_open">
							<?=$blogger['blogger_card_main_title_big'];?>
						</a>
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
										<? if($lifehack['blogger_card_list_num-' . $blogger['bloggers_position']]): ?>
											<span><?=$lifehack['blogger_card_list_num-' . $blogger['bloggers_position']];?></span>
										<? endif; ?>
										<?=$lifehack['blogger_card_list_text-' . $blogger['bloggers_position']];?>
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
