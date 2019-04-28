<ul id="users">

</ul>
<form id="form" method="POST">
	<div>
		<label>Name</label>
		<input type="text" name="name" />
	</div>
	<button type="submit">Create</button>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		var $wrapper = $('#users');
		var $form = $('#form');

		$form.on('submit', function(e) {
			var data = $(this).serializeArray();
			$.ajax({
				url: '<?=URL_BASE?>/home/ajax-create-user',
				method: 'POST',
				data: data,
				beforeSend: function () {
					$form.find('button').prop("disabled", true);
				},
				success: function (json) {
					$form.find('input').val('');
					init();
				},
				complete: function () {
					$form.find('button').prop("disabled", false);
				}
			})
			return false;
		});

		init();

		function init() {
			$.ajax({
				url: '<?=URL_BASE?>/home/ajax-get-user',
				success: function (json) {
					$wrapper.html('');
					$.each(json, function(i, row) {
						// delete button
						var $delBtn = $('<button>x</button>');
						$delBtn.on('click', deleteEvent);

						var $span = $('<span></span>');
						$span.html(row.name);
						$span.on('click', updateEvent);

						var $item = $('<li data-id="' + row.id + '"></li>');
						$item.append($span);
						$item.append($delBtn);
						$wrapper.append($item);
					})
				}
			})
		}

		function deleteEvent(e) {
			e.preventDefault();
			var wrapper = $(this).parent('li');
			var $wapper = $(wrapper[0]);
			var id = $wapper.data('id');
			$.ajax({
				url: '<?=URL_BASE?>/home/ajax-delete-user?id=' + id,
				method: 'POST',
				success: function (json) {
					init();
				},
			})
		}

		function updateEvent(e) {
			e.preventDefault();

			var wrapper = $(this).parent('li');
			var $wapper = $(wrapper[0]);
			var id = $wapper.data('id');
			
			$oriThis = $(this);
			$input = $('<input type="text" />');
			$input.val($(this).text());
			$input.on('keyup', function (e) {
				if (e.which == 13) {
					$.ajax({
						url: '<?=URL_BASE?>/home/ajax-update-user?id=' + id,
						method: 'POST',
						data: {
							name: $input.val(),
						},
						success: function (json) {
							init();
						},
					})
				}
			})
			$(this).replaceWith($input);
			$input.focus();
		}
	});
</script>