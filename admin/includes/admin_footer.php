</div>
    <!-- /#wrapper -->
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- editor ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
        .create(document.querySelector('#post_content'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
           // console.log(error);
        });
    </script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>

</body>

</html>
