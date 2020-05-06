<?php
include(__DIR__ . '/login.php');
?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vex-js/4.1.0/css/vex.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vex-js/4.1.0/css/vex-theme-top.min.css">

</head>

<body>
    <div>
        <button id="trigger">Click me</button>
    </div>

    <div>
        <h3>Notes</h3>

        <pre id="notes"></pre>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/vex-js/4.1.0/js/vex.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vex-js/4.1.0/js/vex.combined.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script id="rendered-js">
        vex.defaultOptions.className = 'vex-theme-top';

        function showDialog(cb) {
            
            vex.dialog.open({
                message: 'Enter notes for this context',
                input: '<textarea name="notes" rows="6", cols="80"></textarea>',
                buttons: [
                    $.extend({}, vex.dialog.buttons.YES, {
                        text: 'Save'
                    }),

                    $.extend({}, vex.dialog.buttons.NO, {
                        text: 'Cancel'
                    })
                ],


                callback: function(data) {
                    if (data) {
                        console.log(data.notes);
                        cb(data.notes);
                    }
                }
            });

        }

        $('#trigger').click(function() {
            showDialog(function(notes) {
                $('#notes').text(notes);
            });
        });

    </script>
</body>

</html>