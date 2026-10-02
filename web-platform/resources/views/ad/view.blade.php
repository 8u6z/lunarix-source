


<!DOCTYPE html>
<html>
    <head>
        <title>
            Lunarix - a kids, parents, and family activity site for building toy amusement
            parks, rc cars, clothing, and electronic devices out of construction blocks that
            are as realistic as a movie or tv show
        </title>
        <style type="text/css">
            body { margin: 0; }
            body.banner { text-align: center; }
            a
            {
                color: gray;
                text-decoration: none;
            }
            a.ad { display: inline-block; }
            body.other a.ad { display: block; }
            a.ad img
            {
                display: block;
                border: none;
            }
            a:hover { text-decoration: underline; }
        </style>
        
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___48c190c40942ad5412c56a4bf1c94b9b_m.css' />

    </head>
<body class="abp banner">
    <a class="ad" title="{{ $title }}" href="{{ $redirectUrl }}" target="_top">
        <img src="{{ $imageUrl }}" alt="advertisement" height="{{ $height }}" width="{{ $width }}">
    </a>
    <div class="ad-annotations" style="width:{{ $width }}px;">
        <span class="ad-identification">Advertisement</span>
        @if(!$isHouse && $assetId)
            <a class="BadAdButton" target="_top" href="/abusereport/ReportAd.aspx?id={{ $assetId }}&redirectUrl={{ urlencode(url()->previous()) }}" title="click to report an offensive ad">Report</a>
        @endif
    </div>
</body>
</html>