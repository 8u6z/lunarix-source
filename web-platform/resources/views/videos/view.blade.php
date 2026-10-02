@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___452br4cbc7337a5afeba9cc2bd101d17_m.css">
@endpush
@push('js')
<script src='https://js.lunarix.lol/10cc00d9523cce67f7bdbbb8805d84e5.js'></script>
<script src='https://js.lunarix.lol/73b46924uk97ff66166r6989832455f5.js'></script>
@endpush
@section('content')
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
                                        <div id="Leaderboard-Abp" class="abp leaderboard-abp">
                    

    <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>

                </div>
  <style>
        .content {
            max-width: 1160px;
            width: 100%;
        }
    </style>
<div style="display:flex; gap:20px; max-width:725px; margin:0 auto; align-items:flex-start;">
<div style="width:725px;">
<div class="section">
<video width="700" height="394" controls poster="{{ $video->display_thumbnail_url }}">
<source src="{{ $video->video_url }}" type="video/mp4">
</video>
</div>
<div class="section" style="display:flex; align-items:flex-start;">
<div style="flex:1;">
<h3 style="margin:5px 0;">{{ $video->name }}</h3>
<p style="margin:0;">{{ number_format($video->views_count ?? 0) }} Views | Uploaded {{ $video->created_at->format('m/d/Y') }} | By <a href="/users/{{ $video->creator_id }}/profile">{{ $video->creator->username ?? 'Unknown' }}</a> | {{ $video->visibility == 1 ? 'Public' : 'Private' }}</p>
<p style="margin:0;">{{ $video->description }}</p>
</div>
<a class="lrx-btn-secondary-xs" style="margin-left:auto;" id="follow-button" data-user-id="{{ $video->creator_id }}">Follow</a>
</div>
<!-- ripped from games view -->
<div class="section">
    <div id="AjaxCommentsContainer" class="comments-container"
         data-video-id="{{ $video->id }}"
         data-total-collection-size=""
         data-is-user-authenticated="{{ auth()->check() ? 'True' : 'False' }}">
        <h3>Comments</h3>
        <div class="AddAComment">
            <div class="comment-form">
                <div class="Avatar lunarix-avatar-image" data-user-id="{{ auth()->id() ?? -1 }}" data-image-size="small"></div>
                <form class="lrx-form-horizontal ng-pristine ng-valid" role="form">
                    <div class="lrx-form-group" style="width:calc(75% - 7px);">
                        <textarea class="form-control lrx-input-field lrx-comment-input blur" placeholder="Write a comment!" rows="1"></textarea>
                        <div class="lrx-comment-msgs">
                            <span class="lrx-comment-error lrx-text-danger"></span>
                            <span class="lrx-comment-count lrx-text-notes"></span>
                        </div>
                    </div>
                    <button type="button" class="lrx-btn-secondary-sm lrx-post-comment" style="width:auto;">Post Comment</button>
                </form>
            </div>
            <div class="comments vlist">
            </div>
            <div class="comments-item-template" style="display:none;">
                <div class="comment-item list-item">
                    <div class="comment-user list-header">
                        <div class="Avatar" data-user-id="comment-author-id" data-image-size="small"></div>
                    </div>
                    <div class="comment-body list-body">
                        <strong>username</strong>
                        <p class="comment-content list-content"> text </p>
                        <span class="lrx-text-notes">4 hours ago</span>
                    </div>
                    <div class="comment-controls">
                        <a class="lrx-comment-report-link" href="/abusereport/comment?id=%CommentID&amp;redirectUrl=%PageURL" title="Report Abuse"><span class="lrx-icon-flag"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="AjaxCommentsMoreButtonContainer">
        <button type="button" class="lrx-btn-control-sm lrx-comments-see-more hidden">See More</button>
    </div>
</div>
<script>
    $(document).ready(function () {
        Lunarix.Comments.Resources = {
            //<sl:translate>
            defaultMessage: 'Write a comment!',
            noCommentsFound: 'No comments found.',
            moreComments: 'More comments',
            sorrySomethingWentWrong: 'Sorry, something went wrong.',
            charactersRemaining: ' characters remaining',
            emailVerifiedABTitle: 'Verify Your Email',
            emailVerifiedABMessage: "You must verify your email before you can comment. You can verify your email on the <a href='/my/account?confirmemail=1'>Account</a> page.",
            linksNotAllowedTitle: 'Links Not Allowed',
            linksNotAllowedMessage: 'Comments should be about the item or place on which you are commenting. Links are not permitted.',
            accept: 'Verify',
            decline: 'Cancel',
            tooManyCharacters: 'Too many characters!',
            tooManyNewlines: 'Too many newlines!'
            //</sl:translate>
        };
    
        Lunarix.Comments.Limits =
        [
            {
                limit: '10',
                character: "\n",
                message: Lunarix.Comments.Resources.tooManyNewlines
            },
            {
                limit: '200',
                character: undefined,
                message: Lunarix.Comments.Resources.tooManyCharacters
            }
        ];

        Lunarix.Comments.FilterIsEnabled = true;
        Lunarix.Comments.FilterRegex = "(([a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}[:\\#/\?]+)|([a-zA-Z0-9]\\.[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}))";
        Lunarix.Comments.FilterCleanExistingComments = false ;


    
    Lunarix.Comments.initialize();
    });
</script>
        </div>
</div>
</div>
</div>
</div>
@include('layout.footer')
@endsection