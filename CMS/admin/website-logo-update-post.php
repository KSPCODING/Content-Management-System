<?php 
    include('sidebar.php');
    $id = $_GET['id'];
    $sql = " SELECT * FROM `tbl_website_logo` WHERE id = $id ";
    $rs  = connection_db()->query($sql);
    $row = mysqli_fetch_assoc($rs);
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Website Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                                    <input type="hidden" name="old_thumbnail" value="<?php echo $row['thumbnail'] ?>">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-select" name="type">
                                            <option value="header">Header</option>
                                            <option value="footer">Footer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <img src="assets/image/<?php echo $row['thumbnail'] ?>">
                                    </div>                                    
                                    <div class="form-group">
                                        <label>File</label><small> (Recommend image size 200x80 Pixels for header & 120x120 Pixels for footer)</small>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="update_website_logo">Submit</button>
                                        <a href="website-logo-view-post.php" class="btn btn-success">View</a>
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