<div class="login-bg" style="background: url({{asset('images/login_bg.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 center-screen">
                <div class="card animated fadeIn p-3 login_card" style="background: #fff">
                    <div class="card-body" style="padding: 0">
                        <div class="login_logo">
                            <img class="nav-logo"  src="{{asset('images/logo.jpg')}}"  style="width: 40px; height:40px; margin: 0 auto 10px; display: block;" alt="logo"/>
                            <h2>Vehicle Maintenance Log Management System</h2>
                        </div>
                        <h2 style="text-align: center">Sign Up</h2>
                        <div class="container-fluid m-0 p-0">
                            <div class="row m-0 p-0">
                                <div class="col-12 p-0 mt-3">
                                    <input id="firstName" placeholder="First Name" class="form-control login_form_input" type="text"/>
                                </div>
                                <div class="col-12 p-0 mt-3">

                                    <input id="lastName" placeholder="Last Name" class="form-control login_form_input" type="text"/>
                                </div>

                                <div class="col-12 p-0 mt-3">
                                    <input id="email" placeholder="User Email" class="form-control login_form_input" type="email"/>
                                </div>

                                <div class="col-12 p-0 mt-3">
                                    <input id="mobile" placeholder="Mobile" class="form-control login_form_input" type="mobile"/>
                                </div>
                                <div class="col-12 p-0 mt-3">
                                    <input id="password" placeholder="User Password" class="form-control login_form_input" type="password"/>
                                </div>
                            </div>

                            <input id="status" value="pending" class="form-control" type="hidden"/>
                            <input id="role" value="user" class="form-control" type="hidden"/>

                            <div class="col-12">
                                <div class="d-flex align-items-center mt-3">
                                    <img class="me-2" style="width: 18%" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                    <div>
                                        <label class="form-label">Image</label>
                                        <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="img_url">
                                    </div>
                                </div>
                            </div>


                            <div class="row m-0 p-0">
                                <div class="col-md-4 mx-auto text-center p-2">
                                    <button onclick="onRegistration()" class="btn mt-3 mx-auto text-center update_btn">Sign Up</button>
                                </div>
                            </div>

                            <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 text-dark" href="{{url('/')}}" style="font-size: 16px;">Sign In </a>
                            <span class="ms-1 text-dark">|</span>
                            <a class="text-center ms-1 text-dark" href="{{url('/sendOtp')}}" style="font-size: 16px;">Forget Password</a>
                        </span>
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
        let formData = new FormData(); // Create a new FormData object

        let imgInput = document.getElementById('img_url');
        let imgFile = imgInput.files[0];
        formData.append('img', imgFile); // Append the image file to the FormData object

        formData.append('firstName', document.getElementById('firstName').value);
        formData.append('lastName', document.getElementById('lastName').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);
        formData.append('mobile', document.getElementById('mobile').value);
        formData.append('status', document.getElementById('status').value);
        formData.append('role', document.getElementById('role').value);

        try {
            showLoader();
            let res = await axios.post("/user-registration", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data' // Set the content type to multipart/form-data
                }
            });
            hideLoader();
            if (res.status === 200 && res.data['status'] === 'success') {
                window.location.href = "/vlmms-login-page";
            } else {
                errorToast(res.data['message']);
            }
        } catch (error) {
            hideLoader();
            errorToast('An error occurred during registration. Please try again later.');
            console.error(error);
        }
    }

</script>
