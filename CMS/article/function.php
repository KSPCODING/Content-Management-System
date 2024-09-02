<!-- @import jquery & sweet alert  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 

    //Connection to DB
    function connection_db() {
        $con = new mysqli('localhost', 'root', '', 'cms');
        return $con;
    }

    //Get website logo 
    function get_website_logo($type) {
        $sql = " SELECT * FROM `tbl_website_logo` WHERE `status` = '$type'";
        $rs  = connection_db()->query($sql);
        $row = mysqli_fetch_assoc($rs);
        $thumbnail = '../admin/assets/image/'.$row['thumbnail'];
        return $thumbnail;
    }

    //Get trending News
    function get_trending_news() {
        $sql = " SELECT * FROM `tbl_news` ORDER BY id DESC LIMIT 6 ";
        $rs  = connection_db()->query($sql);
        while($row = mysqli_fetch_assoc($rs)) {
            echo '
                <i class="fas fa-angle-double-right"></i>
                <a href="news-detail.php?id='.$row['id'].'">'.$row['title'].' </a>&ensp;
            ';
        }
    }

    //Get News Detail
    function get_news_detail($id) {
        $sql = " SELECT * FROM `tbl_news` WHERE id = $id ";
        $rs  = connection_db()->query($sql);
        $row = mysqli_fetch_assoc($rs);
        return $row;
    }

    //Get related news
    function get_related_news($id, $news_type) {
        $sql = " SELECT * FROM `tbl_news` WHERE `news_type` = '$news_type' AND `id` NOT IN ($id) ORDER BY id DESC LIMIT 2";
        $rs  = connection_db()->query($sql);
        while( $row = mysqli_fetch_assoc($rs)) {
            echo '
            <figure>
                <a href="news-detail.php?id='.$row['id'].'">
                    <div class="thumbnail">
                        <img src="../admin/assets/image/'.$row['thumbnail'].'" style="width:350px; height:200px; object-fit:cover;">
                    </div>
                    <div class="detail">
                        <h3 class="title">'.$row['title'].'</h3>
                        <div class="date">'.$row['created_at'].'</div>
                        <div class="description">'.$row['description'].'</div>
                    </div>
                </a>
            </figure>
            ';
        }
    }

    //Update Viewer
    function update_viewer($id, $current_viewer) {
        $total = $current_viewer + 1;
        $sql   = " UPDATE `tbl_news` SET `viewer`= '$total' WHERE id = $id ";
        $rs    = connection_db()->query($sql);
    }

    //Get Top1 Popular News
    function get_top_1_popular_news() {
        $sql = "SELECT * FROM `tbl_news` ORDER BY viewer DESC LIMIT 1";
        $rs  = connection_db()->query($sql);
        $row = mysqli_fetch_assoc($rs);
        return $row;
    }

    //Get Top2 popular News
    function get_top_2_popular_news($id) {
        $sql = "SELECT * FROM `tbl_news` WHERE id NOT IN($id) ORDER BY viewer DESC LIMIT 2";
        $rs  = connection_db()->query($sql);
        while($row = mysqli_fetch_assoc($rs)) {
            echo '
                <div class="col-12">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumbnail'].'" width="100%">
                                <div class="title">'.$row['title'].'</div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }

    //Get Latest News on Homepage
    function get_latest_news_homepage($news_type) {
        $sql = "SELECT * FROM `tbl_news` WHERE news_type = '$news_type' ORDER BY id DESC LIMIT 6";
        $rs  = connection_db()->query($sql);
        while($row = mysqli_fetch_assoc($rs)) {
            echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumbnail'].'" width="100%">
                                <div class="title">'.$row['title'].'</div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }

    //Get List News
    function get_list_news($news_type, $category, $page, $post_per_page) {

        if(!empty($page)) {
            $offset = ($page - 1) * $post_per_page;
        }
        else {
            $offset = 0;
        }

        $sql = "SELECT * FROM `tbl_news` WHERE news_type = '$news_type' AND category = '$category' ORDER BY id DESC LIMIT $offset, $post_per_page";
        $rs  = connection_db()->query($sql);
        while($row = mysqli_fetch_assoc($rs)) {
            echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumbnail'].'" width="100%">
                            </div>
                            <div class="detail">
                                <h3 class="title">'.$row['title'].'</h3>
                                <div class="date">'.$row['created_at'].'</div>
                                <div class="description">'.$row['description'].'</div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }
    // Get List Technology
    function get_list_techno($news_type, $category, $page, $post_per_page)
    {

        if (!empty($page)) {
            $offset = ($page - 1) * $post_per_page;
        } else {
            $offset = 0;
        }

        $sql = "SELECT * FROM `tbl_news` WHERE news_type = '$news_type' AND category = '$category' ORDER BY id DESC LIMIT $offset, $post_per_page";
        $rs  = connection_db()->query($sql);
        while ($row = mysqli_fetch_assoc($rs)) {
            echo '
                    <div class="col-4">
                        <figure>
                            <a href="news-detail.php?id=' . $row['id'] . '">
                                <div class="thumbnail">
                                    <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="100%">
                                </div>
                                <div class="detail">
                                    <h3 class="title">' . $row['title'] . '</h3>
                                    <div class="date">' . $row['created_at'] . '</div>
                                    <div class="description">' . $row['description'] . '</div>
                                </div>
                            </a>
                        </figure>
                    </div>
                ';
        }
    }

    // Get List Social
    function get_list_social($news_type, $category, $page, $post_per_page)
    {

        if (!empty($page)) {
            $offset = ($page - 1) * $post_per_page;
        } else {
            $offset = 0;
        }

        $sql = "SELECT * FROM `tbl_news` WHERE news_type = '$news_type' AND category = '$category' ORDER BY id DESC LIMIT $offset, $post_per_page";
        $rs  = connection_db()->query($sql);
        while ($row = mysqli_fetch_assoc($rs)) {
            echo '
                    <div class="col-4">
                        <figure>
                            <a href="news-detail.php?id=' . $row['id'] . '">
                                <div class="thumbnail">
                                    <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="100%">
                                </div>
                                <div class="detail">
                                    <h3 class="title">' . $row['title'] . '</h3>
                                    <div class="date">' . $row['created_at'] . '</div>
                                    <div class="description">' . $row['description'] . '</div>
                                </div>
                            </a>
                        </figure>
                    </div>
                ';
        }
    }


    // Get List Entertainment
    function get_list_entertainment($news_type, $category, $page, $post_per_page)
    {

        if (!empty($page)) {
            $offset = ($page - 1) * $post_per_page;
        } else {
            $offset = 0;
        }

        $sql = "SELECT * FROM `tbl_news` WHERE news_type = '$news_type' AND category = '$category' ORDER BY id DESC LIMIT $offset, $post_per_page";
        $rs  = connection_db()->query($sql);
        while ($row = mysqli_fetch_assoc($rs)) {
            echo '
                <div class="col-4">
                        <figure>
                            <a href="news-detail.php?id=' . $row['id'] . '">
                                <div class="thumbnail">
                                    <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="100%">
                            </div>
                            <div class="detail">
                                <h3 class="title">' . $row['title'] . '</h3>
                                <div class="date">' . $row['created_at'] . '</div>
                                <div class="description">' . $row['description'] . '</div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }


    //Pagination News
    function pagination_news($news_type, $category, $post_per_page) {
        $sql = "SELECT COUNT(id) as total_post FROM `tbl_news` WHERE news_type = '$news_type' AND category ='$category'";
        $rs  = connection_db()->query($sql);
        $row = mysqli_fetch_assoc($rs);

        //Total Post
        $total_post = $row['total_post'];
        //Total Page
        $total_page = ceil($total_post / $post_per_page);
        for($i=1; $i<=$total_page; $i++) { 
            echo '
                <li>
                    <a href="?page='.$i.'">'.$i.'</a>
                </li>
            ';
        }

    }

    //Search News
    function search_news($search_value){
        $sql ="SELECT * FROM `tbl_news` WHERE `title` LIKE '%$search_value%'";
        $rs   = connection_db()->query($sql);
        while ($row =  mysqli_fetch_assoc($rs)) {
            echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id=' . $row['id'] . '">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="100%">
                            </div>
                            <div class="detail">
                                <h3 class="title">' . $row['title'] . '</h3>
                                <div class="date">' . $row['created_at'] . '</div>
                                <div class="description">' . $row['description'] . '</div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }
