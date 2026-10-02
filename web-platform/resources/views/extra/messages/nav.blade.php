<div>
    <div id="inbox-general-buttons" class="lunarix-messages-nav clearfix" ng-switch="currentStatus.moduleState">
        <div ng-switch-when="list">
            <div class="lunarix-messages-btns" ng-show="messageContent.messages.data.TotalCollectionSize > 0">
                <div ng-if="currentStatus.activeTab == 'inbox'">
                    <label class="messageCheckbox">
                        <input type="checkbox" class="topCheckbox lunarix-archiveAll"
                               ng-model="messageContent.selectedAll"
                               ng-click="checkAll()" />
                    </label>
                    <button class="lunarix-archiveButton btn-control lunarix-message-large-btn"
                            ng-click="markArchive(true)">
                        Archive
                    </button>
                    <button class="lunarix-markAsReadInbox btn-control lunarix-message-large-btn"
                            ng-click="markRead(true)">
                        Mark As Read
                    </button>
                    <button class="lunarix-markAsUnreadInbox btn-control lunarix-message-large-btn"
                            ng-click="markRead(false)">
                        Mark As Unread
                    </button>
                </div>

                <div ng-if="currentStatus.activeTab == 'archive'">
                    <label class="messageCheckbox">
                        <input type="checkbox" class="topCheckbox lunarix-archiveAll"
                               ng-model="messageContent.selectedAll"
                               ng-click="checkAll()" />
                    </label>
                    <button class="lunarix-moveToInboxButton btn-control lunarix-message-large-btn"
                            ng-click="markArchive(false)">
                        Move to Inbox
                    </button>
                    <button class="lunarix-markAsReadInbox btn-control lunarix-message-large-btn"
                            ng-click="markRead(true)">
                        Mark As Read
                    </button>
                    <button class="lunarix-markAsUnreadInbox btn-control lunarix-message-large-btn"
                            ng-click="markRead(false)">
                        Mark As Unread
                    </button>
                </div>

                <div id="pagingInbox" class="pagingDiv pagination-container clearfix" ng-if="currentStatus.totalPages > 1">
                    <button class="pager previous"
                            ng-click="pagination('prev')"
                            ng-disabled="currentStatus.currentPage == 1"></button>
                    <span class="page text">
                        Page <span class="CurrentPage" ng-bind="currentStatus.currentPage"></span>
                        of <span class="TotalPages" ng-bind="currentStatus.totalPages"></span>
                    </span>
                    <button class="pager next"
                            ng-click="pagination('next')"
                            ng-disabled="currentStatus.currentPage == currentStatus.totalPages"></button>
                </div>
            </div>
        </div>

        <div ng-switch-when="detail">
            <div class="lunarix-messages-btns">
                <button class="lunarix-messageback pager previous lunarix-message-back-btn" ng-click="toggleMessagesBox('list')"></button>

                <div ng-if="currentStatus.activeTab == 'inbox'">
                    <button class="btn-control lunarix-message-large-btn message-detail-mark-archive"
                            ng-click="markArchive(true)">
                        Archive
                    </button>
                </div>
                <div ng-if="currentStatus.activeTab == 'archive'">
                    <button id="lunarix-archive-btn"
                            class="btn-control lunarix-message-large-btn"
                            ng-click="markArchive(false)">
                        Move to Inbox
                    </button>
                </div>
                <div ng-if="currentStatus.activeTab == 'inbox' || currentStatus.activeTab == 'archive'">
                    <button id="lunarix-reply-btn"
                            class="btn-control lunarix-message-large-btn"
                            ng-click="requestReply()"
                            ng-disabled="sendMessage.disableReplyBtn"
                            ng-hide="messageContent.selectedMessage.IsSystemMessage == true">
                        Reply
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>