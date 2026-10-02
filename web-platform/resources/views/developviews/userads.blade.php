<div class="items-container games-container">
    <h2 style="margin-bottom: 15px;">User Ads</h2>
    <span id="verifiedEmail" style="display:none"></span> <span id="assetLinks" style="display:none" data-asset-links-enabled="True"></span>
    @forelse ($assets as $asset)
    <table class="item-table" data-item-id="{{ $asset->id }}" data-type="asset" data-universeid="{{ $asset->id }}">
        <tbody>
            <tr>
                <td class="image-col"><a href="/{{ $asset->target_slug }}-item?id={{ $asset->target_id_val }}" class="item-image"> <img src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" alt="{{ $asset->name }}"> </a></td>
                <td class="name-col">
                    <span class="title notranslate">{{ $asset->name }} (for <a href="/{{ $asset->target_slug }}-item?id={{ $asset->target_id_val }}">{{ $asset->target_name }}</a>)</span>
                    <table class="details-table">
                        <tbody>
                            <tr>
                                <td class="totals-label" style="width:115px">Impressions:<span>{{ $asset->impressions }}</span></td>
                                <td class="totals-label" style="width:115px">Clicks:<span>{{ $asset->clicks }}</span></td>
                                <td class="totals-label" style="width:115px">Bid:<span>{{ $asset->bid_amount }}</span></td>
                            </tr>
                            <tr>
                                <td class="totals-label">Total Impr:<span>{{ $asset->impressions_last_run }}</span></td>
                                <td class="totals-label">Total Clicks:<span>{{ $asset->clicks_last_run }}</span></td>
                                <td class="totals-label">Total Bid:<span>{{ $asset->bid_amount_last_run }}</span></td>
                            </tr>
                            <tr>
                                <td class="activate-cell">
                                    <a class="{{ $asset->bid_amount > 0 ? 'place-active' : 'place-inactive' }} toggle-bid" href="#" data-bid-target="bidPanel{{ $asset->ad_id }}">{{ $asset->bid_amount > 0 ? 'Running' : 'Paused' }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="bidPanel{{ $asset->ad_id }}" class="bid-panel" style="display:none; margin-top:8px; position:absolute; left:505px;">
                        <div class="userad-bid-form">
                            <div style="display:flex; gap:5px; align-items:baseline;">
                                <b>Bid in Bytes:</b>
                                <input type="number" class="userad-bid-amount" min="10" value="10" style="width:80px;">
                                <a href="#" class="btn-small btn-primary userad-bid-confirm" data-ad-id="{{ $asset->ad_id }}">Bid</a>
                                <a href="#" class="btn-small btn-negative userad-bid-cancel">Cancel</a>
                            </div>
                        </div>
                        <label class="bid-error" style="display:none;"><span style="color:red;" class="errorin"></span></label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    @unless ($loop->last)
    <div class="separator"></div>
    @endunless
    @empty
    <p>You haven't created any advertisements yet.</p>
    @endforelse
</div>
<script type="text/javascript">
document.querySelectorAll('.toggle-bid').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var panel = document.getElementById(this.dataset.bidTarget);
        panel.style.display = panel.style.display === 'none' ? '' : 'none';
    });
});
document.querySelectorAll('.userad-bid-confirm').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        var adId = this.dataset.adId;
        var panel = this.closest('.bid-panel');
        var input = panel.querySelector('.userad-bid-amount');
        var errorWrap = panel.querySelector('.bid-error');
        var errorSpan = errorWrap.querySelector('.errorin');
        errorWrap.style.display = 'none';
        var bidAmount = parseInt(input.value, 10);
        if (isNaN(bidAmount) || bidAmount < 10) {
            errorSpan.textContent = 'Enter a valid bid amount (min 10).';
            errorWrap.style.display = '';
            return;
        }
        btn.disabled = true;
        fetch('/My/UpdateAdBid.ashx', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ adId: adId, bidAmount: bidAmount }),
        })
        .then(r => r.json())
        .then(data => {
            btn.disabled = false;
            if (data.success === true) {
                var runningLink = document.querySelector('.toggle-bid[data-bid-target="bidPanel' + adId + '"]');
                if (runningLink) runningLink.textContent = data.bid_amount > 0 ? 'Running' : 'Paused';
                panel.style.display = 'none';
            } else {
                errorSpan.textContent = data.message || 'Failed to update bid.';
                errorWrap.style.display = '';
            }
        })
        .catch(() => {
            btn.disabled = false;
            errorSpan.textContent = 'Network error.';
            errorWrap.style.display = '';
        });
    });
});
document.querySelectorAll('.userad-bid-cancel').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        this.closest('.bid-panel').style.display = 'none';
    });
});
</script>