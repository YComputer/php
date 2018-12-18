

<div class="content-wrapper">
    <div class="col-md-6">
        <h3 class="log-title"> Login </h3>
        <form id="login">
            <div class="form-group">
                <label>Email</label>
                <input id="email" type="text" class="form-control" name="email" >
            </div>
            <div class="form-group">
                <label>Pwd</label>
                <input id="pwd" type="password" class="form-control" name="pwd">
            </div>
            <input id="nonces" type="hidden" name="nonces" value="<?=$_SESSION['nonces']?>">
            <button type="button" class="btn btn-primary btn-login" >Login</button>
            <button type="button" class="btn btn-primary btn-signUp" >SignUp</button>
        </form>
	</div>
</div>

<script>
    //  method="post" action="/login/login"
    var logIn = {
        init:function(){
            this.login();
            this.signUp();
        },
        login:function(){
            $('#login').on('click','.btn-login',function(){
                var pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                var formValue = $('#login').serializeArray();
                var values = {};
                for (x in formValue) {
                    if (formValue[x].value) {
                        values[formValue[x].name] = formValue[x].value;
                    } else {
                        alert(formValue[x].name + ' is required')
                        return false;
                    }
                }
                if (!pattern.test(values['email'])){
                    alert('请填写正确邮箱')
                    return false; 
                }
                $.ajax({
                    type: "post",
                    data: values,
                    url: "./Login/Login",
                    dataType: 'json',
                    success: function(data) {
                        if(data.status == 2){
                            if(data.data.role == 0){
                                window.location.href = window.location.href.split('login')[1]+'admin';
                            } else if(data.data.role == 1) {
                                window.location.href = window.location.href.split('login')[1]+'home';
                            }
                        }else {
                            alert('email or pwd error')
                        }
                    },
                    error: function() {
                        alert("ajax error");
                    }
                });
            })
        },
        signUp:function(){
            $('#login').on('click','.btn-signUp',function(){
                var pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                var formValue = $('#login').serializeArray();
                var values = {};
                for (x in formValue) {
                    if (formValue[x].value) {
                        values[formValue[x].name] = formValue[x].value;
                    } else {
                        alert(formValue[x].name + ' is required')
                        return false;
                    }
                }
                if (!pattern.test(values['email'])){
                    alert('请填写正确邮箱')
                    return false; 
                }
                $.ajax({
                    type: "post",
                    data: values,
                    url: "./Login/SignUp",
                    dataType: 'json',
                    success: function(data) {
                        if(data.status == 2){
                            alert('success');
                        }else {
                            alert(data.data);
                        }
                    }
                })
            })
        }
    }
    logIn.init();

</script>