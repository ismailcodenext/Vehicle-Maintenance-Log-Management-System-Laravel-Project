<div class="login-bg" style="background: url({{asset('images/login_bg.jpg')}});">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card p-4 login_card" style="background: #fff">
                <div class="card-body p-0">
                    <div class="login_logo">
                        <img class="nav-logo"  src="{{asset('images/logo.jpg')}}"  style="width: 100px; height:100px; margin: 0 auto 10px; display: block;" alt="logo"/>
                        <h2>Vehicle Maintenance Log Management System</h2>
                    </div>
                    <h2 style="text-align: center">Login</h2>
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control login_form_input" type="email"/>
                    <br/>
                    <input id="password" placeholder="User Password" class="form-control login_form_input" type="password"/>
                    <br/>
                    <button onclick="SubmitLogin()" class="btn w-100 update_btn mt-2">Sign In</button>

{{--                    <div class="float-end mt-3">--}}
{{--                        <span>--}}
{{--                            <a class="text-center ms-3 text-dark" href="{{url('/registration')}}" style="font-size: 16px;">Sign Up </a>--}}
{{--                            <span class="ms-1 text-dark">|</span>--}}
{{--                            <a class="text-center ms-1 text-dark" href="{{url('/sendOtp')}}" style="font-size: 16px;">Forget Password</a>--}}
{{--                        </span>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>

  async function SubmitLogin() {
            let email=document.getElementById('email').value;
            let password=document.getElementById('password').value;

            if(email.length===0){
                errorToast("Email is required");
            }
            else if(password.length===0){
                errorToast("Password is required");
            }
            else{
                showLoader();
                let res=await axios.post("/user-login",{email:email, password:password});
                hideLoader()
                if(res.status===200 && res.data['status']==='success'){
                    setToken(res.data['token'])
                    window.location.href="/dashboardSummary";
                }
                else{
                    errorToast(res.data['message']);
                }
            }
    }


</script>
<style>
    .login-bg-img{
        background-image: url({{asset('front-end/assets/image/login-bg-img.jpg')}});
        width: 100%;
        height: 100vh;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center
    }

    .card{
        background-color: rgb(212, 212, 212);
        opacity: 0.9;
    }
</style>
