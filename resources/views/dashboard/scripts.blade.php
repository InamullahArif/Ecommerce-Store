<script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/zoom.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-11.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-12.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-13.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-14.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-15.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-16.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-8.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-1.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-2.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-3.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-4.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-5.js') }}"></script>
    <script src="{{ asset('dashboard/js/apexcharts/line-chart-6.js') }}"></script>
    <script src="{{ asset('dashboard/js/theme-settings.js') }}"></script>
    <script src="{{ asset('dashboard/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('dashboard/js/notifications.js') }}"></script>
    <script src="{{ asset('dashboard/js/users.js') }}"></script>
    <script src="{{ asset('dashboard/js/roles.js') }}"></script>
    <script src="{{ asset('dashboard/js/assign-permissions.js') }}"></script>
    <script src="{{ asset('dashboard/js/category.js') }}"></script>
    <script src="{{ asset('dashboard/js/blog.js') }}"></script>
    <script src="{{ asset('dashboard/js/logs.js') }}"></script>
    <script src="{{ asset('dashboard/js/products.js') }}"></script>
    <script src="{{ asset('dashboard/js/colors.js') }}"></script>
    <script src="{{ asset('dashboard/js/sizes.js') }}"></script>
    <script src="{{ asset('dashboard/js/order.js') }}"></script>

    {{-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}

    {{-- <script src="{{ asset('dashboard/js/assign-user-permissions.js') }}"></script> --}}
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            console.log(type);
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }

            var audio = new Audio('audio.mp3');
            audio.play();
        @endif
    </script>
