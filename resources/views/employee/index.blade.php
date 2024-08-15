<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NextFi | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- CSS for full calender -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS for full calender -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/fullcalendar/dist/fullcalendar.print.min.css"
        media="print">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/skins/_all-skins.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<style>
    section.content {
        width: 50%;
    }
    .datepicker.datepicker-inline {
        display: none !important;
    }
</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">

    @include('layouts.header')
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Cam LY</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>

                <li class="{{ Request::is('employee') ? 'active' : '' }}">
                    <a href="{{ url('employee') }}">
                        <i class="fa fa-dashboard"></i> <span>Đặt món</span>
                    </a>
                </li>

                <li class="{{ Request::is('show_orders') ? 'active' : '' }}">
                    <a href="{{ url ('show_orders')}}">
                        <i class="fa fa-th"></i> <span>Đã đặt</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    {{-- end sidebar --}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">
            {{-- calendar --}}
            <div class="container-fluid">
                <div id="calendar"></div>
                <!-- Modal -->
                <div class="modal fade" id="lunchRequestModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Lunch Request Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modalBody">
                                <!-- Content will be loaded here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal để điền số lượng món ăn, ghi chú và hình thức -->
                <div class="modal fade" id="orderModal" tabindex="-1" role="dialog"
                    aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderModalLabel">Order Food</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="orderForm">
                                    <div class="form-group">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            min="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="note">Note:</label>
                                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="orderType">Order Type:</label>
                                        <select class="form-control" id="orderType" name="orderType" required>
                                            <option value="takeaway">Mua về</option>
                                            <option value="eat-in">Ăn tại quán</option>
                                        </select>
                                    </div>

                                    <!-- Hidden fields -->
                                    <input type="hidden" id="foodId" name="foodId">
                                    <input type="hidden" id="lunchRequestId" name="lunchRequestId">
                                    <input type="hidden" id="userId" name="userId">

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveOrderBtn">Save Order</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal chỉnh sửa đơn hàng -->
                <div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog"
                    aria-labelledby="editOrderModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editOrderForm">
                                    <input type="hidden" id="editOrderId" name="orderId">
                                    <div class="form-group">
                                        <label for="editQuantity">Quantity:</label>
                                        <input type="number" class="form-control" id="editQuantity" name="quantity"
                                            min="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editNote">Note:</label>
                                        <textarea class="form-control" id="editNote" name="note" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="editOrderType">Order Type:</label>
                                        <select class="form-control" id="editOrderType" name="orderType" required>
                                            <option value="takeaway">Mua về</option>
                                            <option value="eat-in">Ăn tại quán</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="editLunchRequestId" name="lunchRequestId">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveEditOrderBtn">Save
                                    Changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal xác nhận xóa đơn hàng -->
                <div class="modal fade" id="deleteOrderModal" tabindex="-1" role="dialog"
                    aria-labelledby="deleteOrderModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteOrderModalLabel">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this order?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger"
                                    id="confirmDeleteOrderBtn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </section>
        <!-- /.content -->
    </div>
    <script>
       $(document).ready(function() {
    $('#calendar').fullCalendar({
        editable: true,
        selectable: true,
        selectHelper: true,
        dayClick: function(date) {
            var selectedDate = date.format('YYYY-MM-DD');

            $.ajax({
                url: '/get-lunch-requests',
                method: 'GET',
                data: {
                    date: selectedDate
                },
                success: function(response) {
                    console.log(response);
                    var modalBody = $('#modalBody');
                    modalBody.empty(); // Xóa nội dung cũ

                    if (response.lunch_request.length > 0) { // Kiểm tra nếu có yêu cầu
                        var now = moment(); // Thời gian hiện tại
                        var lunch_request = response.lunch_request[0]; // Giả sử bạn chỉ xử lý một yêu cầu cho ngày đó
                        var eatery = response.eateries[0]; // Lấy đúng eatery (phần tử đầu tiên)
                        var foods = response.foods;
                        var orders = response.orders;
                        var lunchRequestDate = moment(lunch_request.date); // Ngày của yêu cầu

                        // Kiểm tra nếu yêu cầu còn mở
                        var isOpen = lunch_request.status === 'open' && lunchRequestDate.isSameOrAfter(now, 'day');

                        var content = `
                            <p><strong>Eatery:</strong> ${eatery.name}</p>
                            <p><strong>Address:</strong> ${eatery.address}</p>
                            <p><strong>Time:</strong> ${lunch_request.date}</p>
                            <p><strong>Food Items:</strong></p>
                            <ul>
                        `;

                        foods.forEach(function(food) {
                            content += `
                            <li>
                                ${food.name} - ${food.price} VND
                                ${isOpen ? `<button class="btn btn-primary order-button" 
                                    data-food-id="${food.id}" 
                                    data-lunch-request-id="${lunch_request.id}">Đặt món</button>` : ''}
                            </li>
                            `;
                        });
                        content += '</ul>';

                        // Hiển thị danh sách đơn hàng
                        content += '<h5>Orders:</h5><ul>';
                        orders.forEach(function(order) {
                            content += `
                                <li>
                                    ${order.name} - ${order.quantity} - ${order.note} - ${order.method}
                                    <button class="btn btn-warning edit-order" data-order-id="${order.id}">Edit</button>
                                    <button class="btn btn-danger delete-order" data-order-id="${order.id}">Delete</button>
                                </li>
                            `;
                        });
                        content += '</ul>';
                        modalBody.append(content);
                    } else {
                        modalBody.append('<p>No lunch requests for this date.</p>');
                    }

                    $('#lunchRequestModal').modal('show');
                }
            });
        }
    });

    // Xử lý khi bấm nút "Đặt món"
    $(document).on('click', '.order-button', function() {
        var foodId = $(this).data('food-id');
        var lunchRequestId = $(this).data('lunch-request-id');

        $('#foodId').val(foodId);
        $('#lunchRequestId').val(lunchRequestId);
        $('#orderModal').modal('show');
    });
});


        $('#saveOrderBtn').on('click', function() {
            var orderData = {
                foodId: $('#foodId').val(),
                quantity: $('#quantity').val(),
                note: $('#note').val(),
                orderType: $('#orderType').val(),
                lunchRequestId: $('#lunchRequestId').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
                // userId: $('#userId').val(),
            };
            console.log(orderData);
            $.ajax({
                url: '/save-lunch-order',
                method: 'POST',
                data: orderData,
                success: function(response) {
                    // console.log(response);
                    alert('Order saved successfully!');
                    $('#orderModal').modal('hide');
                    $('#foodId').val('');
                    $('#quantity').val('');
                    $('#note').val('');
                    $('#orderType').val('');
                    $('#lunchRequestId').val('');
                },
                error: function(xhr, status, error) {
                    alert('Failed to save order.');
                }
            });
        });

        $(document).on('click', '.edit-order', function() {
            var orderId = $(this).data('order-id');
            console.log('Order ID: ' + orderId);
            $.ajax({
                url: '/get-order/' + orderId,
                method: 'GET',
                success: function(response) {
                    console.log('API Response:', response);

                    if (response.success) {
                        var order = response.order;

                        console.log('Order:', order);

                        $('#editOrderId').val(order.id || '');
                        $('#editQuantity').val(order.quantity || '');
                        $('#editNote').val(order.note || '');
                        $('#editOrderType').val(order.method || '');
                        $('#editLunchRequestId').val(order.lunch_request_id || '');

                        $('#editOrderModal').modal('show');
                    } else {
                        alert('Failed to load order details.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('Failed to load order details.');
                }
            });

        });
        $('#saveEditOrderBtn').on('click', function() {
            var orderData = {
                orderId: $('#editOrderId').val(),
                quantity: $('#editQuantity').val(),
                note: $('#editNote').val(),
                orderType: $('#editOrderType').val(),
                lunchRequestId: $('#editLunchRequestId').val(),
            };
            console.log('lulu', orderData);
            $.ajax({
                url: '/update-order/' + orderData.orderId,
                method: 'POST',
                data: {
                    ...orderData,
                    _method: 'PUT', // Chuyển đổi thành phương thức PUT
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        alert('Order updated successfully!');
                        $('#editOrderModal').modal('hide');
                        $('#calendar').fullCalendar('refetchEvents'); // Cập nhật lại lịch
                    } else {
                        alert('Failed to update order.');
                    }
                }
            });
        });
        $(document).on('click', '.delete-order', function() {
            var orderId = $(this).data('order-id');
            $('#confirmDeleteOrderBtn').data('order-id', orderId);
            $('#deleteOrderModal').modal('show');
        });

        $(document).ready(function() {
            // Thiết lập CSRF Token cho tất cả các yêu cầu AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#confirmDeleteOrderBtn').on('click', function() {
                var orderId = $(this).data('order-id');
                $.ajax({
                    url: '/delete-order/' + orderId,
                    method: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            alert('Order deleted successfully!');
                            $('#deleteOrderModal').modal('hide');
                            $('#calendar').fullCalendar('refetchEvents'); // Cập nhật lại lịch
                        } else {
                            alert('Failed to delete order.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Xem chi tiết lỗi
                        alert('Failed to delete order.');
                    }
                });
            });
        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- jQuery 3 -->
    <script src="{{ asset('assets') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets') }}/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('assets') }}/bower_components/raphael/raphael.min.js"></script>
    <script src="{{ asset('assets') }}/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="{{ asset('assets') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets') }}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets') }}/bower_components/moment/min/moment.min.js"></script>
    <script src="{{ asset('assets') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="{{ asset('assets') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('assets') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('assets') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets') }}/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets') }}/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets') }}/dist/js/demo.js"></script>

    <script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <!-- fullCalendar -->
    <script src="{{ asset('assets') }}/bower_components/moment/moment.js"></script>
    <script src="{{ asset('assets') }}/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

    @include('layouts.footer')
</body>

</html>
