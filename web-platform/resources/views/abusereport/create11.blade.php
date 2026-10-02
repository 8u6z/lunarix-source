@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___d7f658c4695ed776947e7d072c17ef0f_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___bf085a0aa25ce4df4c0be2fa1dc7e79a_m.css">
@endpush

@section('content')
@include('layout.header')
@include('layout.header')
<div id="navContent" class="nav-content  nav-no-left" style="margin-left: 0px; width: 100%;">
        <div class="nav-content-inner">
            <div class="container-main    ">
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div class="SystemAlert"><div class="lrx-alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>
        @include('layout.body.alert')
        <div class="content  ">
                    <div class="header">
                    <h1 style="">Report Abuse</h1>
                    </div>
        <div class="ErrorReporting">
                    <p>
                        You are reporting {{ $subjectLabel }}
                        #{{ $targetId }}@if($targetName) ({{ $targetName }})@endif.
                    </p>

                    @if($errors->any())
                        <div class="errorStatusBar">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="/abusereport/{{ $subject }}?id={{ $targetId }}&redirectUrl={{ urlencode($redirectUrl) }}">
                        @csrf
                        <input type="hidden" name="target_id" value="{{ $targetId }}">
                        <input type="hidden" name="redirectUrl" value="{{ $redirectUrl }}">

                        <p>
                            <label class="Label" for="reportType">Type of abuse</label><br>
                            <select id="reportType" name="report_type" class="TextBox" required>
                                @foreach($reportTypes as $type)
                                    <option value="{{ $type }}" @selected(old('report_type') === $type)>{{ $type }}</option>
                                @endforeach
                            </select>
                        </p>

                        <p>
                            <label class="Label" for="reportComment">Short description</label><br>
                            <textarea id="reportComment" name="comment" class="TextBox" rows="6" cols="60" maxlength="1000">{{ old('comment') }}</textarea>
                        </p>

                        <div class="YesNoButtons">
                            <a href="{{ $redirectUrl }}" class="btn-small btn-neutral">Cancel</a>
                            <button type="submit" class="btn-small btn-primary">Submit Report</button>
                        </div>
                    </form>
                </div>
            </div>

@include('layout.footerlegacy')
@endsection
