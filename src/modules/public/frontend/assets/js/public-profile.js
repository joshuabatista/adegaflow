$(()=>{
    getAdega();
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