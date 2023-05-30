<main>
    <section class="cards">
        <div class="cards_container container">
            <h1 class="cards_title">
                Кредитные карты
            </h1>
            <div class="cards_categories">
                <?php require('actions/get_card-category.php')?>
            </div>
            <div class="cards_content">
                <?php require('actions/get_card-products.php')?>
                
            </div>
        </div>
    </section>
</main>