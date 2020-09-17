<?php
//0
function query($query){
    global $connection;
    return mysqli_query($connection, $query);
}

//1
function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE user_name='" . $_SESSION['user_name'] ."'");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
    }
    return false;
}

//2
function userLikedThisPost($post_id){
    $result = query("SELECT * FROM likes WHERE user_id=" .loggedInUserId() . " AND post_id={$post_id}");
    confirmQuery($result);
    return mysqli_num_rows($result) >= 1 ? true : false;
}

//3
function getPostLikes($post_id){
    $result = query("SELECT * FROM likes WHERE post_id=$post_id");
    confirmQuery($result);
    echo mysqli_num_rows($result);

}
?>