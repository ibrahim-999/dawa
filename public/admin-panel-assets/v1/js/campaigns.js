$('#notification_type').on('change', function () {
    if ($(this).val() == '2') {
    $('.subject_dev').fadeIn();
} else {
    $('.subject_dev').fadeOut();
}
});
    $('#sent_type').on('change', function () {
    $('#date').val('');
    $('#time_input').val('');
    if ($(this).val() == '2') {
    $('#date_div').fadeIn();
    $('#time_div').fadeIn();
} else {
    $('#date_div').fadeOut();
    $('#time_div').fadeOut();
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
