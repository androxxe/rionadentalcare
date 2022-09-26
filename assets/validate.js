/* <![CDATA[ */
/// Jquery validate newsletter
jQuery(document).ready(function () {

	$('#newsletter_form').submit(function () {

		var action = $(this).attr('action');

		$("#message-newsletter").slideUp(750, function () {
			$('#message-newsletter').hide();

			$('#submit-newsletter')
				.after('<i class="icon-spin4 animate-spin loader"></i>')
				.attr('disabled', 'disabled');

			$.post(action, {
					email_newsletter: $('#email_newsletter').val()
				},
				function (data) {
					document.getElementById('message-newsletter').innerHTML = data;
					$('#message-newsletter').slideDown('slow');
					$('#newsletter_form .loader').fadeOut('slow', function () {
						$(this).remove()
					});
					$('#submit-newsletter').removeAttr('disabled');
					if (data.match('success') != null) $('#newsletter_form').slideUp('slow');

				}
			);

		});

		return false;

	});

});
jQueryx(document).on('ready', function () {

			// Your custom validation code here, return false if invalid.
			elmTanggal = this.GetElements('tgl_berakhir');
			var CurrentDate = new Date();
			CurrentDate = ew_ParseDate(CurrentDate, 1);
			var SelectedDate = new Date($('#tgl_berakhir').val());
			SelectedDate = ew_ParseDate(SelectedDate, 1);
			if (SelectedDate < CurrentDate) {
				return this.OnError(elmTanggal, 'Tanggal Mulai harus lebih besar atau sama dengan tanggal hari ini.');
			}
			return true;
		}
		// Jquery validate form contact
		jQuery(document).on('ready', function () {

			$('#contactform').submit(function () {

				var action = $(this).attr('action');

				$("#message-contact").slideUp(750, function () {
					$('#message-contact').hide();

					$('#submit-contact')
						.after('<i class="icon-spin4 animate-spin loader"></i>')
						.attr('disabled', 'disabled');

					$.post(action, {
							name_contact: $('#name_contact').val(),
							lastname_contact: $('#lastname_contact').val(),
							email_contact: $('#email_contact').val(),
							phone_contact: $('#phone_contact').val(),
							message_contact: $('#message_contact').val(),
							verify_contact: $('#verify_contact').val()
						},
						function (data) {
							document.getElementById('message-contact').innerHTML = data;
							$('#message-contact').slideDown('slow');
							$('#contactform .loader').fadeOut('slow', function () {
								$(this).remove()
							});
							$('#submit-contact').removeAttr('disabled');
							if (data.match('success') != null) $('#contactform').slideUp('slow');

						}
					);

				});
				return false;
			});
		});

		/* ]]> */