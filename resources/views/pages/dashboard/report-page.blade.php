@extends('layout.sidenav-layout')

@section('title')
    Report Page
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Sales Report</h4>
                        <label class="form-label mt-2">Date From</label>
                        <input id="FromDate" type="date" class="form-control"/>
                        <label class="form-label mt-2">Date To</label>
                        <input id="ToDate" type="date" class="form-control"/>
                        <button onclick="salesReportPreview()" class="btn mt-3 bg-gradient-primary">Report Preview</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

    function salesReportPreview() {
        let FromDate = document.getElementById('FromDate').value;
        let ToDate = document.getElementById('ToDate').value;
        if(FromDate.length === 0 || ToDate.length === 0){
            errorToast("Date Range Required !")
        }else{
            window.open('/sales-report-preview/'+FromDate+'/'+ToDate);
        }
    }

</script>
