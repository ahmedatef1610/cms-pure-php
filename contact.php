<?php ob_start() ?>
<?php $pageTitle = 'Contact' ?>

<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<?php  

    if(isset($_POST['submit'])){

        $email= $_POST['email'];
        $subject= $_POST['subject'];
        $body= $_POST['body'];
        $to="ahmedatef1610@gmail.com";

        $header = $email;

        mail($to,$subject,$body,$header);

    }

?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>

                        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" id="contact-form">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="Enter your subject">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-contact" class="btn btn-custom btn-lg btn-block"
                                value="submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php";?>
    <?php ob_end_flush() ?>