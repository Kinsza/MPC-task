<?php


add_filter( 'body_class', function( $classes ) {

	if ( is_singular( ['post', 'page'] ) ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() ) {
		$classes[] = 'front-page';
	}

	return $classes;

});

/*opinionsv1*/
function saveOpinion(){
	$args = array(
		'post_type' => 'opinions', 
		'posts_per_page' => -1, 
	);
	$opinions = get_posts($args);
	
	if (isset($_POST['submit_rating'])) {
		$selected_rating = $_POST['rating2']; 
		$position = $_POST['position']; 
		$name_form = $_POST['name_form'];
		$new_post_opinions = array(
			'post_title' => 'Rating: ' . $selected_rating, 
			'post_type' => 'opinions', 
			'post_status' => 'publish' 
		);
		$opinions_post_id = wp_insert_post($new_post_opinions);
		update_field('rating', $selected_rating, $opinions_post_id);
		update_field('position', $position, $opinions_post_id);
		update_field('name_form', $name_form, $opinions_post_id);
		echo "<script type='text/javascript'>
			window.location=document.location.href;
			</script>";
		exit;
	}
}


/* -------------------------------------------------------------------------- */
/*                               Opinion slider                               */
/* -------------------------------------------------------------------------- */
function opinionSlider(){
	$args = array(
		'post_type' => 'opinions',
		'posts_per_page' => -1,
		);
		
		$query = new WP_Query($args);
		
		if ($query->have_posts()) { ?>
<div class=" container mx-auto">
    <div class="swiper mySwiper pb-4">
        <div class="swiper-wrapper">
            <?php
			while ($query->have_posts()) {
			$query->the_post();
			$rating = get_field('rating');
			$position = get_field('position');
			$name_form = get_field('name_form');
			$avatar = strtoupper(substr($name_form, 0, 1));
			$image_one_star = get_template_directory_uri() . '/vite/src/assets/img/1.png';
			$image_half_star = get_template_directory_uri() . '/vite/src/assets/img/05.png';
			?>
            <div class="swiper-slide mt-6">
                <div class="flex gap-3 border-2 border-green-200 border-solid rounded-lg p-4">
                    <div
                        class=" bg-green-200 text-black inline-flex rounded-full text-xl w-12 h-12 text-center items-center justify-center">
                        <?php echo $avatar; ?>
                    </div>
                    <div class="flex flex-col">
                        <?php
							echo 'Name: ' . $name_form . '<br>'; 
							echo 'Position: ' . $position . '<br>';
							if ($rating === "1"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                        </div>
                        <?php }
							else if ($rating === "1.5"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_half_star ?>">
                        </div>
                        <?php }
							else if ($rating === "2"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                        </div>
                        <?php }
							else if ($rating === "2.5"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_half_star ?>">
                        </div>
                        <?php }
							else if ($rating === "3"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                        </div>
                        <?php }
							else if ($rating === "3.5"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_half_star ?>">
                        </div>
                        <?php }
							else if ($rating === "4"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                        </div>
                        <?php }
							else if ($rating === "4.5"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_half_star ?>">
                        </div>
                        <?php }
							else if ($rating === "5"){ ?>
                        <div class="flex showRating">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                            <img src="<?php echo $image_one_star ?>">
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="swiper-pagination relative bottom-0"></div>
</div>
<?php  wp_reset_postdata(); } 
		
		else {
			echo 'Brak Ocen';
		}}

/* -------------------------------------------------------------------------- */
/*                                Opinion grid                                */
/* -------------------------------------------------------------------------- */
function opinionGrid(){
	
	$args = array(
		'post_type'      => 'opinions',
		'posts_per_page' => -1,
	);
	$query = new WP_Query($args);
	if ($query->have_posts()) { ?>

<div class="opinions grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-4 container mx-auto mt-6">
    <?php
			while ($query->have_posts()) {
				$query->the_post();
				$rating   = get_field('rating');
				$position = get_field('position');
				$name_form = get_field('name_form');
				$avatar   = strtoupper(substr($name_form, 0, 1));
				$image_one_star = get_template_directory_uri() . '/vite/src/assets/img/1.png';
				$image_half_star = get_template_directory_uri() . '/vite/src/assets/img/05.png';
		?>
    <div class="">
        <div class="flex gap-3 border-2 border-green-200 border-solid rounded-lg p-4">
            <div
                class="bg-green-200 text-black inline-flex rounded-full text-xl w-12 h-12 text-center items-center justify-center">
                <?php echo $avatar; ?>
            </div>
            <div class="flex flex-col">
                <?php
							echo $name_form . '<br>'; 
							echo $position . '<br>';
							if ($rating === "1"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                </div>
                <?php }
							else if ($rating === "1.5"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_half_star ?>">
                </div>
                <?php }
							else if ($rating === "2"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                </div>
                <?php }
							else if ($rating === "2.5"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_half_star ?>">
                </div>
                <?php }
							else if ($rating === "3"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                </div>
                <?php }
							else if ($rating === "3.5"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_half_star ?>">
                </div>
                <?php }
							else if ($rating === "4"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                </div>
                <?php }
							else if ($rating === "4.5"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_half_star ?>">
                </div>
                <?php }
							else if ($rating === "5"){ ?>
                <div class="flex showRating">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                    <img src="<?php echo $image_one_star ?>">
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php wp_reset_query(); }
	else {
		echo 'Brak Ocen';
	}
};	

function formOpinion(){ ?>
<form class="flex flex-col container mx-auto max-w-[495px]" method="post" action="">
    <div class="flex justify-center">
        <div class="rating-group">
            <div class="flex">
                <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                <input class="rating__input" name="rating2" id="rating2-10" value="1" type="radio">
                <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                <input class="rating__input" name="rating2" id="rating2-15" value="1.5" type="radio">
                <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                <input class="rating__input" name="rating2" id="rating2-20" value="2" type="radio">
                <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                <input class="rating__input" name="rating2" id="rating2-25" value="2.5" type="radio" checked>
                <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                <input class="rating__input" name="rating2" id="rating2-30" value="3" type="radio">
                <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                <input class="rating__input" name="rating2" id="rating2-35" value="3.5" type="radio">
                <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                <input class="rating__input" name="rating2" id="rating2-40" value="4" type="radio">
                <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                <input class="rating__input" name="rating2" id="rating2-45" value="4.5" type="radio">
                <label aria-label="5 stars" class="rating__label" for="rating2-50"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                <input class="rating__input" name="rating2" id="rating2-50" value="5" type="radio">
            </div>

        </div>
    </div>
    <div class="flex gap-2">
        <input class=" outline-green-200 w-full outline outline-1 px-2 py-1 rounded-sm" type="text" name="position"
            placeholder="Position" />
        <input class=" outline-green-200 w-full outline outline-1 px-2 py-1 rounded-sm" type="text" name="name_form"
            placeholder="Name" />
    </div>

    <input
        class=" bg-green-200 cursor-pointer hover:bg-green-300 py-2 px-2 text-2xl flex uppercase justify-center items-center mt-2 rounded-sm transition-all"
        type="submit" name="submit_rating" value="Send" />
</form>
<?php }