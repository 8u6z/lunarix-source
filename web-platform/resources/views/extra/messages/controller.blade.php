<div ng-switch="currentStatus.moduleState">
    <div lrx-messages-nav></div>
    <div ng-switch-when="list">
        <div lrx-messages-list></div>
    </div>
    <div ng-switch-when="detail" class="lunarix-message-body">
        <div lrx-messages-detail
             selected-message="messageContent.selectedMessage"
             send-message="sendMessage"
             current-status="currentStatus"
             toggle-messages-box="toggleMessagesBox('list')"
             message-defaults ="MESSAGEDEFAULTS"></div>
    </div>
</div>