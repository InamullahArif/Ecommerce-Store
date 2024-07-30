
    @foreach ($comments as $comment)
        <div class="comments-area" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
            <div class="d-flex comments-item">
                <div class="comments-img">
                    <img src="{{ asset('website/img/people/1.jpg') }}" alt="img">
                </div>
                <div class="comments-main">
                    <div class="comments-main-content">
                        <div class="comments-meta">
                            <h4 class="commentator-name">{{ $comment->username ?? '--' }}</h4>
                            <div class="comments-date article-date d-flex align-items-center">
                                <span class="icon-publish">
                                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                            fill="#00234D" />
                                    </svg>
                                </span>
                                <span
                                    class="ms-2">{{ \Carbon\Carbon::parse($comment->created_at)->format('d F, Y') }}</span>
                            </div>
                            <p class="comments">{{ $comment->content }}</p>
                        </div>
                        <button type="button" class="btn-reply bg-transparent d-flex align-items-center"
                            data-comment-id="{{ $comment->id }}">
                            <span class="btn-reply-icon me-2">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.14062 2.64062L1.14062 6.64062L0.796875 7L1.14062 7.35938L5.14062 11.3594L5.85938 10.6406L2.21875 7L5.85938 3.35938L5.14062 2.64062ZM7.64062 2.64062L3.64062 6.64062L3.29688 7L3.64062 7.35938L7.64062 11.3594L8.35938 10.6406L5.21875 7.5H11.5C12.8867 7.5 14 8.61328 14 10C14 11.3867 12.8867 12.5 11.5 12.5V13.5C13.4277 13.5 15 11.9277 15 10C15 8.07227 13.4277 6.5 11.5 6.5H5.21875L8.35938 3.35938L7.64062 2.64062Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <span class="btn-reply-text">Reply</span>
                        </button>
                    </div>
                    {{-- @foreach ($blogs->comments as $reply)
                        @if ($reply->parent_id == $comment->id)
                            <div class="d-flex comments-item">
                                <div class="comments-img">
                                    <img src="{{ asset('website/img/people/2.jpg') }}" alt="img">
                                </div>
                                <div class="comments-main">
                                    <div class="comments-meta">
                                        <h4 class="commentator-name">{{ $reply->username ?? '--' }}</h4>
                                        <div class="comments-date article-date d-flex align-items-center">
                                            <span class="icon-publish">
                                                <svg width="17" height="18" viewBox="0 0 17 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                                        fill="#00234D" />
                                                </svg>
                                            </span>
                                            <span
                                                class="ms-2">{{ \Carbon\Carbon::parse($reply->created_at)->format('d F, Y') }}</span>
                                        </div>
                                        <p class="comments">{{ $reply->content }}</p>
                                    </div>
                                    <button type="button" class="btn-reply1 bg-transparent d-flex align-items-center"
                                        data-comment-id="{{ $reply->id }}">
                                        <span class="btn-reply-icon me-2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.14062 2.64062L1.14062 6.64062L0.796875 7L1.14062 7.35938L5.14062 11.3594L5.85938 10.6406L2.21875 7L5.85938 3.35938L5.14062 2.64062ZM7.64062 2.64062L3.64062 6.64062L3.29688 7L3.64062 7.35938L7.64062 11.3594L8.35938 10.6406L5.21875 7.5H11.5C12.8867 7.5 14 8.61328 14 10C14 11.3867 12.8867 12.5 11.5 12.5V13.5C13.4277 13.5 15 11.9277 15 10C15 8.07227 13.4277 6.5 11.5 6.5H5.21875L8.35938 3.35938L7.64062 2.64062Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <span class="btn-reply-text" id="replyBtn">Reply</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach --}}

                </div>
            </div>
            @include('dashboard.WebsiteManagement.Comments.singleComment', ['comments' => $comment->replies])
        </div>
    @endforeach
