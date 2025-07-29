$(()=>{
    hoje()
    getProducts()
    $('#valor').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true})
})

const getProducts = async () => {
    const url = 'get-products-sale'

    const response = await $.ajax(url)
    
    renderProducts(response)
}

const renderProducts = (response) => {

    const select = $('#produto')

    select.empty()

    select.append('<option value="">Selecione um produto</option>')

    if (response.status && Array.isArray(response.data)) {
        response.data.forEach(item => {
            const optionText = `#${item.produto_id} - ${item.quantidade} UN - ${item.produto}`
            select.append(`<option value="${item.produto_id}">${optionText}</option>`)
        });

        select.select2({
            placeholder: 'Selecione um produto',
            width: '100%',
            language: 'pt-BR'
        });
    } 

}

const getPlanoContas = async () => {

    let produto_id = $('#produto').val()

    let data = {produto_id: produto_id}

    const url = "get-plano-sale"

    const response = await $.ajax(url, {data})

    renderPanoContas(response)

}

const renderPanoContas = (response) => {
    $('#plano_contas').val('')
    $('#valor').val('')

    $('#plano_contas').val(response.data.descricao)

    if (!$('#valor').data('maskMoney')) {
        $('#valor').maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            thousands: '.',
            decimal: ',',
            affixesStay: true
        })
    }

    $('#valor').val(response.data.valor_venda)
    $('#valor').trigger('mask.maskMoney')

    $('#qtd').focus()
    $('#qtd').val('')
};


const hoje = () => {
    const hoje = new Date()
    const ano = hoje.getFullYear()
    const mes = String(hoje.getMonth() + 1).padStart(2, '0')
    const dia = String(hoje.getDate()).padStart(2, '0')

    const dataHoje = `${ano}-${mes}-${dia}`
    $('#data_venda').val(dataHoje)
}

$(document).on('change', '#produto', getPlanoContas)