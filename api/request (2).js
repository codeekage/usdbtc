function doRegistration() {
    var user = {
        username: $("#username").val(),
        password: $("#passowrd").val(),
        first_name: $("#first_name").val(),
        last_name: $("#last_name").val(),
        middle_name: $("#middle_name").val(),
        email: $("#email").val(),
        state: $("#state").val(),
        nation: $("#nation").val(),
        phone_number: $("#phone_number").val(),
        acct_number: $("#acct_number").val()
    };


    if (typeof user.email === 'undefined') {
        alert(50)
    }
    /*
        $.post("post-request.php?api_key=AFROSOFTdev907yUgkiLLMisTER", {
            username : user.username,
            password : user.password,
            first_name : user.first_name,
            last_name : user.last_name
        }, function(data, status){
            console.log(data, status);
        })*/


}