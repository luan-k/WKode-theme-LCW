<?php get_header();?>

    <?php echo the_content(); ?>

     <section class="wkode-highlight-section bg-lcw-primary-blue py-40">
        <h2 class="title text-center font-rubik text-white text-6xl font-semibold uppercase">Modelos em destaque</h2>
        <div class="category-filter-container-wrapper container my-20">
            <div class="category-filter bg-white text-lcw-primary-blue grid grid-cols-6 rounded-full p-2 font-rubik text-2xl uppercase">
                <div class="category px-5 py-3 text-center bg-lcw-primary-red text-white rounded-full font-semibold">Todas</div>
                <div class="category px-5 py-3 text-center">Street</div>
                <div class="category px-5 py-3 text-center">Adventure</div>
                <div class="category px-5 py-3 text-center">Off Road</div>
                <div class="category px-5 py-3 text-center">Sport</div>
                <div class="category px-5 py-3 text-center">Touring</div>
            </div>
        </div>
       
        <div class="cards"></div>
        <div class="btn"></div>
    </section>
   

<?php get_footer(); ?>
