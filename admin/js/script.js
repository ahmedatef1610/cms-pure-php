$(document).ready(function () {
  //1
  $("#selectAllBoxes").click(function (e) {
    if (this.checked) {
      $(".checkBoxes").each(function (indexInArray, valueOfElement) {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function (indexInArray, valueOfElement) {
        this.checked = false;
      });
    }
  });
  //2
  // var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  // $("body").prepend(div_box);
  // $("#load-screen").delay(700).fadeOut(600, function () {
  //   $(this).remove();
  // });
  //3
  $(".delete_link").click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    
    let id = $(this).attr("rel");
    //let delete_url = `posts.php?delete=${id}`; 

    // $(".modal_delete_link").attr("href",delete_url);

    $(".modal_delete_link").attr("value",id);

    $("#exampleModal").modal("show");

    //alert(delete_url);
  });
  //4
});

$(".confirm").click(function () {
  return confirm("Are You Sure?");
});

function loadUsersOnline() {
  $.get("./includes/admin_functions.php?usersOnline=result", function (data,textStatus,jqXHR) {
    $(".usersOnline").text(data);
  });
}

loadUsersOnline();
setInterval(function () {
  loadUsersOnline();
}, 1000);
