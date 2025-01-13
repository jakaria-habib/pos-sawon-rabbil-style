<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label style="font-size: 16px;font-weight: 600;">Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label style="font-size: 16px;font-weight: 600;">First Name</label>
                                <input id="first_name" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label style="font-size: 16px;font-weight: 600;">Last Name</label>
                                <input id="last_name" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label style="font-size: 16px;font-weight: 600;">Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label style="font-size: 16px;font-weight: 600;">Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100  bg-gradient-primary" style="font-size: 18px;font-weight: 600;">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    async function onRegistration() {


            let email = document.getElementById('email').value;
            let first_name = document.getElementById('first_name').value;
            let last_name = document.getElementById('last_name').value;
            let mobile = document.getElementById('mobile').value;
            let password = document.getElementById('password').value;


            if(email.length === 0) {
                errorToast('Email ID is required')
            }
            else if(first_name.length === 0) {
                errorToast('First Name is required')
            }
            else if(last_name.length === 0) {
                errorToast('Last Name is required')
            }
            else if(mobile.length === 0) {
                errorToast('Mobile Number is required')
            }
            else if(password.length === 0) {
                errorToast('Password is required')
            }
            else {
                showLoader();
                let res = await axios.post('/user-registration',{
                    email: email,
                    first_name:first_name,
                    last_name:last_name,
                    mobile:mobile,
                    password:password
                })
                hideLoader();

                if(res.status===200 && res.data['status'] === 'success'){
                    successToast('Registration is successful');
                    setTimeout(function (){
                        window.location.href = '/login-page';
                    },500)

                }
                else{
                    errorToast('Registration is failed')
                }
            }








    //
    //     let email = document.getElementById('email').value;
    //     let first_name = document.getElementById('first_name').value;
    //     let last_name = document.getElementById('last_name').value;
    //     let mobile = document.getElementById('mobile').value;
    //     let password = document.getElementById('password').value;
    //
    //     if(email.length===0){
    //         errorToast('Email is required')
    //     }
    //     else if(first_name.length===0){
    //         errorToast('First Name is required')
    //     }
    //     else if(last_name.length===0){
    //         errorToast('Last Name is required')
    //     }
    //     else if(mobile.length===0){
    //         errorToast('Mobile is required')
    //     }
    //     else if(password.length===0){
    //         errorToast('Password is required')
    //     }
    //     else{
    //         showLoader();
    //         let res = await axios.post("/user-registration",{
    //             email:email,
    //             first_name:first_name,
    //             last_name:last_name,
    //             mobile:mobile,
    //             password:password
    //         })
    //         hideLoader();
    //         if(res.status===200 && res.data['status']==='success'){
    //             successToast(res.data['message']);
    //             setTimeout(function (){
    //                 window.location.href='/login-page'
    //             },1000)
    //         }
    //         else{
    //             errorToast(res.data['message'])
    //         }
    //     }
    }
</script>

