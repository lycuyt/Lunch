<!DOCTYPE html>
<html>

<head>
    <title>Lunch Requests Calendar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="text-center text-primary"><u>Lunch Requests Calendar</u></h1>

        <div id="calendar"></div>
        <!-- Modal -->
        <div class="modal fade" id="lunchRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
        <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel"
            aria-hidden="true">
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
                                <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                                    required>
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

                            if (response.lunch_request) { // Chỉnh lại điều kiện kiểm tra
                                var lunch_request = response.lunch_request;
                                var eatery = response.eateries[
                                0]; // Lấy đúng eatery (phần tử đầu tiên)
                                var foods = response.foods;
                                var orders = response.orders;
                                var lunchRequestId = lunch_request[0].id;

                                // Tạo nội dung hiển thị thời gian và món ăn
                                var content = `
                                    <p><strong>Eatery:</strong> ${eatery.name}</p>
                                    <p><strong>Address:</strong> ${eatery.address}</p>
                                    <p><strong>Time:</strong> ${moment(lunch_request.date).format('YYYY-MM-DD HH:mm:ss')}</p>
                                    <p><strong>Food Items:</strong></p>
                                    <ul>
                                `;
                                foods.forEach(function(food) {
                                    content += `
                                <li>
                                    ${food.name} - ${food.price} VND
                                    <button class="btn btn-primary order-button" 
                                    data-food-id="${food.id}" 
                                    data-lunch-request-id="${lunchRequestId}">Đặt món</button>
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
                var userId = $(this).data('user-id');

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
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
