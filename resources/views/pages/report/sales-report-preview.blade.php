@extends('layout.sidenav-layout')


@section('title')
    Sales Report Preview
@endsection


@section('content')

    <style>
        .customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 16px !important;
        }

        .customers td, .customers th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }


        .customers tr:nth-child(even){background-color: #f2f2f2;}
        .customers tr:hover {background-color: #ddd;}
        .customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 6px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }
        .sales{
            padding-top: 30px;
            text-align: center;
        }
        .sales-1 {
            margin: 0 100px;
        }

    </style>

    <div class="sales-1">
        <h3 class="sales">Sales Report Preview</h3>

        <h3>Summary</h3>
        <table class="customers">
            <thead>
                <tr>
                    <th>Report</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Payable</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sales Report</td>
                    <td>{{$FromDate}} to {{$ToDate}}</td>
                    <td>{{$total}}</td>
                    <td>{{$discount}}</td>
                    <td>{{$vat}}</td>
                    <td>{{$payable}} </td>
                </tr>
            </tbody>
        </table>

        <h3>Details</h3>
        <table class="customers">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Payable</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                    <tr>
                        <td>{{$item->customer->name}}</td>
                        <td>{{$item->customer->mobile}}</td>
                        <td>{{$item->customer->email}}</td>
                        <td>{{$item->total }}</td>
                        <td>{{$item->discount }}</td>
                        <td>{{$item->vat }}</td>
                        <td>{{$item->payable }}</td>
                        <td>{{$item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ url('/sales-report-download', ['FromDate' => $FromDate, 'ToDate' => $ToDate]) }}" class="btn btn-primary mt-3">Download PDF</a>

    </div>

@endsection













{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <style>--}}
{{--        .customers {--}}
{{--            font-family: Arial, Helvetica, sans-serif;--}}
{{--            border-collapse: collapse;--}}
{{--            width: 100%;--}}
{{--            font-size: 12px !important;--}}
{{--        }--}}

{{--        .customers td, .customers th {--}}
{{--            border: 1px solid #ddd;--}}
{{--            padding: 8px;--}}
{{--        }--}}

{{--        .customers tr:nth-child(even){background-color: #f2f2f2;}--}}
{{--        .customers tr:hover {background-color: #ddd;}--}}
{{--        .customers th {--}}
{{--            padding-top: 12px;--}}
{{--            padding-bottom: 12px;--}}
{{--            padding-left: 6px;--}}
{{--            text-align: left;--}}
{{--            background-color: #04AA6D;--}}
{{--            color: white;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<h3>Sales Report Preview</h3>--}}

{{--<h3>Summary</h3>--}}
{{--<table class="customers">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>Report</th>--}}
{{--        <th>Date</th>--}}
{{--        <th>Total</th>--}}
{{--        <th>Discount</th>--}}
{{--        <th>Vat</th>--}}
{{--        <th>Payable</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--        <td>Sales Report</td>--}}
{{--        <td>{{$FromDate}} to {{$ToDate}}</td>--}}
{{--        <td>{{$total}}</td>--}}
{{--        <td>{{$discount}}</td>--}}
{{--        <td>{{$vat}}</td>--}}
{{--        <td>{{$payable}} </td>--}}
{{--    </tr>--}}
{{--    </tbody>--}}
{{--</table>--}}

{{--<h3>Details</h3>--}}
{{--<table class="customers">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>Customer</th>--}}
{{--        <th>Phone</th>--}}
{{--        <th>Email</th>--}}
{{--        <th>Total</th>--}}
{{--        <th>Discount</th>--}}
{{--        <th>Vat</th>--}}
{{--        <th>Payable</th>--}}
{{--        <th>Date</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach ($list as $item)--}}
{{--        <tr>--}}
{{--            <td>{{$item->customer->name}}</td>--}}
{{--            <td>{{$item->customer->mobile}}</td>--}}
{{--            <td>{{$item->customer->email}}</td>--}}
{{--            <td>{{$item->total }}</td>--}}
{{--            <td>{{$item->discount }}</td>--}}
{{--            <td>{{$item->vat }}</td>--}}
{{--            <td>{{$item->payable }}</td>--}}
{{--            <td>{{$item->created_at }}</td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}

{{--<a href="{{ url('/sales-report-download', ['FromDate' => $FromDate, 'ToDate' => $ToDate]) }}" class="btn btn-primary mt-3">Download PDF</a>--}}
{{--</body>--}}
{{--</html>--}}
