
$(()=>{

})
const login = (event) => {
    if (event) event.preventDefault()

    let email = $('#email').val()
    let senha = $('#senha').val()

    if(!email || !senha){
        showLottieToast({
            message: "Preencha os campos corretamente",
            type: "error",
            duration: 3500
        })
        return
    }

    const form = $('#form-login')[0]

    const data = new FormData(form)

    data.append('password', btoa(senha))

    const url = 'login-adega'

    $.ajax({
        type: 'POST',
        url: url,
        processData: false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        data: data,
        dataType: 'json',
        success: function(response){
            
            if(response.status == true){
                showLottieToast({
                    message: "Sucesso! Bem vindo!",
                    type: "success",
                    duration: 3500
                }).then(() => {
                    window.location.href = "home"
                })
            } else {
                showLottieToast({
                    message: response.message,
                    type: "error",
                    duration: 3500
                })
            }
        }

        
    })


}

$(document).on('click', '.btn-login', function(e) {
    login(e)
})

$(document).on('keydown', function(e) {
    if (e.key === "Enter") {
        login(e)
    }
})

