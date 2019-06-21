<ul class="comments-list style-2">
    @foreach($children as $comment)
            <li class="comment-item has-children">
                <div class="post__author author vcard">
                    <img src="{{$comment->user->path_sm}}" alt="{{$comment->user->family}}">

                    <div class="author-date pt-0">
                        <div class="comment-show"><span class="post__author-name fn fs0-8 text-primary mr-1 cursor-pointer ml-2">{{$comment->user->family}}</span>
                            <?php echo $comment->description ?>
                        </div>
                        <span {{--v-bind:class="{'post-comment-like': comment.liked === 1}"--}} class="post-add-icon inline-items cursor-pointer" {{--@click="doLike(comment.id , 'comment')"--}}>
                                        <svg class="olymp-heart-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                        <span>{{$comment->likes_count}}</span>
                                    </span>
                        <span {{--@click="answerCommentBoxShow(comment.id)"--}} class="reply cursor-pointer text-grey-lighter btn-reply-comment">پاسخ دادن</span>

                        <div class="post__date">
                            <time class="published fs0-75 text-grey-lighter" datetime="">
                                {{$comment->date}}
                            </time>
                        </div>

                        <div class="{{--answer-comment-box-{{$comment->id}}--}} mt-3 mb-2 emoji-comment-answer">

                            <textarea class="emoji-area-editor"></textarea>

                            <button {{--@click="postComment(comment.id)"--}} class="btn btn-sm btn-green mt-2">ارسال پاسخ</button>
                            <button class="btn btn-sm btn-secondary mt-2 btn-cancel-answer">لغو</button>
                        </div>

                    </div>

                </div>

                @if(!empty($comment->child))
                    @include('partials.comment' , ['children' => $comment->child])
                @endif

                {{--<comment v-on:send_comment="sendCommentFromChild" v-if="comment.child.length > 0" :post="selectedPostArray" :children="comment.child" :user_id="user.id"></comment>--}}
            </li>
    @endforeach
</ul>