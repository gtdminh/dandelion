<?php
$records = $mod['comment'];
if (!empty($mod['comment']))
{

    $pos = (count($records) < 3 ? count($records) : 3);
    for ($j = count($records) - $pos; $j < count($records); $j++)
    {
        $id = str_replace(":", "_", $records[$j]['comment']->recordID);
        $recordID = $records[$j]['comment']->recordID;
        $content = $records[$j]['comment']->data->content;
        $published = $records[$j]['comment']->data->published;
        $numberLike = $records[$j]['comment']->data->numberLike;
        $like = $records[$j]['like'];
        $profile = $records[$j]['user'];
        ?>
        <div class="eachCommentItem verGapBox column-group">
            <div class="large-10 uiActorCommentPicCol">
                <a href="/user/<?php echo $profile->data->username; ?>"><img src="<?php echo $this->getAvatar($profile->data->profilePic) ?>"></a>
            </div>
            <div class="large-85 uiCommentContent">
                <p>
                    <a class="timeLineCommentLink" href="/user/<?php echo $profile->data->username; ?>"><?php echo $profile->data->fullName; ?></a>
                    <span class="textComment"><?php echo $content; ?></span>
                </p>
                <a class="swTimeComment">
                    <?php
                    echo $this->getTime($published);
                    ?>
                </a>
                <a class="uiLike like_<?php echo $id ?>" data-like="comment;<?php echo $this->f3->get('SESSION.userID') . ';' . $recordID ?>" data-rel="<?php echo $like ? "unlike" : "like" ?>"><?php echo $like ? "Unlike" : "Like" ?></a>
                <a href="#" class="l2_<?php echo $id ?>"> <?php
                    if ($numberLike >= 1)
                        echo '<i class="fa fa-hand-o-right fa-14"></i> ' . $numberLike;
                    else
                        $numberLike
                        ?></a>
            </div>
            <div class="large-5 comment-pencil">
                <?php
                if ($this->f3->get('SESSION.userID') == $profile->recordID)
                {
                    ?>
                    <a data-dropdown="#dropdown_oc<?php echo $id; ?>"><i class="fa fa-pencil"></i></a>
                    <div id="dropdown_oc<?php echo $id; ?>" class="dropdown dropdown-tip dropdown-anchor-right dropdown-right">
                        <ul class="dropdown-menu">

                            <li><a class="test" href="#">Edit..</a></li>
                            <li><a class="deleteAction" id="<?php echo $id; ?>">Delete...</a></li>

                        </ul>
                    </div>
                    <?php
                } else
                {
                    ?>
                    <a class="hideComment" href="#"><i class="fa fa-close"></i></a></li>
        <?php } ?>

            </div>
        </div>
        <?php
    }
}
?>