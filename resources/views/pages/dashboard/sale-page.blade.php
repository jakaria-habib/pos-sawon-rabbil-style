@extends('layout.sidenav-layout')

@section('title')
    Sales Page
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div class="row">
                        <div class="col-8">
                            <span class="text-bold text-dark">BILLED TO </span>
                            <p class="text-xs mx-0 my-1">Name:  <span id="CName" style="color: #a4088a"></span> </p>
                            <p class="text-xs mx-0 my-1">Email:  <span id="CEmail" style="color: #a4088a"></span></p>
                            <p class="text-xs mx-0 my-1">Customer ID:  <span id="CId" style="color: #a4088a"></span> </p>
                        </div>
                        <div class="col-4">
                            <img class="w-50" src="{{"images/logo.png"}}">
                            <p class="text-bold mx-0 my-1 text-dark">Invoice  </p>
                            <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }} </p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary"/>
                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="invoiceTable">
                                <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Name</td>
                                    <td>Qty</td>
                                    <td>Total</td>
                                    <td>Remove</td>
                                </tr>
                                </thead>
                                <tbody  class="w-100" id="invoiceList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary"/>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-bold text-xs my-1 text-dark"> TOTAL: Tk. <span id="total"></span></p>
                            <p class="text-bold text-xs my-2 text-dark"> PAYABLE: Tk. <span id="payable"></span></p>
                            <p class="text-bold text-xs my-1 text-dark"> VAT(5%): Tk. <span id="vat"></span></p>
                            <p class="text-bold text-xs my-1 text-dark"> Discount: Tk. <span id="discount"></span></p>
                            <span class="text-xxs">Discount(%):</span>
                            <input onkeydown="return false" value="0" min="0" type="number" step="0.25" onchange="discountChange()" class="form-control w-40 " id="discountP"/>
                            <p>
                                <button onclick="createInvoice()" class="btn  my-3 bg-gradient-primary w-40">Confirm</button>
                            </p>
                        </div>
                        <div class="col-12 p-2">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <table class="table  w-100" id="productTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Product</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="productList">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <table class="table table-sm w-100" id="customerTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Customer</td>
                            <td>Mobile</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="customerList">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- product modal --}}
    <div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label">Product ID *</label>
                                    <input type="text" class="form-control" id="PId">
                                    <label class="form-label mt-2">Product Name *</label>
                                    <input type="text" class="form-control" id="PName">
                                    <label class="form-label mt-2">Product Price *</label>
                                    <input type="text" class="form-control" id="PPrice">
                                    <label class="form-label mt-2">Product Qty *</label>
                                    <input type="text" class="form-control" id="PQty">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="add()" id="save-btn" class="btn bg-gradient-success" >Add</button>
                </div>
            </div>
        </div>
    </div>


    <script>


        (async ()=>{
            showLoader();
            await  customerList();
            await productList();
            hideLoader();
        })();

        let invoiceItemList = [];

        // customerList();
        async function customerList(){
            let res = await axios.get('/customer-list');

            let customerTable = $('#customerTable')
            let customerList = $('#customerList')

            customerTable.DataTable().destroy();
            customerList.empty();

            res.data.forEach( function(item, index){

                let row = `<tr>
                            <td>${item['name']}</td>
                            <td>${item['mobile']}</td>
                            <td><a data-name="${item['name']}" data-email ="${item['email']}" data-id='${item['id']}' class="btn btn-outline-dark addCustomer text-xxs px-2 py-1  btn-sm m-0" >Add</a></td>
                        </tr>`
                customerList.append(row);

            })

            $('.addCustomer').on('click', async function (){

                let name = $(this).data('name');
                let email = $(this).data('email');
                let id = $(this).data('id');

                $('#CName').text(name)
                $('#CEmail').text(email)
                $('#CId').text(id)

            })

            new DataTable('#customerTable',{
                        order:[[0,'asc']],
                        scrollCollapse: false,
                        info: false,
                        lengthChange: false
                    });

        }

        // productList();
        async function productList(){

            let res = await axios.get('/product-list');

            let productTable = $('#productTable');
            let productList = $('#productList');

            productTable.DataTable().destroy();
            productList.empty();


            res.data.forEach(function (item, index){

                let row =` <tr>
                    <td>${item['name']} (Tk. ${item['price']})</td>
                    <td><a data-name=${item['name']} data-price="${item['price']}" data-id="${item['id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProduct  btn-sm m-0" >Add</a></td>
                </tr>`

                productList.append(row);
            })

            $('.addProduct').on('click',async function (){

                let name = $(this).data('name');
                let price = $(this).data('price');
                let PId = $(this).data('id');

                document.getElementById('PId').value=PId;
                document.getElementById('PName').value=name;
                document.getElementById('PPrice').value=price;

                $('#create-modal').modal('show');

            })
            new DataTable('#productTable',{
                        order:[[0,'asc']],
                        scrollCollapse: false,
                        info: false,
                        lengthChange: false
                    });
        }

        function add(){

            let product_id = document.getElementById('PId').value;
            let product_name= document.getElementById('PName').value;
            let product_price = document.getElementById('PPrice').value;
            let product_qty = document.getElementById('PQty').value;
            let sale_price = parseFloat(product_price)*parseFloat(product_qty).toFixed(2);

            if(product_id.length===0){
                errorToast('Product ID is required')
            }
            else if(product_name.length===0){
                errorToast('Product Name is required')
            }
            else if(product_price.length===0){
                errorToast('Product Price is required')
            }
            else if(product_qty.length===0){
                errorToast('Product Quantity is required')
            }
            else {
                let item= {product_id:product_id, product_name:product_name,product_qty:product_qty,sale_price:sale_price};
                invoiceItemList.push(item);
                // console.log(InvoiceItemList);
                $('#create-modal').modal('hide')
                showInvoiceItem();
            }
        }

        function showInvoiceItem(){

            let invoiceList = $('#invoiceList');
            invoiceList.empty();

            invoiceItemList.forEach(function (item, index){
                let row=`<tr class="text-xs">
                            <td>${item['product_name']}</td>
                            <td>${item['product_qty']}</td>
                            <td>${item['sale_price']}</td>
                            <td><a data-index="${index}" class="btn removeBtn text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
                     </tr>`
                invoiceList.append(row)
            })

            calculateGrandTotal();

            $('.removeBtn').on('click', async function () {
                let index= $(this).data('index');
                invoiceItemList.splice(index,1);
                showInvoiceItem();
            })

        }

        function discountChange() {
            calculateGrandTotal();
        }


        function calculateGrandTotal(){

            let total=0;
            let vat=0;
            let payable=0;
            let discount=0;
            let discountPercentage = (parseFloat(document.getElementById('discountP').value));

            invoiceItemList.forEach((item,index)=>{
                total = total + parseFloat(item['sale_price']) // here, total is a numeric value, total = 0 that's why i don't use parseFloat(total), so no need ot use parse float
            })

            if(discountPercentage===0){
                vat= ((total*5)/100).toFixed(2);
            }
            else {
                discount=((total*discountPercentage)/100).toFixed(2);
                total=(total- discount).toFixed(2);
                vat= ((total*5)/100).toFixed(2);
            }

            payable=(parseFloat(total)+parseFloat(vat)).toFixed(2);

            document.getElementById('total').innerText    = total;
            document.getElementById('payable').innerText  = payable;
            document.getElementById('vat').innerText      = vat;
            document.getElementById('discount').innerText = discount;
        }



        async function createInvoice(){

            let total = document.getElementById('total').innerText;
            let vat = document.getElementById('vat').innerText;
            let discount = document.getElementById('discount').innerText;
            let payable = document.getElementById('payable').innerText;
            let customer_id = document.getElementById('CId').innerText;

            let Data = {
                'total':total,
                'vat':vat,
                'discount':discount,
                'payable':payable,
                'customer_id':customer_id,
                'products':invoiceItemList
            }


            if(customer_id.length===0){
                errorToast('Customer is required')
            }
            else if(invoiceItemList.length===0){
                errorToast('Product is required')
            }
            else{
                showLoader();
                let res = await axios.post('/invoice-create', Data);
                hideLoader();
                if(res.status===200){
                    successToast('Invoice created')
                    window.location.href='/invoice-page'
                }
                else{
                    errorToast('Something Went Wrong !')
                }
            }
        }


    </script>

@endsection
