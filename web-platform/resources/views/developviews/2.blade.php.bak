										<table class="section-header-2">
											<tbody>
												<tr>
													<td class="content-title">
														<div class="header-together">
														<h2 class="header-text">Create a T-Shirt</h2>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
    									<div class="col-12">
        									<div class="ms-4 me-4 mt-4">
            									<p>Find your image: <input name="tshirtItem" accept="png" id="itemImage" type="file"></p>
            									<p>T-Shirt Name: <input style="margin-left: 28px;" id="itemName" type="text" class="inputItemName-0-2-57"></p>
            									<div class="header-together" style="margin-left: 10px;"><a href="#" id="CreateTeeShirt" class="btn-medium btn-primary">Upload</a>
			    									<div class="status-confirm lunarix-message-confirm" style="display: none;"></div></div>
        									</div>
    									</div>
										<div class="items-container">
										<h2 style="margin-top: 15px; margin-bottom: 15px;">T-Shirts</h2>
											<span id="verifiedEmail" style="display:none"></span> <span id="assetLinks" style="display:none" data-asset-links-enabled="True"></span>
											@forelse ($assets as $asset)
											<table class="item-table" data-item-id="{{ $asset->id }}" data-type="asset" data-universeid="{{ $asset->id }}">
												<tbody>
													<tr>
														<td class="image-col"><a href="/{{ $asset->getSlug() }}-item?id={{ $asset->id }}" class="item-image"> <img src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" alt="{{ $asset->name }}"> </a></td>
														<td class="name-col">
															<a class="title" href="/{{ $asset->getSlug() }}-item?id={{ $asset->id }}">{{ $asset->name }}</a>
															<table class="details-table">
																<tbody>
																	<tr>
																		<td class="item-date"><span>Updated: {{ $asset->updated_at->format('n/j/Y') }}</span></td>
																	</tr>
																</tbody>
															</table>
														</td>
														<td class="stats-col">
															<div class="totals-label">Total Sales:<span>{{ $asset->visits ?? 0 }}</span></div>
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
											<p>You haven't created any items yet.</p>
											@endforelse
										</div>
<script type="text/javascript">
$(document).ready(function () {
    function getQueryParam(name) {
        var params = new URLSearchParams(window.location.search);
        return params.get(name);
    }
    $('#CreateTeeShirt').on('click', function (e) {
        e.preventDefault();
        var fileInput = $('#itemImage')[0];
        var itemName = $('#itemName').val().trim();
        var viewId = getQueryParam('View');
        var $statusError = $('.status-error');
        var $statusConfirm = $('.status-confirm');
        var $uploadBtn = $(this);
        $statusError.hide();
        $statusConfirm.hide();
        if (!fileInput.files || fileInput.files.length === 0 || itemName === '') {
            if ($statusError.length === 0) {
                $('<div class="status-error lunarix-message-error">Please select a file and enter a T-Shirt name.</div>')
                    .insertAfter($uploadBtn);
            } else {
                $statusError.text('Please select a file and enter a T-Shirt name.').show();
            }
            return;
        }
        $uploadBtn.hide();
        var $progress = $('<img src="images/Accounts/ProgressIndicator.gif" alt="Uploading..." class="upload-progress-indicator">');
        $uploadBtn.after($progress);
        var formData = new FormData();
        formData.append($(fileInput).attr('name'), fileInput.files[0]);
        formData.append('itemName', itemName);
        formData.append('type', viewId);
        $.ajax({
            url: $uploadBtn.data('upload-url') || '/api/upload',
            type: 'POST',
		    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $progress.remove();
                $uploadBtn.show();
                if (response && response.success) {
                    $statusConfirm.text('T-Shirt successfully created!').show();
                    $statusError.hide();
                    $('#itemImage').val('');
                    $('#itemName').val('');
                } else {
                    var errorMsg = (response && response.message) ? response.message : 'An error occurred while creating the T-Shirt.';
                    if ($statusError.length === 0) {
                        $('<div class="status-error lunarix-message-error">' + errorMsg + '</div>')
                            .insertAfter($uploadBtn);
                    } else {
                        $statusError.text(errorMsg).show();
                    }
                    $statusConfirm.hide();
                }
            },
            error: function (xhr) {
                $progress.remove();
                $uploadBtn.show();
                var errorMsg = 'An error occurred while creating the T-Shirt.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                if ($statusError.length === 0) {
                    $('<div class="status-error lunarix-message-error">' + errorMsg + '</div>')
                        .insertAfter($uploadBtn);
                } else {
                    $statusError.text(errorMsg).show();
                }
                $statusConfirm.hide();
            }
        });
    });
});
</script>