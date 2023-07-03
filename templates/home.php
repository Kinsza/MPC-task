<?php
/*
Template name: Home
*/
get_header(); ?>
<div class="vue-app">
    <index id="<?php echo get_option('page_on_front');?>"></index>
</div>
<div class="container mx-auto">
    <div class="right-left_block lg:mt-36 md:mt-20 my-12">
        <div class="layout-switch">
            <div class="flex flex-wrap w-full" style=" <?php if (get_field('buttons') === 'right') : ?>
                flex-direction: row-reverse; <?php endif; ?>">
                <?php if ( have_rows( 'right-left_block' ) ) : ?>
                <?php while ( have_rows( 'right-left_block' ) ) : the_row(); ?>

                <?php if ( get_sub_field( 'image' ) ) : ?>
                <div class="image-col lg:w-6/12 w-full lg:p-0 py-64 bg-cover bg-no-repeat bg-center" data-aos="fade-up"
                    data-aos-duration="1000" style="background-image: url(<?php the_sub_field( 'image' ); ?>);">
                </div>
                <?php endif ?>
                <div class="text-col lg:w-6/12 w-full lg:px-7 lg:py-5 py-7">
                    <?php the_sub_field( 'text' ); ?>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="rating-block mb-16">
        <h2 class="text-center mb-7 lg:pt-10 pt-0">Opinions</h2>
        <?php $selected_rating = get_field('rating');?>
        <?php $position = get_field('position');?>
        <?php $name_form = get_field('name_form');?>
        <?php formOpinion() ?>
        <?php saveOpinion() ?>

        <?php
        //SLIDER LAYOUT

        if (get_field( 'opinions_layout' ) === "slider"){
            opinionSlider();

        // second opinions (v2)
        $args = array(
        'post_type' => 'opinionsv2',
        'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
        ?>
        <div class="container mx-auto">
            <div class="swiper mySwiper2 pb-4">
                <div class="swiper-wrapper">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        $ratingstar = get_field('rating2');
                    ?>
                    <div class="swiper-slide mt-6">
                        <div class="flex flex-row-reverse gap-3 border-2 border-green-200 border-solid rounded-lg p-4">
                            <div class="w-full">
                                <div>
                                    <div class="stars">
                                        <?php if ($ratingstar === '1') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <?php } else if ($ratingstar === '1.5') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star star-half"></span>
                                        </div>

                                        <?php } else if ($ratingstar === '2') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <?php } else if ($ratingstar === '2.5') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star star-half"></span>
                                        </div>
                                        <?php } else if ($ratingstar === '3') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                        <?php } else if ($ratingstar === '3.5') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star star-half"></span>
                                        </div>
                                        <?php } else if ($ratingstar === '4') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <?php } else if ($ratingstar === '4.5') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star star-half"></span>
                                        </div>
                                        <?php } else if ($ratingstar === '5') { ?>
                                        <div>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php the_field( 'positionv2' ); ?>
                                    <?php $authorCpt = get_field('authorCpt'); ?>
                                    <?php if ($authorCpt) : ?>
                                    <?php $post = $authorCpt; ?>
                                    <?php setup_postdata($post); ?>
                                </div>
                                <?php $a = get_the_title();?>
                                <div>
                                    <?php the_title(); ?>
                                </div>
                            </div>
                            <?php $avatar1 = strtoupper(substr($a, 0, 1));?>
                            <div
                                class=" bg-green-200 shrink-0 text-black inline-flex rounded-full text-xl w-12 h-12 text-center items-center justify-center">
                                <?php echo $avatar1; ?>
                            </div>
                        </div>
                        <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>

                    <?php } ?>
                </div>
            </div>
            <div class="swiper-pagination2 text-center relative bottom-0"></div>
        </div>
        <?php
            wp_reset_postdata();
            } else {
            echo 'Brak Ocen';
            } }
/*GRID LAYOUT*/
else if(get_field( 'opinions_layout' ) === "grid"){
opinionGrid();

 // second opinions (v2)
 $args = array(
    'post_type' => 'opinionsv2',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);
if ($query->have_posts()) {
?>
        <div
            class="opinionsv2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-4 container mx-auto mt-6">
            <?php
            while ($query->have_posts()) {
                $query->the_post();
                $ratingstar = get_field('rating2');
            ?>
            <div class="flex flex-row-reverse gap-3 border-2 border-green-200 border-solid rounded-lg p-4">
                <div class="w-full">
                    <div>
                        <div>
                            <?php if ($ratingstar === '1') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                            </div>
                            <?php } else if ($ratingstar === '1.5') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star star-half"></span>
                            </div>

                            <?php } else if ($ratingstar === '2') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <?php } else if ($ratingstar === '2.5') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star star-half"></span>
                            </div>
                            <?php } else if ($ratingstar === '3') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>

                            <?php } else if ($ratingstar === '3.5') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star star-half"></span>
                            </div>
                            <?php } else if ($ratingstar === '4') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <?php } else if ($ratingstar === '4.5') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star star-half"></span>
                            </div>
                            <?php } else if ($ratingstar === '5') { ?>
                            <div>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>

                            <?php } ?>

                        </div>
                        <?php the_field( 'positionv2' ); ?>
                        <?php $authorCpt = get_field('authorCpt'); ?>
                        <?php if ($authorCpt) : ?>
                        <?php $post = $authorCpt; ?>
                        <?php setup_postdata($post); ?>
                    </div>
                    <?php $a = get_the_title();?>

                    <div>
                        <?php the_title(); ?>
                    </div>
                </div>
                <?php $avatar1 = strtoupper(substr($a, 0, 1));?>
                <div
                    class=" bg-green-200 shrink-0 text-black inline-flex rounded-full text-xl w-12 h-12 text-center items-center justify-center">
                    <?php echo $avatar1; ?>
                </div>
            </div>

            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php }} ?>
        </div>
    </div>
    <?php  } ?>
</div>
</div>

<?php get_footer();