function doRegistration(){
    var user = {
        username :  document.getElementById("user_name").firstElementChild.value,
        password :  document.getElementById("password").firstElementChild.value,
        first_name :  document.getElementById("first_name").firstElementChild.value,
        last_name :  document.getElementById("last_name").firstElementChild.value,
        middle_name :  document.getElementById("middle_name").firstElementChild.value,
        email :  document.getElementById("email").firstElementChild.value,
        phone_number : document.getElementById("phone_number").firstElementChild.value
    };

   $.post("http://localhost/afrosoft-bitcoin/api/post_request.php?api_key=AFROSOFTdev907yUgkiLLMisTER", {
       post : "register",
       username : user.username,
       password : user.password,
       first_name : user.first_name,
       last_name : user.last_name,
       middle_name : user.middle_name,
       email : user.email,
       state : "Texas",
       city : "Alabama",
       nation : "USA",
       clocation: "Nigeria",
       phone_number : user.phone_number,
       acct_number : 123456789

   }, function(data, status){
       var json_response = JSON.parse(data);
       console.log(json_response)
   });


}

function login(){

    var user = {
        email : document.getElementById("email").firstElementChild.value,
        password : document.getElementById("password").firstElementChild.value,
        username : document.getElementById("email").firstElementChild.value
    }

    $.post("http://localhost/afrosoft-bitcoin/api/post_request.php?api_key=AFROSOFTdev907yUgkiLLMisTER", {
        post: "login",
        email : user.email,
        password : user.password,
        username : user.username

    }, function (data, status) {
        var json_response = JSON.parse(data);

        if(json_response.success == true){
            window.location = "home.html";
        }

    })
}