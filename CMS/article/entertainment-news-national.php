<?php include('header.php'); ?>
<main class="sport">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            NATIONAL ENTERT
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
                get_list_entertainment('entertainment', 'national', $page, 6);
                ?>

            </div>
            <div class="row pagination">
                <div class="col-12">
                    <ul>
                        <?php pagination_news('entertainment', 'national', 3); ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>