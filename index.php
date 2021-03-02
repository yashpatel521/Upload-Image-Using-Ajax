<!doctype html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Ajax File Upload with jQuery and PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <?php date_default_timezone_set('Asia/Kolkata'); ?>
    <?php echo date("Y_m_d_H_i_s_"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="#" target="_blank"><img src="" width="80px" />Ajax File Uploading with Database
                        MySql</a></h1>
                <hr>
                <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">NAME</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="email">EMAIL</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                            required />
                    </div>
                    <input id="uploadImage" type="file" accept="image/*" name="image" />
                    <div id="preview"><img id="img_preview" src="" alt="None" width="100px" height="100px" /></div><br>
                    <input class="btn btn-success" type="submit" value="Upload">
                </form>
                <div id="err"></div>
                <hr>
            </div>
        </div>
    </div>
</body>
<script>
$(document).ready(function(e) {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#uploadImage").change(function() {
        readURL(this);
    });
    $("#form").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "ajaxupload.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                //$("#preview").fadeOut();
                $("#err").fadeOut();
            },
            success: function(data) {
                if (data == 'invalid') {
                    // invalid file format.
                    $("#err").html("Invalid File !").fadeIn();
                } else {
                    // view uploaded file.
                    // $("#preview").html(data).fadeIn();
                    window.location.reload();
                }
            },
            error: function(e) {
                $("#err").html(e).fadeIn();
            }
        });
    }));
});
</script>

</html>