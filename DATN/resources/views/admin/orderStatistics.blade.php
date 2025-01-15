@extends('shared._layoutAdmin')
@section('title', 'Quản lý Banner')

@section('content')
<h2 class="title_page">Thống kê Đơn Hàng</h2>
<form action="{{ route('admin.orderStatistics') }}" method="GET">
    <div class="row mx-auto">
        <label for="year" class="block text-sm font-medium">Thống kê theo năm</label>
        <select name="year" id="year" class="p-2 border rounded">
            @foreach(range(now()->year - 10, now()->year) as $y)
            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
        <button type="submit" class="box_log">Xác nhận</button>
    </div>
</form>
    <div class="box_content">
    <div class="content px-3">
        <table class="table table-striped mt-4">
            <thead class="thead">
                <tr>
                    <th style="width: 80px;" scope="col">Tháng</th>
                    <th style="width: 150px;text-align: start " scope="col">Số lượng tour đã đặt</th>
                    <th style="width: 150px;text-align: start " scope="col">Số lượng tour đã chưa thanh toán</th>
                    <th style="width: 150px;text-align: start " scope="col">Số lượng tour đã thanh toán</th>
                    <th style="width: 200px;" scope="col">Tổng tiền chưa thanh toán</th>
                    <th style="width: 200px;">Tổng tiền đã thanh toán</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyStatistics as $stat)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $stat['month'] }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ $stat['total_orders'] }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ $stat['pending_orders'] }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ $stat['paid_orders'] }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ number_format($stat['total_pending'], 0, ',', '.') }} đ</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ number_format($stat['total_paid'], 0, ',', '.') }} đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

  <h2>Thống kê theo tháng</h2>
    <canvas id="monthlyChart" width="400" height="200"></canvas>

    
    <h2>Thống kê theo ngày</h2>
    <canvas id="dailyChart" width="400" height="200"></canvas>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            var monthlyData = {!! $monthlyStatisticsJSON !!};
            var monthlyLabels = monthlyData.map(item => 'Tháng ' + item.month);

            var ctxMonthly = document.getElementById('monthlyChart');
            if (ctxMonthly) {
                var ctxMonthlyChart = ctxMonthly.getContext('2d');
                var monthlyChart = new Chart(ctxMonthlyChart, {
                    type: 'bar',
                    data: {
                        labels: monthlyLabels,
                        datasets: [
                            {
                                label: 'Tổng đơn hàng',
                                data: monthlyData.map(item => item.total_orders),
                                backgroundColor: 'blue',
                            },
                            {
                                label: 'Số đơn chờ xử lý',
                                data: monthlyData.map(item => item.pending_orders),
                                backgroundColor: 'orange',
                            },
                            {
                                label: 'Số đơn đã thanh toán',
                                data: monthlyData.map(item => item.paid_orders),
                                backgroundColor: 'green',
                            },
                            {
                                label: 'Doanh thu',
                                data: monthlyData.map(item => item.total_paid),
                                backgroundColor: 'red',
                            },
                           
                        ]
                    }
                });
            }

            var dailyData = {!! $dailyStatisticsJSON !!};
            var dailyLabels = dailyData.map(item => item.date);

            var ctxDaily = document.getElementById('dailyChart');
            if (ctxDaily) {
                var ctxDailyChart = ctxDaily.getContext('2d');
                var dailyChart = new Chart(ctxDailyChart, {
                    type: 'line',
                    data: {
                        labels: dailyLabels,
                        datasets: [
                            {
                                label: 'Tổng đơn hàng',
                                data: dailyData.map(item => item.total_orders),
                                borderColor: 'purple',
                                fill: false,
                            }
                        ]
                    }
                });
            }
        });
    </script>

@endsection