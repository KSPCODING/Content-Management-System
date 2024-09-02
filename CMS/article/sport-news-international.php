<?php include('header.php'); ?>
<main class="sport">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            INTERNATIONAL SPORT
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <?php
                if (!empty(($_GET['page']))) {
                    $page = $_GET['page'];
                } else {
                    $page = 0;
                }
                get_list_news('sport', 'international', $page, 6);
                ?>

            </div>
            <div class="row pagination">
                <div class="col-12">
                    <ul>
                        <?php pagination_news('sport', 'international', 3); ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>