@verbatim
<div>
    <div class="messages message-detail">
        <div class="message-confirm status-confirm lunarix-message-confirm"
             ng-show="sendMessage.sendComplete == true && sendMessage.sendResult.hasError == false ">
            {{sendMessage.sendResult.details}}
        </div>
        <div class="message-confirm status-error lunarix-message-confirm"
             ng-show="sendMessage.sendComplete == true && sendMessage.sendResult.hasError == true"
             ng-bind-html="sendMessage.sendResult.details">

        </div>
        <div class="clearfix">
            <div class="sender">
                <div class="lunarix-avatar-image message-detail-image lunarix-message-avatar">
                    <a ng-if="currentStatus.activeTab != 'sent'"
                       ng-href="{{selectedMessage.SenderAbsoluteUrl}}"
                       lrx-avatar
                       thumbnail="selectedMessage.SenderThumbnail | isEmpty : messageDefaults.lunarixUserThumbnail:selectedMessage.Sender.UserId">
                    </a>
                    <a ng-if="currentStatus.activeTab == 'sent'"
                       ng-href="{{selectedMessage.RecipientAbsoluteUrl}}"
                       lrx-avatar
                       thumbnail="selectedMessage.RecipientThumbnail">
                    </a>
                </div>
            </div>
            <div class="subject lunarix-send-message-subject">
                <h3>{{selectedMessage.Subject}}</h3>
                <div class="lunarix-send-message-content">
                    <p class="lunarix-sender-link" ng-if="currentStatus.activeTab != 'sent'">
                        <a ng-href="{{selectedMessage.SenderAbsoluteUrl}}">
                            {{selectedMessage.Sender.UserName | isEmpty : messageDefaults.lunarixUserName:selectedMessage.Sender.UserName}}
                        </a> wrote at {{selectedMessage.Created}}
                    </p>
                    <p class="lunarix-sender-link" ng-if="currentStatus.activeTab == 'sent'">
                        <a ng-href="{{selectedMessage.SenderAbsoluteUrl}}">
                            {{selectedMessage.Sender.UserName}}
                        </a> wrote at {{selectedMessage.Created}}
                    </p>
                    <a ng-if="selectedMessage.IsReportAbuseDisplayed == true" ng-href="{{selectedMessage.AbuseReportAbsoluteUrl}}" class="abuse-button lunarix-abuse-btn">Report Abuse</a>
                    
                </div>
            </div>
        </div>
        <div class="body clearfix">
            <div ng-bind-html="selectedMessage.Body">

            </div>
        </div>
        <div class="message-reply" ng-hide="sendMessage.disableReplyBtn == false || sendMessage.sendResult.hasError == false">
            <textarea rows="2" cols="20" class="messages-reply-box text-box"
                      ng-model="sendMessage.replyContent"
                      ng-disabled="sendMessage.disableSendBtn == true"></textarea>
            <div class="password-warning">Remember, Lunarix staff will never ask you for your password. People who ask for your password are trying to steal your account.</div>
            <input type="checkbox" id="includePreviousMessage" ng-checked="sendMessage.includePreviousMessage" ng-model="sendMessage.includePreviousMessage">
            <label for="includePreviousMessage">Include Previous Message</label>
            <div class="lunarix-sendMessage-action">
                <button class="lunarix-sendMessage"
                        ng-click="sendReply()"
                        ng-disabled="sendMessage.disableSendBtn == true || sendMessage.replyContent.length == 0">
                    Send reply
                </button>
            </div>
        </div>
    </div>
</div>
@endverbatim
