<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <a href="index.html">
                <img class="" id="logo_header_mobile" alt="" src="images/logo/logo.png"
                    data-light="images/logo/logo.png" data-dark="images/logo/logo-dark.png" data-width="154px"
                    data-height="52px" data-retina="images/logo/logo@2x.png">
            </a>
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>
            <form class="form-search flex-grow">
                <fieldset class="name">
                    <input type="text" placeholder="Search here..." class="show-search" name="search" id="search"
                        tabindex="2" value="" aria-required="true" required="">
                </fieldset>
                <div class="button-submit">
                    <button class="" type="submit"><i class="icon-search"></i></button>
                </div>
                <div class="box-content-search" id="box-content-search">
                    <ul class="">
                        <li class="mb-14">
                            <div class="body-title"></div>
                        </li>
                        <li class="mb-14">
                            <div class="divider"></div>
                        </li>
                        <li>
                            <ul>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="images/products/20.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Sojos Crunchy Natural Grain
                                                Free...</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </form>
            {{-- <div id="search-results-dashboard" class="search-results">
            </div> --}}
        </div>
        <div class="header-grid">
            <div class="header-item country">
                <select class="image-select no-text">
                    <option data-thumbnail="images/country/1.png">ENG</option>
                    <option data-thumbnail="images/country/9.png">VIE</option>
                </select>
            </div>
            <div class="header-item button-dark-light">
                <i class="icon-moon"></i>
            </div>
            <div class="popup-wrap noti type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            {{-- @php
                                 $unreadNotificationsCount = \App\Models\Notification::where('is_read', 0)->count();
                            @endphp --}}
                            <span class="text-tiny" id="noti_count">{{ $notifications->count() }}</span>
                            <i class="icon-bell"></i>
                        </span>
                        {{-- <x-unread-notifications-count/> --}}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <h6>Messages</h6>
                        </li>
                        {{-- <x-show-notifications /> --}}
                        {{-- <x-show-notifications /> --}}


                        {{-- @php
                            $notifications = \App\Models\Notification::orderBy('created_at', 'desc')->take(4)->get();
                        @endphp --}}
                        {{-- @if (isset($notifications))
                     @foreach ($notifications as $notification)
                        <li>
                            <div class="noti-item w-full wg-user active" id="notification_div"> --}}
                        {{-- <div class="image">
                                    <img src="images/avatar/user-11.png" alt="">
                                </div> --}}

                        {{-- <div class="flex-grow">
                                    <div class="flex items-center justify-between">
                                        <a href="#" class="body-title text-red-500" style="@if ($notification->is_read == false) color: red @else color:green @endif">{{$notification->name}}</a>
                                        <div class="time">{{ $notification->created_at->timezone('Asia/Karachi')->format('h:i A') }}</div>
                                    </div>
                                    <div class="text-tiny">{{$notification->detail}}</div>
                                    <div style="display: flex; justify-content: flex-end;">
                                        <button class="mark-as-read" data-notification-id="{{ $notification->id }}">Mark as read</button>
                                    </div>
                                </div>
                               
                            </div>
                        </li>
                    @endforeach
                    @endif --}}
                        {{-- @if (isset($notifications))
                        @foreach ($notifications as $notification)
                        <li>
                            <div class="noti-item w-full wg-user active" id="notification_div_{{ $notification->id }}"> --}}
                        {{-- <div class="image">
                                    <img src="images/avatar/user-11.png" alt="">
                                </div> --}}

                        {{-- <div class="flex-grow">
                                    <div class="flex items-center justify-between">
                                        <a href="#" class="body-title text-red-500" style="@if ($notification->is_read == false) color: red @else color:green @endif" id="notification_link_{{ $notification->id }}">{{$notification->name}}</a>
                                        <div class="time">{{ $notification->created_at->timezone('Asia/Karachi')->format('h:i A') }}</div>
                                    </div>
                                    <div class="text-tiny">{{$notification->detail}}</div>
                                    <div style="display: flex; justify-content: flex-end;">
                                        <button class="mark-as-read" data-notification-id="{{ $notification->id }}">@if ($notification->is_read == true) Read @else Mark as Read @endif</button>
                                    </div>
                                </div>
                            
                            </div>
                        </li>
                        @endforeach
                    @endif --}}
                        @if (isset($notifications))
                            @foreach ($notifications->slice(0, 4) as $notification)
                                <li>
                                    <div class="noti-item w-full wg-user active"
                                        id="notification_div_{{ $notification->id }}">
                                        <input type="hidden" name="id" id="notification_id"
                                            value="{{ $notification->id }}">
                                        <div class="flex-grow">
                                            <div class="flex items-center justify-between">
                                                <a href="#" class="body-title"
                                                    style="@if ($notification->is_read == false) color: red @else color:green @endif"
                                                    id="notification_link_{{ $notification->id }}">
                                                    {{ $notification->name }}
                                                </a>
                                                <div class="time">
                                                    {{ $notification->created_at->timezone('Asia/Karachi')->format('h:i A') }}
                                                </div>
                                            </div>
                                            <div class="text-tiny">{{ $notification->detail }}</div>
                                            <div style="display: flex; justify-content: flex-end; font-size:15px">
                                                <button
                                                    class="mark-as-read badge @if ($notification->is_read == true) badge-primary
                                        @else badge-secondary @endif"
                                                    data-notification-id="{{ $notification->id }}">
                                                    @if ($notification->is_read == true)
                                                        Read
                                                    @else
                                                        Mark as Read
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                        {{-- <li>
                            <div class="noti-item w-full wg-user active">
                                <div class="image">
                                    <img src="images/avatar/user-12.png" alt="">
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between">
                                        <a href="#" class="body-title">Ralph Edwards</a>
                                        <div class="time">10:13 PM</div>
                                    </div>
                                    <div class="text-tiny">Are you there?  interested i this...</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="noti-item w-full wg-user active">
                                <div class="image">
                                    <img src="images/avatar/user-13.png" alt="">
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between">
                                        <a href="#" class="body-title">Eleanor Pena</a>
                                        <div class="time">10:13 PM</div>
                                    </div>
                                    <div class="text-tiny">Interested in this loads?</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="noti-item w-full wg-user active">
                                <div class="image">
                                    <img src="images/avatar/user-11.png" alt="">
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between">
                                        <a href="#" class="body-title">Jane Cooper</a>
                                        <div class="time">10:13 PM</div>
                                    </div>
                                    <div class="text-tiny">Okay...Do we have a deal?</div>
                                </div>
                            </div>
                        </li> --}}
                        <li><a href="/notifications" class="tf-button w-full">View all</a></li>
                    </ul>
                </div>
            </div>
            <div class="popup-wrap message type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            <span class="text-tiny">1</span>
                            <i class="icon-message-square"></i>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton2">
                        <li>
                            <h6>Notifications</h6>
                        </li>
                        <li>
                            <div class="message-item item-1">
                                <div class="image">
                                    <i class="icon-noti-1"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Discount available</div>
                                    <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus at, ullamcorper nec
                                        diam</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-2">
                                <div class="image">
                                    <i class="icon-noti-2"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Account has been verified</div>
                                    <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus et</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-3">
                                <div class="image">
                                    <i class="icon-noti-3"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Order shipped successfully</div>
                                    <div class="text-tiny">Integer aliquam eros nec sollicitudin sollicitudin</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-4">
                                <div class="image">
                                    <i class="icon-noti-4"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Order pending: <span>ID 305830</span></div>
                                    <div class="text-tiny">Ultricies at rhoncus at ullamcorper</div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#" class="tf-button w-full">View all</a></li>
                    </ul>
                </div>
            </div>
            <div class="header-item button-zoom-maximize">
                <div class="">
                    <i class="icon-maximize"></i>
                </div>
            </div>
            {{-- <div class="popup-wrap apps type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            <i class="icon-grid"></i>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton4" >
                        <li>
                            <h6>Related apps</h6>
                        </li>
                        <li>
                            <ul class="list-apps">
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-1.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Photoshop</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-2.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">illustrator</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-3.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Sheets</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-4.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Gmail</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-5.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Messenger</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-6.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Youtube</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-7.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Flaticon</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-8.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Instagram</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="images/apps/item-9.png" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">PDF</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#" class="tf-button w-full">View all app</a></li>
                    </ul>
                </div>
            </div> --}}
            @php
                $roles = json_decode(Auth::user()->roles);
                // dd(Auth::user()->image->name);
            @endphp
            <div class="popup-wrap user type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-user wg-user">
                            <span class="image">
                                <img src="{{ asset(Auth::user()->image->name ?? 'user_images/user.jpg') }}"
                                    alt="Profile Image" style="border-radius: 10%">
                            </span>
                            <span class="flex flex-column">
                                <span class="body-title mb-2">{{ Auth::user()->name }}</span>
                                <span class="text-tiny">
                                    @foreach (Auth::user()->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </span>
                            </span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="/users/profile/{{ Auth::id() }}" class="user-item">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="body-title-2">Account</div>
                            </a>
                        </li>
                        <li>
                            <a href="/logout" class="user-item">
                                <div class="icon">
                                    <i class="icon-log-out"></i>
                                </div>
                                <div class="body-title-2">Log out</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
        $('.mark-as-read').on('click', function(e) {
            e.preventDefault();
    
            var notificationId = $(this).data('notification-id');
            // console.log($('notification_div_'+notificationId)); return
            var button = $(this);
    
            $.ajax({
                url: '/mark-as-read', // Replace with your actual URL
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: notificationId
                },
                success: function(response) {
                    if (response.success) {
                        // Change the color of the anchor tag
                        $('#notification_link_' + notificationId).css('color', 'green');
                        button.prop('disabled', true).text('Read'); 
                        $('#notification_div_'+notificationId).remove();
                        $('#noti').text('Read');
                        updateNotificationsCount();
                    } else {
                        alert('Failed to mark notification as read.');
                    }
                },
                error: function() {
                    alert('Error in marking notification as read.');
                }
            });
        });
    });
    function updateNotificationsCount()
    {
        var notificationId = $(this).closest('.noti-item').find('input[name="id"]').val();
        // console.log('Hidden input field ID:', notificationId);
        // console.log(notificationId);
        $.ajax({
            url: '/notifications-count',
            method: 'GET',
            success: function(response) {
                console.log(response);
                $('#noti_count').text(response.notification_count); // Update the notifications count
                // $('#notification_div_'. response.notifications.id).remove();
            },
            error: function() {
                alert('Error in fetching notifications count.');
            }
        });
    }
    </script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: '{{ route('searchDashboard') }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        var resultsContainer = $('#box-content-search');
                        resultsContainer.empty(); 

                        if (data) {
                            var resultsList = $('<ul></ul>');

                            for (var model in data) {
                                if (data.hasOwnProperty(model)) {
                                    var items = data[model];

                                    items.forEach(function(item) {
                                        var result = item.result;
                                        var displayText = '';

                                        for (var key in result) {
                                            // console.log(key);
                                            if (result.hasOwnProperty(key) &&
                                                result[key] && typeof result[
                                                    key] === 'string') {
                                                displayText = result[key];
                                                break;
                                            }
                                            // console.log(displayText); return;
                                        }

                                        var resultItem = $(
                                                '<li class="product-item gap14 mb-10"></li>'
                                            )
                                            .html(`
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <span class="body-text">${displayText}</span>
                                        </div>
                                        <div class="model-name" style="margin-left: auto;">
                                            <span>${model}</span>
                                        </div>
                                    </div>
                                `)
                                            .data('id', result
                                                .id) 
                                            .data('model',
                                                model);

                                        resultsList.append(resultItem);
                                        resultsList.append(
                                            '<li class="mb-10"><div class="divider"></div></li>'
                                        ); 
                                    });
                                }
                            }

                            resultsContainer.append(resultsList);
                        } else {
                            resultsContainer.append('<p>No results found.</p>');
                        }
                    },
                    error: function(xhr) {
                        console.error('An error occurred', xhr.responseText);
                    }
                });
            } else {
                $('#box-content-search').empty(); 
            }
        });
        $(document).on('click', '#box-content-search li.product-item', function() {
            var id = $(this).data('id');
            var model = $(this).data('model');
            // console.log(id,model); return;
            if (id && model) { 
                $.ajax({
                    url: '/goToSearch',
                    type: 'POST',
                    data: {
                        id: id,
                        model: model,
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function(response) {
                        model = model.toLowerCase() +
                        's';
                        var url;
                        // console.log(response.data); return;
                        if (response.data.slug) {
                            url = `/${model}/${response.data.slug}`;
                        }else
                        {
                            url = `/${model}/${response.data.id}`;

                        }
                        // console.log(url);
                        window.location.href = url;
                    },
                    error: function(xhr) {
                        console.error('An error occurred', xhr.responseText);
                    }
                });
            } else {
                console.error('ID or model is missing!');
            }
        });

    });
</script>
