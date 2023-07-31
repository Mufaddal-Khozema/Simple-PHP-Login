(async function app() {
    const formData = new FormData();
    formData.append("request_type", "createUser");
    formData.append("email", email);
    formData.append("password", password);
    formData.append("cpassword", cpassword);
    const res = await fetch('router.php', {
        method: 'POST',
        body: formData
    })
    // console.log(await res);
    const json = await res.json();
    if(json["success"]){
        window.location.href = "views/login.php"
    }
})()
console.log(email, password, cpassword);