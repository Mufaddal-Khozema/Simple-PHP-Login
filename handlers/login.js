(async function app() {
    const formData = new FormData();
    formData.append("request_type", "loginUser");
    formData.append("email", email);
    formData.append("password", password);
    const res = await fetch('router.php', {
        method: 'POST',
        body: formData
    })
    const json = await res.json();
    if(json["success"]) {
        console.log("Here");
        window.location.href = "views/welcome.php"
    } 
})()

console.log(email, password);