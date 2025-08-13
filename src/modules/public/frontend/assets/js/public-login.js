
const login = (event) => {
    if (event) event.preventDefault()

    let email = $('#email').val()
    let senha = $('#senha').val()
    const spinner = $('.loading-logar')
    spinner.removeClass('hidden')

    if(!email || !senha){
        showLottieToast({
            message: "Preencha os campos corretamente",
            type: "error",
            duration: 3500
        }).then(()=>{
            spinner.addClass('hidden')
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
    }).always(() => {
        spinner.addClass('hidden')
    })


}

const esqueciSenha = () => {

    let email = $('.email').val()
    const button = $('.btn-esqueci-senha')
    const spinner = $('.loading-enviar-email')
    spinner.removeClass('hidden')
    button.prop('disabled', true)    

    if (!email) {
        showLottieToast({
            message: 'Por favor, digite seu e-mail!',
            type: 'error',
            duration: 3000
        }).then(()=>{
            spinner.addClass('hidden')
            button.prop('disabled', false)
        })
        return;
    }
    $.ajax({
        url: 'forget-password',
        method: 'POST',
        data: { email: email },
        dataType: 'json',
    }).then(function(response) {

        if (!response.status) {
            showLottieToast({
                message: response.message,
                type: 'error',
                duration: 3000
            }).then(()=>{
                spinner.addClass('hidden')
                button.prop('disabled', false)
            })
            return;
        } else {
             showLottieToast({
                message: response.message,
                type: 'success',
                duration: 3000
            }).then(()=>{
                $('.before').addClass('hidden')
                $('.after').removeClass('hidden')
                spinner.addClass('hidden')
                button.prop('disabled', false)
            })
        }
    })
}

const validarCodigo = () => {
    let codigo = $('.codigo').val()
    const button = $('.btn-validar')
    const spinner = $('.loading-enviar-codigo')
    spinner.removeClass('hidden')
    button.prop('disabled', true)

    if (!codigo) {
        showLottieToast({
            message: 'Por favor, digite o código!',
            type: 'error',
            duration: 3000
        }).then(()=>{
            spinner.addClass('hidden')
            button.prop('disabled', false)
        })
        return
    }

    $.ajax({
        url: 'validation-code',
        method: 'POST',
        data: { codigo: codigo },
        dataType: 'json',
    }).then(function(response) {
        if (!response.status) {
            showLottieToast({
                message: response.message,
                type: 'error',
                duration: 3000
            }).then(()=>{
                spinner.addClass('hidden')
                button.prop('disabled', false)
            })
            return
        }

        showLottieToast({
            message: response.message,
            type: 'success',
            duration: 3000
        }).then(() => {
            window.location.href = response.redirect_url;
        });
    });
}

const setarNovaSenha = () => {
    const button = $('.btn-salvar-senha')
    const spinner = $('.loading-salvar')
    spinner.removeClass('hidden')
    button.prop('disabled', true)

    let senha1 = $("#senha1").val()
    let senha2 = $("#senha2").val()

    if(!senha1 || !senha2){
        showLottieToast({
            message: "Preencha os campos corretamente!",
            type: 'warning',
            duration: 3000
        })
        spinner.addClass('hidden')
        button.prop('disabled', false)
        return
    }

    if(senha1 != senha2){
        showLottieToast({
            message: "As senhas se diferem!",
            type: 'warning',
            duration: 3000
        })
        spinner.addClass('hidden')
        button.prop('disabled', false)
        return
    }

    const data = {
        senha1: senha1,
        senha2: senha2,
        adega_id: adega_id
    }

    url = 'set-new-password'

    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        dataType: 'json',
        success: (response) => {
            if(!response.status){
                showLottieToast({
                    message: response.message,
                    type: 'error',
                    duration: 5000
                })
                spinner.addClass('hidden')
                button.prop('disabled', false)
                return
            } else {
                showLottieToast({
                    message: "Senha alterada com sucesso!",
                    type: 'success',
                    duration: 3000
                }).then(()=> {
                    location.href = "home"
                })
                spinner.addClass('hidden')
                button.prop('disabled', false)
            }
        }
    })
}

$(document).on('click', '.btn-esqueci-senha', esqueciSenha)
$(document).on('click', '.btn-validar', validarCodigo)
$(document).on('click', '.btn-salvar-senha', setarNovaSenha)

$(document).on('click', '.btn-login', function(e) {
    login(e)
})

$(document).on('keydown', function(e) {
    if (e.key === "Enter") {
        login(e)
    }
})

