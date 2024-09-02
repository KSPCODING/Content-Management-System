<?php 
    include('header.php'); 
    $id = $_GET['id'];
    $news_detail = get_news_detail($id);
    update_viewer($id, $news_detail['viewer']);
?>
<main class="news-detail">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="main-news">
                        <div class="thumbnail">
                            <img src="../admin/assets/image/<?php echo $news_detail['thumbnail'] ?>">
                        </div>
                        <div class="detail">
                            <h3 class="title"><?php echo $news_detail['title'] ?></h3>
                            <div class="date"><?php echo $news_detail['created_at'] ?></div>
                            <div class="description"><?php echo $news_detail['description'] ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="relate-news">
                        <h3 class="main-title">Related News</h3>
                        <?php get_related_news($id, $news_detail['news_type']) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>