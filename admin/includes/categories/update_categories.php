<form action="<?php echo $_SERVER['REQUEST_URI']?>" method='post'>
    <div class='form-group'>
        <label for='cat-title'>Edit Category</label>
        <!-- get to edit category -->
        <?php 
            if(isset($_GET['edit'])){
            $the_cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = {$the_cat_id}";
            $select_category_id = mysqli_query( $connection, $query );
            if( $select_category_id ) {
                $row = mysqli_fetch_array($select_category_id);
                echo  "<input type='text' class='form-control' name='cat_title' value='{$row['cat_title']}'>";
            }
            else{
                die("QUERY FAILED ".mysqli_error($connection));
            }
        }
        ?>
        <!-- update edit category -->
        <?php
            if(isset($_POST['update_category'])){
                $the_cat_title = $_POST['cat_title'];

                // $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$the_cat_id}";
                // $update_query = mysqli_query( $connection, $query );

                $query = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
                $stmt = mysqli_prepare($connection,$query);
                mysqli_stmt_bind_param($stmt,"si",$the_cat_title,$the_cat_id);
                mysqli_stmt_execute($stmt);

                if( $stmt ) {
                    mysqli_stmt_close($stmt);
                    header("location:categories.php");
                }
                else{
                    die("QUERY FAILED ".mysqli_error($connection));
                }
            }
        ?> 
    </div>
    <div class='form-group'>
        <input class='btn btn-primary' type='submit' name='update_category' value='Update Category'>
    </div>
</form>

<?php 
    // echo $_SERVER['PHP_SELF']."<br>";
    // echo "<pre>";
    // echo print_r($_SERVER);
    // echo "</pre>";
?>