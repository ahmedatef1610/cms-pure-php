<?php
//1
function insert_categories(){
    global $connection;
    if ( isset( $_POST['submit'] ) ) {
        $cat_title = $_POST['cat_title'];
        if($cat_title=="" || empty($cat_title)){
            echo "this field should not be empty";
        }
        else{
            // $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
            // $create_category_query = mysqli_query( $connection, $query );

            $query = "INSERT INTO categories(cat_title) VALUE (?)";
            $stmt = mysqli_prepare($connection,$query);
            mysqli_stmt_bind_param($stmt,"s",$cat_title);
            mysqli_stmt_execute($stmt);

            if(!$stmt){
                die("QUERY FAILED ".mysqli_error($connection));
            }else{
                mysqli_stmt_close($stmt);
            }
        }
    }
}
//2
function findAllCategories() {
    global $connection;
    $query = 'SELECT * FROM categories';
    $select_categories = mysqli_query( $connection, $query );
    while( $row = mysqli_fetch_assoc( $select_categories ) ) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo
        "
            <tr>
                <td>{$cat_id}</td>
                <td>{$cat_title}</td>
                <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
            </tr>
        ";
    }
}
//3
function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query( $connection, $query );
        if( $delete_query ) {
            header("location:categories.php");
        }
        else{
            die("QUERY FAILED ".mysqli_error($connection));
        }
    }
}    
//4
?>