@extends('dashboard.welcome')
@section('content')
                <div class="section-content-right">
                    <div class="main-content">
                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>View User</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="/"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">Logs</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">View Logs</div>
                                        </li>
                                    </ul>
                                </div>
                                <form class="form-add-new-user form-style-2" >
                                    @csrf
                                    <div class="wg-box">
                                        <div class="right flex-grow">
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">Subject</div>
                                                <input class="flex-grow" type="text" placeholder="Subject" @if (isset($logs['subject'])) value="{{ $logs['subject'] }}" 
                                                @else value="{{ old('subject') }}" @endif name="subject" tabindex="0" value="" aria-required="true" style="margin-bottom: 6px" readonly>
                                            </fieldset>
                                            <fieldset class="email mb-24">
                                                <div class="body-title mb-10">Url</div>
                                                <input class="flex-grow" type="text" placeholder="Url" @if (isset($logs['url'])) value="{{ $logs['url'] }}" 
                                                @else value="{{ old('url') }}" @endif name="url" tabindex="0" value="" aria-required="true" style="margin-bottom: 6px" readonly>
                                            </fieldset>
                                            <fieldset class="email mb-24">
                                                <div class="body-title mb-10">Method</div>
                                                <input class="flex-grow" type="text" placeholder="Method" @if (isset($logs['method'])) value="{{ $logs['method'] }}" 
                                                @else value="{{ old('method') }}" @endif name="method" tabindex="0" value="" aria-required="true" style="margin-bottom: 6px" readonly>
                                            </fieldset>
                                            <fieldset class="email mb-24">
                                                <div class="body-title mb-10">IP</div>
                                                <input class="flex-grow" type="text" placeholder="IP" @if (isset($logs['ip'])) value="{{ $logs['ip'] }}" 
                                                @else value="{{ old('ip') }}" @endif name="ip" tabindex="0" value="" aria-required="true" style="margin-bottom: 6px" readonly>
                                            </fieldset>
                                            <fieldset class="email mb-24">
                                                <div class="body-title mb-10">User Agent</div>
                                                <input class="flex-grow" type="text" placeholder="User Agent" @if (isset($logs['agent'])) value="{{ $logs['agent'] }}" 
                                                @else value="{{ old('agent') }}" @endif name="agent" tabindex="0" value="" aria-required="true" style="margin-bottom: 6px" readonly>
                                            </fieldset>
                                            <fieldset class="email mb-24">
                                                <div class="body-title mb-10">User ID</div>
                                                <input class="flex-grow" type="text" placeholder="User ID" @if (isset($logs['user_id'])) value="{{ $logs['user_id'] }}" 
                                                @else value="{{ old('user_id') }}" @endif name="user_id" tabindex="0" value="" aria-required="true" style="margin-bottom: 6px" readonly>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bot">
                                        <a class="tf-button w180" href="{{route('logActivity')}}">Back
                                        {{-- <button class="tf-button w180" type="submit"> Back</button> --}}
                                        </a>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 Remos. Design with</div>
                            <i class="icon-heart"></i>
                            <div class="body-text">by <a href="https://themeforest.net/user/themesflat/portfolio">Themesflat</a> All rights reserved.</div>
                        </div>
                    </div>
                </div>
@endsection
