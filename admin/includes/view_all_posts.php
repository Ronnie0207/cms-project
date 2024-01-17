<?php

if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options) {
            case 'publish':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_to_published_status = mysqli_query($connection, $query);
                confirmQuery($update_to_published_status);

                break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $update_to_draft_status = mysqli_query($connection, $query);
                    confirmQuery($update_to_draft_status);
    
                    break;

                    case 'delete':
                        $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                        $update_to_delete_status = mysqli_query($connection, $query);
                        confirmQuery($update_to_delete_status);
        
                        break;
        }
    }
}

?>



<form action="" method="post">
<table class="table table-bordered table-hover">

<div id="bulkOptionContainer" class="col-xs-4">
    <select name="bulk_options" class="form-control" id="">
        <option value="">Select Options</option>
        <option value="publish">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
    </select>
</div>

<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
</div>
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
                $query = "SELECT * FROM posts";
                $select_posts = mysqli_query($connection, $query);
                                
                while($row = mysqli_fetch_assoc($select_posts)) {
                    $post_id = escape($row['post_id']);
                    $post_author = escape($row['post_author']);
                    $post_title = escape($row['post_title']);
                    $post_category_id = escape($row['post_category_id']);
                    $post_status = escape($row['post_status']);
                    $post_image = escape($row['post_image']);
                    $post_tags = escape($row['post_tags']);
                    $post_comments = escape($row['post_comment_count']);
                    $post_date= escape($row['post_date']);

                    echo "<tr>";

                    ?>

                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

                    <?php
                    echo "<td>$post_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_title</td>";

                    $query = "SELECT * FROM category WHERE cat_id = {$post_category_id}";
                    $select_category_id = mysqli_query($connection, $query);
                                
                    while($row = mysqli_fetch_assoc($select_category_id)) {
                        $cat_id = escape($row['cat_id']);
                        $cat_title = escape($row['cat_title']);
                    

                    echo "<td>{$cat_title}</td>";
                    
                    }


                    echo "<td>$post_status</td>";
                    echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                    echo "<td>$post_tags</td>";
                    echo "<td>$post_comments</td>";
                    echo "<td>$post_date</td>";
                    echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                    echo "</tr>";

                }
        ?>
                        


                            
                        
</tbody>

</table>
</form>

<?php

if(isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);

    header("Location: posts.php");
}

?>