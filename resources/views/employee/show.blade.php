<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Date</th>
            <th>Order Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->customer->name }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Moi ngay chi co mot yeu cau an, khong the them yeu cau an neu bi trung ngay --}}
{{-- Nhung lunch_request khi da qua gio se tu dong dong, nguoi admin cos the dong truoc gio do, 
    khong the mo lai khi da qua thoi gian hien tai --}}
{{-- Check validate du lieu --}}
{{-- Nhap quan an cung ten cung dia chi -> loai --}}
{{-- Nhap mon khi quan an da co mon trung ten voi mon do roi --}}
{{-- Hien thong tien chi tiet ve lunch_request cho admin --}}
{{-- trang show nhung order da dat cua nguoi nhan vien do --}}