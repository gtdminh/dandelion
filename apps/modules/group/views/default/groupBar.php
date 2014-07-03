<div class="large-100">
    <div class="topBarGroup">
        <div class="column-group">
            <div class="large-75">
                <nav class="ink-navigation">
                    <ul class="horizontal menu">
                        <li><a href="/content/group/groupdetail?id=<?php echo str_replace(":", "_", $group->recordID) ?>"><?php echo $group->data->name ?></a></li>
                        <li><a href="/content/group/members?id=<?php echo str_replace(":", "_", $group->recordID) ?>&act=membership">Members</a></li>
                        <li><a href="#">Event</a></li>
                        <li><a href="#">Photo</a></li>
                    </ul>
                </nav>
            </div>
            <div class="large-15 tiptip">
                <a title="Create Group" class="button" id="createGroup" href="/content/group/create"><span class="icon icon3"></span><span class="label">Create Group</span></a>
            </div>
            <div class="large-10">
                <div class="menuClick">
                    <a id="linkSettingGroup" class="button icon settings"></a>
                    <div id="divSettingGroup" class="divmenu">
                        <nav class="ink-navigation">
                            <ul class="menu vertical ">
                                <li><a href="#1">Edit Notification Settings</a></li>
                                <li><a id="leaveGroup" rel="<?php echo str_replace(":", "_", $group->recordID) ?>" href="/content/group/leave" title="<?php echo $group->data->name ?>">Leave Group</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>