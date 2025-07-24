$(()=>{
    getAdega();
    $('#telefone').mask('(00)00000-0000');
})

const getAdega = async () => {

    const url = 'get-adega'

    const response = await $.ajax(url)

    renderAdega(response)
    
}

const renderAdega = (response) => {

    $('#cnpj').val(response.data.cnpj)
    $('#nome').val(response.data.nome)
    $('#cep').val(response.data.cep)
    $('#cidade').val(response.data.cidade)
    $('#bairro').val(response.data.bairro)
    $('#numero').val(response.data.numero)
    $('#telefone').val(response.data.telefone)
    $('#logradouro').val(response.data.logradouro)
    $('#email').val(response.email)

    $('#email').prop('disabled', true).addClass('cursor-not-allowed')
    $('#cnpj').prop('disabled', true).addClass('cursor-not-allowed')
    $('#cep').prop('disabled', true).addClass('cursor-not-allowed')
    $('#cidade').prop('disabled', true).addClass('cursor-not-allowed')
    $('#bairro').prop('disabled', true).addClass('cursor-not-allowed')
    $('#logradouro').prop('disabled', true).addClass('cursor-not-allowed')
}

const editarAdega = () => {
    const nome = $('#nome').val()
    const telefone = $('#telefone').val()
    const spinner = $('.loading-editar')
    spinner.removeClass('hidden')

    $('.btn-editar-adega').prop('disabled', true)

    if(!nome){
        showLottieToast({
            message: "Preencha o nome da Adega",
            type: "error",
            duration: 3500
        }).then(() => {
            spinner.addClass('hidden')
            $('.btn-editar-adega').prop('disabled', false)
        })
        return
    }
    if(!telefone){
        showLottieToast({
            message: "Preencha o telefone da Adega",
            type: "error",
            duration: 3500
        }).then(() => {
            spinner.addClass('hidden')
            $('.btn-editar-adega').prop('disabled', false)
        })
        return
    }

    const url = 'profile-edit'

    const data = {
        nome: nome,
        telefone: telefone
    }
    
    $.ajax({
        method: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        success: function(response){
            
            if(response.status == true){
                showLottieToast({
                    message: "Adega editada com sucesso!",
                    type: "success",
                    duration: 3500
                }).then(() => {
                    getAdega()
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

    // spinner.addClass('hidden')
    $('.btn-editar-adega').prop('disabled', false)

}

$(document).on('click', '.btn-editar-adega', editarAdega)