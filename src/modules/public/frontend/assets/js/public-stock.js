$(() => {
    getPlano()
    $('#valor_compra').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true})
    $('#valor_venda').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true})
    hoje()
})

const getPlano = async () => {
    const url = 'get-plano'

    const response = await $.ajax(url)

    renderPlano(response)

}

const renderPlano = (response) => {
    
    const select = $('#plano_contas')

    select.empty().append('<option value=""></option>')
    
    response.data.forEach(grupo => {
        const optgroup = $('<optgroup>', { label: grupo.label });
        grupo.options.forEach(opcao => {
        optgroup.append(
            $('<option>', { value: opcao.value, text: opcao.text })
        );
        });
        select.append(optgroup)
    });

    if (select.hasClass("select2-hidden-accessible")) {
        select.select2('destroy')
    }

    $('#plano_contas').select2({
        placeholder: 'Selecione um plano de contas',
        allowClear: true,
        width: '100%',
        minimumResultsForSearch: 0,
        dropdownParent: $('#plano_contas').parent()
    })
}

const addProduct = () => {
    $('.btn-add-product').prop('disabled', true)
    let data_entrada = $('#data_entrada').val()
    let quantidade = $('#qtd').val()
    let produto = $('#produto').val()
    let plano_contas = $('#plano_contas').val()
    let valor_compra = stripMoney($('#valor_compra').val())
    let valor_venda = stripMoney($('#valor_venda').val())
    const spinner = $('.loading-add-product')
    spinner.removeClass('hidden')

    if(!data_entrada || !quantidade || !produto || !plano_contas || !valor_compra || !valor_venda ) {
        showLottieToast({
            message: 'Preencha os campos corretamente!',
            type: 'error',
            duration: 3500
        }).then(()=>{
            spinner.addClass('hidden')
            $('.btn-add-product').prop('disabled', false)
        })
        return
    }

    const data = {
        data_entrada: data_entrada,
        quantidade: quantidade,
        produto: produto,
        plano_contas: plano_contas,
        valor_compra: valor_compra,
        valor_venda: valor_venda
    }

    const url = 'add-product'

    $.ajax({
        method: 'POST',
        data: data,
        url: url,
        dataType: 'json',
        success: function(response){
            if(response.status == true){
                showLottieToast({
                    message: "Produto adicionado com sucesso!",
                    type: "success",
                    duration: 3500
                }).then(()=>{
                    spinner.addClass('hidden')
                    $('#qtd').val('')
                    $('#produto').val('')
                    $('#plano_contas').val(null).trigger('change');
                    $('#valor_compra').val('')
                    $('#valor_venda').val('')
                    $('.btn-add-product').prop('disabled', false)
                })
            } else {
                showLottieToast({
                    message: response.message,
                    type: "error",
                    duration: 3500
                }).then(()=>{
                    spinner.addClass('hidden')
                    $('.btn-add-product').prop('disabled', false)
                })
            }
        }
    })

    $('.btn-add-product').prop('disabled', false)

}



//funcoes auxiliares
const hoje = () => {
    const hoje = new Date()
    const ano = hoje.getFullYear()
    const mes = String(hoje.getMonth() + 1).padStart(2, '0')
    const dia = String(hoje.getDate()).padStart(2, '0')

    const dataHoje = `${ano}-${mes}-${dia}`
    $('#data_entrada').val(dataHoje)
}

const stripMoney = value => {
    if(value == 0) {
        return value = 0 
    }
        
    value = Number(value.replace(/[^0-9\-]+/g, '').replace(/(\..*)\./g, '$1')) / 100;

    return value
}

//eventos
$(document).on('click', '.btn-add-product', addProduct)