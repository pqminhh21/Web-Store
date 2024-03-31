<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent('include', 'top');
$view->loadContent('content', 'forgot-password');
$view->loadContent('include', 'tail');

?>
<script>
    $(document).ready(function() {
        $('.forgot-password').click(function(e) {
            e.preventDefault();
            let user_email = $('.user_email').val();
            $.ajax({
                url: 'app/Handle/forgotPassword.php',
                type: 'POST',
                data: {
                    user_email: user_email
                },
                success: function(data) {
                    $('.toastr_notification').html(data);
                }
            });
        });
    });
</script>
