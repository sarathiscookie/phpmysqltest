<!-- Header -->
<?php require 'includes/header.php'; ?>

<body>

<!-- Navigation -->
<?php require 'includes/navigation.php'; ?>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <?php require 'includes/sidebar.php'; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Scramble Text</h1>

            <div class="col-sm-6">
                <p id="text">According to a researcher at Cambridge University, it doesn't matter in what order the letters in a word are, the only important thing is that the first and last letter be at the right place. The rest can be a total mess and you can still read it without problem. This is because the human mind does not read every letter by itself but the word as a whole</p>
                <button type="button" class="btn btn-default" name="scramble" id="scramble">Toggle</button>

                <p id="result"></p>
            </div>

        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script>

    (function($) {
        $( "#scramble" ).toggle(function() {
            var txt     = $( "#text" ).html();
            var reverse = "reverse";

            $.ajax({
                url: 'scrambleObject.php',
                dataType: 'JSON',
                type: 'POST',
                data: { reverse: reverse, txt: txt }
            })
                .done(function( data ) {
                    if(data) {
                        $( "#result" ).html(data);
                    }
                })
                .fail(function(data, jqxhr, textStatus, error) {
                    $( "#result" ).html('<div class="alert alert-danger alert-dismissible" role="alert">\n' +
                        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n' +
                        '  <strong>Warning!</strong> Something went wrong' +
                        '</div>');
                });
        }, function() {
            var txt     = $( "#text" ).html();
            var forward = "forward";

            $.ajax({
                url: 'scrambleObject.php',
                dataType: 'JSON',
                type: 'POST',
                data: { forward: forward, txt: txt }
            })
                .done(function( data ) {
                    if(data) {
                        $( "#result" ).html(data);
                    }
                })
                .fail(function(data, jqxhr, textStatus, error) {
                    $( "#result" ).html('<div class="alert alert-danger alert-dismissible" role="alert">\n' +
                        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n' +
                        '  <strong>Warning!</strong> Something went wrong' +
                        '</div>');
                });
        });
    })(jQuery);


</script>


