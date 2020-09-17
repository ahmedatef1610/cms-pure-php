<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = 'SELECT * FROM users ORDER BY user_id ASC';

        $select_users = mysqli_query( $connection, $query );
        while( $row = mysqli_fetch_assoc( $select_users ) ) {

            $user_id        = $row['user_id'];
            $user_name      = $row['user_name'];
            $user_password  = $row['user_password'];
            $user_email     = $row['user_email'];
            $user_firstname = $row['user_firstname'];
            $user_lastname  = $row['user_lastname'];
            $user_role      = $row['user_role'];
            $user_image     = $row['user_image'];
            $user_date      = $row['user_date'];
            
            $user_timestamp = strtotime($user_date);
            $user_time = date("Y-m-d h:i:s A", $user_timestamp);
            
            echo
            "
                <tr>
                    <td>{$user_id}</td>
                    <td>{$user_name}</td>
                    <td>{$user_firstname}</td>
                    <td>{$user_lastname}</td>
                    <td>{$user_email}</td> 
                    <td>{$user_role}</td> 
                    <td>{$user_time}</td> 
                    <td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td> 
                    <td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td> 
                    <td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>
                    <td><a href='users.php?delete={$user_id}'>Delete</a></td> 
                </tr>
            ";
        }
    ?>
    </tbody>
</table>


<?php 
if(isset($_GET['change_to_admin'])){
    $the_user_id = escape($_GET['change_to_admin']);
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id}";
    $change_query = mysqli_query( $connection, $query );
    if( $change_query ) {
        header("location:users.php");
    }
    else{
        die("QUERY FAILED ".mysqli_error($connection));
    }
}
?>

<?php 
if(isset($_GET['change_to_subscriber'])){
    $the_user_id = escape($_GET['change_to_subscriber']);
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id}";
    $change_query = mysqli_query( $connection, $query );
    if( $change_query ) {
        header("location:users.php");
    }
    else{
        die("QUERY FAILED ".mysqli_error($connection));
    }
}
?>

<?php 
if(isset($_GET['delete'])){
    if ( isset( $_SESSION['user_role'] ) ) {
        if ( $_SESSION['user_role'] == 'admin' ) {
            $the_user_id = mysqli_real_escape_string($connection , $_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_query = mysqli_query( $connection, $query );
            if( $delete_query ) {
                header("location:users.php");
            }
            else{
                die("QUERY FAILED ".mysqli_error($connection));
            }
        }
    }else {
        header( 'location:../index.php' );
    }
}
?>