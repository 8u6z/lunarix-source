									<table class="section-header-2">
										<tbody>
											<tr>
												<td class="content-title">
													<div class="header-together">
													<h2 class="header-text">Create a Video</h2><p>Don't know how? <a href="#" download>Click here</a></p>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="col-12">
										<div class="ms-4 me-4 mt-4">
											<p>Only .mp4 video files lower than 10MBs are allowed.</p>
											<p>Find your .mp4 file: <input name="videoItem" accept="video/mp4" id="itemVideo" type="file"></p>
											<p>Thumbnail: <input name="videoThumbItem" accept="image/png" id="itemVideoThumb" type="file"></p>
											<p>Video Name: <input style="margin-left: 28px;" id="itemName" type="text" class="inputItemName-0-2-57"></p>
											<div class="header-together" style="margin-left: 10px;"><a href="#" id="CreateVideo" data-upload-url="/api/video/upload" class="btn-medium btn-primary">Upload</a>
												<div class="status-confirm lunarix-message-confirm" style="display: none;"></div></div>
										</div>
									</div>
									<div class="items-container games-container">
									<h2 style="margin-top: 15px; margin-bottom: 15px;">Videos</h2>
										@forelse ($videos as $video)
										<table class="item-table" data-item-id="{{ $video->id }}" data-type="video">
											<tbody>
												<tr>
													<td class="image-col"><a href="/videos/{{ $video->id }}/view" class="game-image"> <img src="{{ $video->display_thumbnail_url }}" alt="{{ $video->name }}"> </a></td>
													<td class="name-col">
														<a class="title" href="/videos/{{ $video->id }}/view">{{ $video->name }}</a>
														<table class="details-table">
															<tbody>
																<tr>
																	<td class="item-date"><span>Updated: {{ $video->updated_at->format('n/j/Y') }}</span></td>
																</tr>
															</tbody>
														</table>
													</td>
													<td class="stats-col">
														<div class="totals-label">Total Views:<span>{{ $video->views()->count() }}</span></div>
														<div class="totals-label">Last 7 days:<span>0</span></div>
													</td>
													<td class="menu-col">
														<div class="gear-button-wrapper"><a href="#" class="gear-button"></a></div>
													</td>
												</tr>
											</tbody>
										</table>
										@unless ($loop->last)
										<div class="separator"></div>
										@endunless
										@empty
										<p>You haven't created any videos yet.</p>
										@endforelse
									</div>
<script type="text/javascript">
$(document).ready(function () {
    var MAX_VIDEO_BYTES = 10 * 1024 * 1024;
    $('#CreateVideo').on('click', function (e) {
        e.preventDefault();
        var videoInput = $('#itemVideo')[0];
        var thumbInput = $('#itemVideoThumb')[0];
        var itemName = $('#itemName').val().trim();
        var $statusConfirm = $('.status-confirm');
        var $uploadBtn = $(this);
        var $statusError = $uploadBtn.siblings('.status-error');
        function showError(msg) {
            if ($statusError.length === 0) {
                $statusError = $('<div class="status-error lunarix-message-error"></div>').insertAfter($uploadBtn);
            }
            $statusError.text(msg).show();
        }
        $statusError.hide();
        $statusConfirm.hide();
        if (!videoInput.files || videoInput.files.length === 0 || itemName === '') {
            showError('Please select a video file and enter a name.');
            return;
        }
        if (videoInput.files[0].size > MAX_VIDEO_BYTES) {
            showError('Video file must be under 10MB.');
            return;
        }
        $uploadBtn.hide();
        var $progress = $('<img src="images/Accounts/ProgressIndicator.gif" alt="Uploading..." class="upload-progress-indicator">');
        $uploadBtn.after($progress);

        var formData = new FormData();
        formData.append('videoItem', videoInput.files[0]);
        if (thumbInput.files && thumbInput.files.length > 0) {
            formData.append('videoThumbItem', thumbInput.files[0]);
        }
        formData.append('itemName', itemName);
        $.ajax({
            url: $uploadBtn.data('upload-url') || '/api/video/upload',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            contentType: false,
            success: function (response) {
                $progress.remove();
                $uploadBtn.show();
                if (response && response.success) {
                    $statusConfirm.text('Video successfully created!').show();
                    $statusError.hide();
                    location.reload();
                } else {
                    showError((response && response.message) ? response.message : 'An error occurred while creating the video.');
                    $statusConfirm.hide();
                }
            },
            error: function (xhr) {
                $progress.remove();
                $uploadBtn.show();
                var errorMsg = 'An error occurred while creating the video.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                showError(errorMsg);
                $statusConfirm.hide();
            }
        });
    });
});
</script>