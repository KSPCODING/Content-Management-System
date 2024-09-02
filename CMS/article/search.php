<?php include('header.php'); 
 $search_value = $_GET['query'];

?>
<main class="sport">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            RESULT SEARCH
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
                      search_news($search_value);                
                ?>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>