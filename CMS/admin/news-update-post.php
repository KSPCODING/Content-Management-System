<?php 
    include('sidebar.php');
    $id = $_GET['id'];
    $news_data = preview_before_update($id);

    $social = '';
    $tech   = '';
    $sport  = '';
    $enter  = '';
    $news_type = $news_data['news_type'];
    if($news_type == 'sport')
        $sport = 'selected';
    elseif($news_type == 'technology')
        $tech = 'selected';
    elseif($news_type == 'social')
        $social = 'selected';
    else 
        $enter = 'selected';

    $national = '';
    $international = '';
    $category = $news_data['category'];
    if($category == 'national')
        $national = 'selected';
    else 
        $international = 'selected';
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $news_data['id'] ?>">
                                    <input type="hidden" name="old_thumbnail" value="<?php echo $news_data['thumbnail'] ?>">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="<?php echo $news_data['title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select class="form-select" name="news_type">
                                            <option value="sport" <?php echo $sport ?>>Sport</option>
                                            <option value="technology" <?php echo $tech ?>>Technology</option>
                                            <option value="social" <?php echo $social ?>>Social</option>
                                            <option value="entertainment" <?php echo $enter ?>>Entertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category">
                                            <option value="national" <?php echo $national ?>>National</option>
                                            <option value="international" <?php echo $international ?>>International</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <img src="assets/image/<?php echo $news_data['thumbnail'] ?>" width="200px"><br>
                                        <label>Thumbnail <small>(Recommend image size 730x415 Pixels.)</small> </label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"><?php echo $news_data['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="btn_update_news">Submit</button>
                                        <a href="news-view-post.php" class="btn btn-default">View Post</a>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>