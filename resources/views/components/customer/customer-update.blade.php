<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">

                                <label class="form-label mt-3">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">

                                <label class="form-label mt-3">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate">

                                <input type="text" class="" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>
        </div>
    </div>
</div>


<script>


    async function fillUpUpdateForm(id)
    {
        document.getElementById('updateID').value = id;

        let res = await axios.post('/customer-by-id',{id:id});

        document.getElementById('customerNameUpdate').value = res.data['name'];
        document.getElementById('customerEmailUpdate').value = res.data['email'];
        document.getElementById('customerMobileUpdate').value = res.data['mobile'];

    }

    async function Update()
    {
     let name = document.getElementById('customerNameUpdate').value;
     let email = document.getElementById('customerEmailUpdate').value;
     let mobile = document.getElementById('customerMobileUpdate').value;
     let customer_id = document.getElementById('updateID').value;
     if(name.length===0){
         errorToast('Customer name required')
     }
     else if(email.length===0){
         errorToast('Customer email required')
     }
     else if(mobile.length===0) {
         errorToast('Customer mobile required')
     }
     else
     {
         document.getElementById('update-modal-close').click();
         showLoader();
         let res = await axios.post('/customer-update',{ name:name, email:email, mobile:mobile,id:customer_id});
         hideLoader();
         if( res.status === 200) {
             successToast('Request successful');
             document.getElementById('update-form').reset();
             await getList();
         }
         else{
             errorToast('Request fail')
         }



     }




    }































//    async function FillUpUpdateForm(id){
//        document.getElementById('updateID').value=id;
//        showLoader();
//        let res=await axios.post("/customer-by-id",{id:id})
//        hideLoader();
//        document.getElementById('customerNameUpdate').value=res.data['name'];
//        document.getElementById('customerEmailUpdate').value=res.data['email'];
//        document.getElementById('customerMobileUpdate').value=res.data['mobile'];
//    }
//
//
//    async function Update() {
//
//        let customerName = document.getElementById('customerNameUpdate').value;
//        let customerEmail = document.getElementById('customerEmailUpdate').value;
//        let customerMobile = document.getElementById('customerMobileUpdate').value;
//        let updateID = document.getElementById('updateID').value;
//
//
//        if (customerName.length === 0) {
//            errorToast("Customer Name Required !")
//        }
//        else if(customerEmail.length===0){
//            errorToast("Customer Email Required !")
//        }
//        else if(customerMobile.length===0){
//            errorToast("Customer Mobile Required !")
//        }
//        else {
//
//            document.getElementById('update-modal-close').click();
//
//            showLoader();
//
//            let res = await axios.post("/update-customer",{name:customerName,email:customerEmail,mobile:customerMobile,id:updateID})
//
//            hideLoader();
//
//            if(res.status===200 && res.data===1){
//
//                successToast('Request completed');
//
//                document.getElementById("update-form").reset();
//
//                await getList();
//            }
//            else{
//                errorToast("Request fail !")
//            }
//        }
//    }

</script>

