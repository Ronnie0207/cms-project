<?php

if(isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_query = mysqli_query($connection, $query);
                                
                while($row = mysqli_fetch_assoc($select_users_query)) {
                    $user_id = escape($row['user_id']);
                    $username = escape($row['username']);
                    $user_password = escape($row['user_password']);
                    $user_firstname = escape($row['user_firstname']);
                    $user_lastname = escape($row['user_lastname']);
                    $user_email = escape($row['user_email']);
                    $user_image = escape($row['user_image']);
                    $user_role = escape($row['user_role']);
                }
}

if(isset($_POST['edit_user'])) {
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    // $post_date = date('d-m-y');

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$the_user_id} ";

    $edit_user_query = mysqli_query($connection, $query);
    confirmQuery($edit_user_query);

}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber"><?php echo $user_role; ?></option>
                <?php 

                if($user_role == 'Admin') {
                    echo "<option value='Subscriber'>Subscriber</option>";
                } else {
                    echo "<option value='Admin'>Admin</option>";
                }
                                
                ?>        
        </select>

    </div>

    <!-- <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div> -->
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="title">Email</label>
        <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>