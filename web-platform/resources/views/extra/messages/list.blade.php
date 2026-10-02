@verbatim
<div ng-switch="currentStatus.activeTab">
    <div ng-switch-when="notifications">
        <div class="notifications-header">Notifications are important messages from the Lunarix Team.</div>
        <div id="Notifications" class="messages">
            <div ng-show="notifications.TotalCollectionSize == 0">You have no notifications.</div>
            <div class="sub-divider-bottom messageDivider lunarix-notificationRow "
                 ng-repeat="notification in notifications.Collection"
                 ng-click="showBody = !showBody">
                <div class="clearfix">
                    <div class="lunarix-avatar-image">
                        <a ng-href="{{notification.SenderAbsoluteUrl}}"
                           lrx-avatar
                           thumbnail="notification.SenderThumbnail">
                        </a>
                    </div>
                    <div class="lunarix-message-title clearfix">
                        <span class="lunarix-message-subject">
                                <a ng-hide="showBody" >
                                    <b>{{notification.Sender.UserName}}</b>
                                </a>
                                <a ng-show="showBody"
                                   ng-click="showBody = false"
                                   ng-href="{{notification.SenderAbsoluteUrl}}">
                                    <b>{{notification.Sender.UserName}}</b>
                                </a>
                            <br />
                            {{notification.Subject}}<br />
                        </span>
                        <span class="greyedout" style="float: right">{{notification.Created}}</span>
                    </div>
                </div>
                <div class="messageDivider notificationBody"
                     ng-hide="!showBody">
                    <span ng-bind-html="notification.Body"><br /></span>
                </div>
            </div>
        </div><!--#Notifications-->
    </div>

    <div ng-switch-default>
        <div id="MessagesInbox" class="messages">
            <div ng-show="messages.TotalCollectionSize == 0">You have no {{currentStatus.activeTab}} messages.</div>
            <div class="sub-divider-bottom messageDivider read lunarix-message-row"
                 ng-class="{unread: message.IsRead == false && currentStatus.activeTab != 'sent'}"
                 ng-repeat="message in messages.Collection">

                <a class="messageRowAnchor"></a>
                <label class="messageCheckbox lunarix-inboxCheckbox"
                       ng-class="{lunarixInvisibility: currentStatus.activeTab == 'sent'}">
                    <input type="checkbox"
                           ng-click="toggleSelection($index)"
                           ng-checked="message.checked"
                           ng-model="message.checked" />
                </label>
                <div class="lunarix-avatar-image">
                    <a ng-if="currentStatus.activeTab != 'sent'"
                       ng-href="{{message.SenderAbsoluteUrl}}"
                       lrx-avatar
                       thumbnail="message.SenderThumbnail | isEmpty:MESSAGEDEFAULTS.lunarixUserThumbnail:message.Sender.UserId">
                    </a>
                    <a ng-if="currentStatus.activeTab == 'sent'"
                       ng-href="{{message.RecipientAbsoluteUrl}}"
                       lrx-avatar
                       thumbnail="message.RecipientThumbnail">
                    </a>
                </div>
                <div class="lunarix-messageRow lunarix-message-summary"
                     ng-click="toggleMessagesBox('detail')">
                    <div class="wrappedText notranslate">
                        <span class="positionAboveLink"
                              ng-if="currentStatus.activeTab != 'sent'"
                              ng-bind="message.Sender.UserName | isEmpty : MESSAGEDEFAULTS.lunarixUserName:message.Sender.UserName"></span>
                        <span class="positionAboveLink"
                              ng-if="currentStatus.activeTab == 'sent'"
                              ng-bind="message.Recipient.UserName"></span>
                        <br />
                        <span class="subject notranslate" ng-bind="message.Subject"></span>&nbsp;-&nbsp;
                        <span ng-bind-html="message.Body | htmlToPlaintext"></span>
                    </div>
                    <span class="messageDate read" ng-bind="message.Created"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endverbatim
