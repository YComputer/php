

<div class="content-wrapper">
    <div class="col-md-6">
        <h3> Login </h3>
        <form id="login">
            <div class="form-group">
                <label>Email</label>
                <input id="email" type="text" class="form-control" name="email" >
            </div>
            <div class="form-group">
                <label>Pwd</label>
                <input id="pwd" type="password" class="form-control" name="pwd">
            </div>
            <button type="button" class="btn btn-primary" value="Submit">Submit</button>
        </form>
	</div>
</div>

<script>
    //  method="post" action="/login/login"
    var logIn = {
        init:function(){
            this.login();
        },
        login:function(){
            $('#login').on('click','.btn-primary',function(){
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
                $.ajax({
                    type: "post",
                    data: values,
                    url: "./Login/Login",
                    dataType: 'json',
                    success: function(data) {
                        if(data.data.role == 0){
                            window.location.href = window.location.href.split('login')[1]+'admin';
                        } else if(data.data.role == 1) {
                            window.location.href = window.location.href.split('login')[1]+'home';
                        }else {
                            alert('email or pwd error')
                        }
                    },
                    error: function() {
                        alert("ajax error");
                    }
                });
            })
        }
    }
    logIn.init();

</script>