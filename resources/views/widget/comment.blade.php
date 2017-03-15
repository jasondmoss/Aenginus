<?php
$finalCommentType = $commentable->getCommentType();
?>
@if($finalCommentType == 'raw')
    @include('widget.raw_comment')
@elseif($finalCommentType == 'duoshuo')
    @include('widget.duoshuo_comment')
@elseif($finalCommentType == 'disqus')
    @include('widget.disqus_comment')
@endif
