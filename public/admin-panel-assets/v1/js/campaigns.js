$('#notification_type').on('change', function () {
    if ($(this).val() == '2' || $(this).val() == '1') {
        $('.subject_dev').fadeIn();
    } else {
        $('.subject_dev').fadeOut();
    }
});
$('#sent_type').on('change', function () {
    if ($(this).val() == '2') {
        $('#start_date_div').fadeIn();
        $('#schedule_type_dev').fadeIn();
        $('#end_date_div').fadeIn();
        $('#Id-Start_date').val('');
        $('#Id-End_date').val('');
        $('#Id-Schedule_type').val('');
        $('#days_of_week').val('');

    } else {
        $('#start_date_div').fadeOut();
        $('#days_of_week_dev').fadeOut();
        $('#schedule_type_dev').fadeOut();
        $('#end_date_div').fadeOut();
        $('#Id-Start_date').val('');
        $('#Id-End_date').val('');
        $('#Id-Schedule_type').val('');
        $('#days_of_week').val('');
    }
});
$('#user_type').on('change', function () {
    if ($(this).val() == '3') {
        $('#user_id').val('');
        $('#vendor_id').val('');
        $('#user_dev').fadeOut();
        $('#vendor_dev').fadeIn();

    }
    if ($(this).val() == '2') {
        $('#user_id').val('');
        $('#vendor_id').val('');
        $('#user_dev').fadeIn();
        $('#vendor_dev').fadeOut();
    }
    if ($(this).val() == '1') {
        $('#user_id').val('');
        $('#vendor_id').val('');
        $('#user_dev').fadeOut();
        $('#vendor_dev').fadeOut();
    }
});

$('#schedule_type').on('change', function () {
    if ($(this).val() === '2') {
        $('#days_of_week_dev').fadeIn();
        $('#Id-Start_date').val('');
        $('#Id-End_date').val('');
        $('#days_of_week').val('');
    } else {
        $('#days_of_week_dev').fadeOut();
        $('#Id-Start_date').val('');
        $('#Id-End_date').val('');
        $('#days_of_week').val('');
    }
});
