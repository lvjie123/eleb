@extends('layout.app')

@section('contents')
    <script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
    <h1>一周订单量统计图</h1>
    <table class="table table-bordered">
        <tr>
            @foreach($datas as $data => $v)
            <td>{{ $data }}</td>
            @endforeach
        </tr>
        <tr>
            @foreach($datas as $data => $v)
                <td>{{ $v }}</td>
            @endforeach
        </tr>
    </table>
    <div id="main" style="width: 800px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '按日统计订单量'
            },
            tooltip: {},
            legend: {
                data:['订单量']
            },
            xAxis: {
                data: {!! json_encode(array_keys($datas)) !!}
            },
            yAxis: {},
            series: [{
                name: '订单量',
                type: 'bar',
                data: {!! json_encode(array_values($datas)) !!}
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    <h1>三月订单量统计图</h1>
    <table class="table table-bordered">
        <tr>
            @foreach($datass as $d => $s)
                <td>{{ $d }}</td>
            @endforeach
        </tr>
        <tr>
            @foreach($datass as $d => $v)
                <td>{{ $v }}</td>
            @endforeach
        </tr>
    </table>
    <div id="mains" style="width: 800px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('mains'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '按月统计订单量'
            },
            tooltip: {},
            legend: {
                data:['订单量']
            },
            xAxis: {
                data: {!! json_encode(array_keys($datass)) !!}
            },
            yAxis: {},
            series: [{
                name: '订单量',
                type: 'bar',
                data: {!! json_encode(array_values($datass)) !!}
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    @stop