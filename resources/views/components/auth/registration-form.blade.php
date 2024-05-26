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
                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="img_url">
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>

{{--                        <input id="status" value="approved" class="form-control" type="hidden"/>--}}
{{--                        <input id="role" value="user" class="form-control" type="hidden"/>--}}
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100  bg-gradient-primary">Complete</button>
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
            window.location.href = "/diagnostic-login-page";
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
