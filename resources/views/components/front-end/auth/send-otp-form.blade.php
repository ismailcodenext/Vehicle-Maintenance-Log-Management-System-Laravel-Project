
<div class="login-bg" style="background: url({{asset('images/login_bg.jpg')}});">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4 card_wrapper">
                <div class="card-body card_body_wrapper">
                    <h4 >EMAIL ADDRESS</h4>
                    <br/>
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control login_form_input" type="email"/>
                    <br/>
                    <button onclick="SentOTP()"  class="btn w-100 float-end bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
   async function SentOTP() {

       let postBody={"email":document.getElementById('email').value,}
       showLoader();
       let res=await axios.post("/send-otp",postBody);
       hideLoader()
       if(res.status===200 && res.data['status']==='success'){
           sessionStorage.setItem("email",document.getElementById('email').value);
           window.location.href="/verifyOtp";
       }
       else{
           errorToast(res.data['message']);
       }
    }
</script>
