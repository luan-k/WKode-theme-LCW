<?php get_header();?>

    <?php echo the_content(); ?>

     <section class="wkode-new-bikes__section bg-lcw-primary-blue py-40">
        <h2 class="wkode-new-bikes__title title text-center font-rubik text-white text-7xl font-semibold uppercase mb-36">Modelos em destaque</h2>
        <div class="wkode-new-bikes__category category-filter-container-wrapper container my-20">
            <div class="category-filter bg-white text-lcw-primary-blue grid grid-cols-6 rounded-full p-2 font-rubik text-2xl uppercase">
                <div class="category px-5 py-4 text-center bg-lcw-primary-red text-white rounded-full font-semibold">Todas</div>
                <div class="category px-5 py-4 text-center">Street</div>
                <div class="category px-5 py-4 text-center">Adventure</div>
                <div class="category px-5 py-4 text-center">Off Road</div>
                <div class="category px-5 py-4 text-center">Sport</div>
                <div class="category px-5 py-4 text-center">Touring</div>
            </div>
            <div class="wkode-new-bikes__carousel grid grid-cols-3 mt-20">
                <div class="wkode-new-bikes__card py-12">
                    <h3 class="wkode-new-bikes__card-title text-center font-rubik text-lcw-primary-blue text-4xl font-bold uppercase">
                        CB500 F
                    </h3>
                    <img class="wkode-new-bikes__card-img active-color-image" src="http://lcw.local/wp-content/uploads/2023/05/1920x980_desktop_02_0002s_0020_360-CB500-F-cinza_00-e1685368346586.png" alt="" srcset="">
                    <img class="wkode-new-bikes__card-img" src="http://lcw.local/wp-content/uploads/2023/05/moto-vermelha.png" alt="" srcset="">
                    <div class="wkode-new-bikes__card-colors">
                        <span class="wkode-new-bikes__card-color active-color"></span>
                        <span class="wkode-new-bikes__card-color"></span>
                    </div>
                </div>
            </div>

        </div>
       
        <div class="cards"></div>
        <div class="btn"></div>
    </section>
   

<?php get_footer(); ?>
