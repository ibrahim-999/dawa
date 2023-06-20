$('#notification_type').on('change', function () {
    if ($(this).val() == 'email') {
        $('.subject_dev').fadeIn();
    } else {
        $('.subject_dev').fadeOut();
    }
});
$('#sent_type').on('change', function () {
    $('#date').val('');
    $('#time_input').val('');
    if ($(this).val() == 'schedule') {
        $('#date_div').fadeIn();
        $('#time_div').fadeIn();
    } else {
        $('#date_div').fadeOut();
        $('#time_div').fadeOut();
    }
});

$('#user_type').on('change', function () {
    if ($(this).val() == 'vendors') {
        $('#user_id').val('');
        $('#vendor_id').val('');
        $('#user_dev').fadeOut();
        $('#vendor_dev').fadeIn();

    }
    if ($(this).val() == 'users') {
        $('#user_id').val('');
        $('#vendor_id').val('');
        $('#user_dev').fadeIn();
        $('#vendor_dev').fadeOut();
    }
    if ($(this).val() == 'all') {
        $('#user_id').val('');
        $('#vendor_id').val('');
        $('#user_dev').fadeOut();
        $('#vendor_dev').fadeOut();
    }
});
