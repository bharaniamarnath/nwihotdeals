(function($) {
  $(document).ready(function() {
    var noticeContainer = $('.wcv-notice-container');
    var isDelay = 'no';
    var noticeKey = noticeContainer.data('notice-key');
    var maybeSend = false;
    var dataDismiss = '';
    noticeContainer.on('click', function(event) {
      event.preventDefault();
      let allowClickOnClass = [
        'notice-dismiss',
        'wcv-dismiss-notice-delay',
        'wcv-dismiss-notice',
        'wcv-notice-link'
      ];
      let targetClassList = event.target.classList;
      let allowClick = false;
      allowClickOnClass.forEach(function(className) {
        if (targetClassList.contains(className)) {
          allowClick = true;
        }
      });

      if (!allowClick) {
        return false;
      }

      if (event.target.tagName === 'A') {
        let href = event.target.getAttribute('href');

        dataDismiss =
          event.target.getAttribute('data-dismiss') !== null
            ? event.target.getAttribute('data-dismiss')
            : '';
        maybeSend = true;
        if (href === '#') {
          isDelay = event.target.classList.contains('wcv-dismiss-notice-delay')
            ? 'yes'
            : 'no';
        } else {
          maybeSend = false;
          window.open(href, '_blank');
        }
      }

      //Ajax call to dismiss notice.
      if (maybeSend) {
        $.ajax({
          url: wcv_admin_notice.ajax_url,
          type: 'POST',
          data: {
            action: 'wcvendors_dismiss_notice',
            is_delay: isDelay,
            nonce: wcv_admin_notice.nonce,
            notice_key: noticeKey,
            data_dismiss: dataDismiss
          },
          success: function(response) {
            if (response.success) {
              noticeContainer.hide(500);
            }
          }
        });
      }
    });
  });
})(jQuery);
