@extends('layout.app')

@section('contents')
    <script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
    <h1>三个月菜品统计图</h1>
    <table class="table table-bordered">
            <thead>
            <tr>
                <th>商品名称</th>
                @foreach($week as $key=>$value)
                    <th>{{$value}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $key=>$value)
                @foreach($result as $kk=>$vv)
                    <tr>
                        @if($key==$kk)
                            <th>{{$value}}</th>
                            @foreach($vv as $vvv)
                                <th>{{$vvv}}</th>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
        {{--@if($keyword==0)--}}
        {{--<h1>最近七天订单总数表</h1>--}}
        {{--@else--}}
        {{--<h1>最近三个月订单总数表</h1>--}}
        {{--@endif--}}
        <div id="main" style="width: 800px;height:400px;"></div>
        <script type="text/javascript">
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('main'));
            // 指定图表的配置项和数据
            option = {
                title: {
                    text: '三个月菜品统计图'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data:{!! json_encode($menus) !!}
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: {!! json_encode($week) !!}
                },
                yAxis: {
                    type: 'value'
                },
                series:{!! json_encode($series) !!}
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        </script>
        </div>

@stop