<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="" id="deleteID"/>

            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn mx-2 bg-gradient-primary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="deleteItem()" type="button" id="confirmDelete" class="btn  bg-gradient-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    async function deleteItem()
    {
        document.getElementById('delete-modal-close').click();
        let customer_id = document.getElementById('deleteID').value;

        showLoader();
        let res = await axios.post('/customer-delete',{customer_id:customer_id});
        hideLoader();

        if(res.status === 200 && res.data ===1){
            successToast('Request successful')
            await getList();
        }
        else {
            errorToast('Request Failed')
        }




    }


























    // async  function  itemDelete(){
    //     let id=document.getElementById('deleteID').value;
    //     document.getElementById('delete-modal-close').click();
    //     showLoader();
    //     let res=await axios.post("/delete-customer",{id:id})
    //     hideLoader();
    //     if(res.data===1){
    //         successToast("Request completed")
    //         await getList();
    //     }
    //     else{
    //         errorToast("Request fail!")
    //     }
    // }
</script>

