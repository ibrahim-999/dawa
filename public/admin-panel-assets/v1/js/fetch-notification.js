$.ajax({
    url: get_route,
    type: 'GET',
    dataType: 'json',
    success: function (response) {
        var notificationList = $('#noti-scroll');
        notificationList.empty(); // Clear existing notifications

        if (Array.isArray(response['notifications']['data'])) {
            $.each(response['notifications']['data'], function (index, notification) {
                var listItem = $('<a></a>')
                    .attr('href', 'javascript:void(0);')
                    .addClass('dropdown-item notify-item');

                var notifyIcon = $('<div></div>')
                    .addClass('notify-icon bg-primary')
                    .append(
                        $('<i></i>')
                            .addClass('mdi mdi-comment-account-outline')
                    );

                var notifyDetails = $('<p></p>')
                    .addClass('notify-details')
                    .text(notification['data']['body']);

                var timeAgo = $('<small></small>')
                    .addClass('text-muted')
                    .text(moment(notification['created_at']).fromNow());

                var userMsg = $('<p></p>')
                    .append(timeAgo);

                listItem.append(notifyIcon, notifyDetails, userMsg);

                notificationList.append(listItem);
            });

             $('#notification_count').text(response['unread_notifications_count']);
        } else {
            console.error('Invalid response format. Expected an array of notifications.');
        }
    },
    error: function (xhr, status, error) {
        // Handle error if any
    }
});

$('.read-notification').on('click',function (){
     $.ajax({
        url: read_notification_route,
        type: 'GET',
        dataType: 'json',
        success: function () {
            $('#notification_count').text(0);
        }
    });});
