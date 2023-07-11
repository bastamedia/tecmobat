<?php

/*
Template Name: Projects Template
*/

get_header(); ?>

<div class="content">
    <div class="wp-block-group has-overflow-x-hidden is-layout-constrained wp-container-5" style="padding-top: 200px; padding-bottom: 50px;">
        <!-- Slider main container -->
        <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
            <div class="inner-swiper-slide" style="background: url('//home/pmlogist/Code/basta/customers/tecmobat/web/app/uploads/2023/05/33-rue-Vaubecour-69002-Lyon-3.jpg') no-repeat center; background-size: cover">
                <i class="opacity-controller"></i>
                <h2>Hôtel de ville</h2>
                <span>Lyon</span>
            </div>
            </div>
            <div class="swiper-slide">
            <div class="inner-swiper-slide" style="background: url('//home/pmlogist/Code/basta/customers/tecmobat/web/app/uploads/2023/05/8-rue-Sala-69002-Lyon-2.jpg') no-repeat center; background-size: cover">
                <i class="opacity-controller"></i>
                <h2>Rue Sala</h2>
                <span>Lyon</span>
            </div>
            </div>
            <div class="swiper-slide">
            <div class="inner-swiper-slide" style="background: url('//home/pmlogist/Code/basta/customers/tecmobat/web/app/uploads/2023/05/84-rue-du-Président-Edouard-Herriot-69002-Lyon-1.jpg') no-repeat center; background-size: cover">
                <i class="opacity-controller"></i>
                <h2>Rue du Président Édouard Herriot</h2>
                <span>Lyon</span>
            </div>
            </div>
            <div class="swiper-slide">
            <div class="inner-swiper-slide" style="background: url('//home/pmlogist/Code/basta/customers/tecmobat/web/app/uploads/2023/05/1-rue-Childebert-69002-Lyon-4.jpg') no-repeat center; background-size: cover">
                <i class="opacity-controller"></i>
                <h2>Childebert</h2>
                <span>Lyon</span>
            </div>
            </div>
            <div class="swiper-slide">
            <div class="inner-swiper-slide" style="background: url('//home/pmlogist/Code/basta/customers/tecmobat/web/app/uploads/2023/05/Le-Parc-de-La-Fontanière.jpeg') no-repeat center; background-size: cover">
                <i class="opacity-controller"></i>
                <h2>Le Parc Fontanières</h2>
                <span>Villeurbanne</span>
            </div>
            </div>
            <div class="swiper-slide">
            <div class="inner-swiper-slide" style="background: url('//home/pmlogist/Code/basta/customers/tecmobat/web/app/uploads/2023/07/70948078117__39F57CDF-4F04-49FA-B590-57B1E44E8321-scaled.jpg') no-repeat center; background-size: cover">
                <i class="opacity-controller"></i>
                <h2>Rue Jacquard</h2>
                <span>Lyon</span>
            </div>
            </div>
        </div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
        </div>
    </div>
</div>
<?php the_content() ?>

<?php get_footer();
