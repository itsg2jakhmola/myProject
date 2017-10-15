 var base_url = Laravel.basePath;
	// CSRF protection
$.ajaxSetup({
	headers : {
		'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
	}
});


// Handle notification bell
$(".nlist").on('click', function(e) {
	
	e.stopPropagation();
	var $ncount = $('a.ncount');

	if ($ncount.data('ncount') > 0)
	{
		$.post(base_url + '/api/user/shownotifications', {
      _token: Laravel.csrfToken,
    }, function(response)
		{
			if (response.code == 0)
			{
				$ncount.data('ncount', 0);
				$ncount.find('span').text(0);
			}
		});
	}
	var $this = $(this), $nscroll = $this.find('.nscroll');
	if (!$nscroll.is(':visible'))
	{
		$nscroll.show();
	} else
	{
		$nscroll.hide();
	}
	$('.nscroll').addClass('nw-nscroll');
});

$(document).on('click', function(e) {
	e.stopPropagation();
	if (!$(e.target).closest('.nw-nscroll').length)
	{
		$('.nw-nscroll').hide();
	}
});
getMessageApi();


window.setInterval(function(){
  /// call your function here
  getMessageApi();
}, 5000);


// Notifications list
function getMessageApi(){
$.getJSON(base_url + '/api/user/notifications?page=1', function(data) {
	$ul = $('ul.nscroll');
	$ul.append(data.notificationsHTML);
	$ul.data({
		'total' : data.total,
		'nextPage' : data.nextPage,
	});
	$('a.ncount').data('ncount', data.unread);
	$('a.ncount > span').text(data.unread);
});
}
// Handle notification list scroll
$('ul.nscroll').scroll(function(e) {
	if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
		var $this = $(this), url = $this.data('nextPage');

		if (url == null)
			return;

		$.getJSON(url, function(data) {
			$ul = $this;
			$ul.append(data.notificationsHTML);
			$ul.data({
				'total' : data.total,
				'nextPage' : data.nextPage,
			});
		});
	}
});

// Handle click on a single notification
$('ul.nscroll').on('click', 'li', function(e) {
	var $this = $(this), nid = $this.data('nid');
	$.post(base_url + '/api/user/readnotification', {
    _token: Laravel.csrfToken,
		nid : nid
	}, function(response) {
		if (response.code == 0) {
			// mark as read
			if ($this.hasClass('unread'))
				$this.removeClass('unread');

			// handle message read
			var data = response.data;
			if (data.callback == 'url') {
				window.location.href = data.url;
			} else {
				var content = '<div class="wpopup" style="position: relative; background: #FFF; padding: 30px; width: auto; max-width: 620px; margin: 20px auto; text-align: center;">' + data.content + '</div>';
				$.magnificPopup.open({
					items : {
						src : content,
						type : 'inline'
					}
				});
			}
		}
	});
});

//Notification Toggle setup
$(document).ready(function(){
   $(".deshboard-links.nlist .ncount").click(function(){
       $(".ncontainer").slideToggle("slow");
   });
});



