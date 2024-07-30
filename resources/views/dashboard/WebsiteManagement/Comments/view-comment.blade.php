@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>View Comment</h3>
                        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                            <li>
                                <a href="/">
                                    <div class="text-tiny">Dashboard</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="text-tiny">Comment</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">View Comment</div>
                            </li>
                        </ul>
                    </div>
                    <form class="form-add-new-user form-style-2" id="viewComment" name="viewComment" >
                        @csrf
                        <div class="wg-box">
                            <div class="right flex-grow">
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Comment</div>
                                    <textarea class="flex-grow" type="text" placeholder="Comment"
                                        name="content" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px" readonly> {{$comment['content'] ?? '--'}}</textarea>
                                    @error('content')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Username</div>
                                    <input class="flex-grow" type="text" placeholder="Username"
                                        @if (isset($comment['username'])) value="{{ $comment['username'] }}" 
                                                @else value="{{ old('username') }}" @endif
                                        name="author_name" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px" readonly>
                                    @error('username')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Email</div>
                                    <input class="flex-grow" type="text" placeholder="Email"
                                        @if (isset($comment['email'])) value="{{ $comment['email'] }}" 
                                                @else value="{{ old('email') }}" @endif
                                        name="email" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px" readonly>
                                    @error('email')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                        </div>
                        <div class="bot">
                            <a class="tf-button w180" href="{{route('show-comment')}}">Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
