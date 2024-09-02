<?php include('header.php'); ?>
<main class="home">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            TRENDING NOW
                        </div>   
                        <div class="content-right">
                            <marquee behavior="" direction="left">
                                <div class="text-news">
                                    <?php get_trending_news() ?>
                                </div>
                            </marquee>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="latest-news">
        <div class="container">
            <div class="row">
                <div class="col-8 content-left">
                    <?php
                        $top1_popular = get_top_1_popular_news();
                        $top1_popular_id = $top1_popular['id'];
                        echo '
                            <figure>
                                <a href="news-detail.php?id='.$top1_popular['id'].'">
                                    <div class="thumbnail">
                                        <img src="../admin/assets/image/'.$top1_popular['thumbnail'].'" alt="">
                                        <div class="title">'.$top1_popular['title'].'</div>
                                    </div>
                                </a>
                            </figure>
                        ';
                    ?>
 
                </div>
                <div class="col-4 content-right">
                    <?php 
                        get_top_2_popular_news($top1_popular_id);
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            SPORT NEWS
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news">
        <div class="container">
            <div class="row">
                <?php
                    get_latest_news_homepage('sport');
                ?>
            </div>
        </div>
    </section>

    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            TECHNOLOGY NEWS
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="news">
        <div class="container">
            <div class="row">
                <?php
                    get_latest_news_homepage('technology');
                ?>
            </div>
        </div>
    </section>

    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            SOCIAL NEWS
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="news">
        <div class="container">
            <div class="row">
                <?php
                    get_latest_news_homepage('social');
                ?>
            </div>
        </div>
    </section>
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            ENTERTAINMENT NEWS
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="news">
        <div class="container">
            <div class="row">
                <?php
                    get_latest_news_homepage('entertainment');
                ?>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>