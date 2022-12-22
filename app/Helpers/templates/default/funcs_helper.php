<?php
if (!function_exists('comments')) {
    function comments(array $comments, string $blog_id)
    {
        $returnData = '';
        foreach ($comments as $comment) {
            $returnData .= '<div class="d-flex mb-4">
<div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"/></div>
<div class="ms-3">
<div class="fw-bold">' . $comment->comFullName . '</div>' . $comment->comMessage . '
<div class="w-100"></div>
<div class="btn-group">
<button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#reply' . (string)$comment->_id . '" aria-expanded="false" aria-controls="reply' . (string)$comment->_id . '">Reply</button>';
            if(!empty($comment->isThereAnReply) && $comment->isThereAnReply===true)
                $returnData .= '<button class="btn btn-sm btn-link" onclick="replies(\''.(string)$comment->_id.'\')" type="button" data-bs-toggle="collapse"
data-bs-target="#replies'.(string)$comment->_id.'" aria-expanded="false" aria-controls="'.(string)$comment->_id.'">Replies <i class="bi-caret-down-fill"></i></button>';

            $returnData.='</div><div class="collapse" id="reply'.(string)$comment->_id.'">
<div class="card card-body">
<form class="mb-1 row">
<div class="col-md-6 form-group mb-3">
<input type="text" class="form-control" name="comFullName" placeholder="Full name">
</div>
<div class="col-md-6 form-group mb-3">
<input type="email" class="form-control" name="comEmail" placeholder="E-mail">
</div>
<div class="col-12 form-group mb-3">
<textarea class="form-control" rows="3" name="comMessage" placeholder="Join the discussion and leave a comment!"></textarea>
</div>
<div class="col-12 form-group text-end">
<button class="btn btn-primary btn-sm sendComment" type="button" data-blogid="'.(string)$blog_id.'" data-id="'.(string)$comment->_id.'">Send</button>
</div>
</form>
</div>
</div>';
            if(!empty($comment->isThereAnReply) && $comment->isThereAnReply===true)
                $returnData.='<div class="collapse" id="replies' . (string)$comment->_id . '"></div>';
            $returnData .= '</div>
                </div>';
        }
        return $returnData;
    }
}