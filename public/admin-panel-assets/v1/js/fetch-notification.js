$.ajax({
    url: route,
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

            var notificationData = response['notifications']['data'];
            var notificationCount = notificationData.length;
            $('#notification_count').text(notificationCount);
        } else {
            console.error('Invalid response format. Expected an array of notifications.');
        }
    },
    error: function (xhr, status, error) {
        // Handle error if any
    }
});
