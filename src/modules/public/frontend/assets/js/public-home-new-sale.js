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
    if (!response || !response.data) {
        return
    }

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
}

let carrinho = []

const atualizarCarrinho = () => {
    let html = ''
    let totalGeral = 0

    carrinho.forEach((item, index) => {
        
        let subtotal = item.valor
        
        totalGeral += subtotal

        html += `
            <div class="grid grid-cols-12 text-white text-sm items-center hover:bg-[#3b3d4e] transition p-2">
                <div class="col-span-2">${item.quantidade} UN</div>
                <div class="col-span-6">${item.nome}</div>
                <div class="col-span-2 text-end">${formatarMoeda(item.valor)}</div>
                <div class="col-span-2 text-end">
                    <i class="fa-solid fa-trash text-red-400 cursor-pointer" onclick="removerItem(${index})"></i>
                </div>
            </div>
        `
    })

    $('#carrinhoLista').html(html)
    $('#carrinhoTotal').text(`Total ${formatarMoeda(totalGeral)}`)
}

const addProduct = () => {
    let produtoId = $('#produto').val()
    let produtoTexto = $('#produto option:selected').text()
    let nomeProduto = produtoTexto.split(' - ').slice(2).join(' - ')

    let valor = $('#valor').val().replace('R$ ', '').replace('.', '').replace(',', '.')
    
    let quantidade = $('#qtd').val()

    let valorProduto = valor * quantidade

    if (!produtoId || !quantidade || quantidade <= 0) {

        showLottieToast({
            message: "Selecione um produto e insira a quantidade!",
            type: "warning",
            duration: 3500
        })
        return
    }

    carrinho.push({
        id: produtoId,
        nome: nomeProduto,
        valor: parseFloat(valorProduto),
        quantidade: parseInt(quantidade)
    })

    atualizarCarrinho()

    $('#produto').val(null).trigger('change')
    $('#plano_contas').val('')
    $('#valor').val('')
    $('#qtd').val('')
}

const removerItem = (index) => {
    carrinho.splice(index, 1)
    atualizarCarrinho()
}

const vender = () => {
    $('.btn-vender').prop('disabled', true)
    const spinner = $('.loading-new-sale')
    spinner.removeClass('hidden')


    if (carrinho.length === 0) {
        showLottieToast({
            message: "O carrinho está vazio :(",
            type: "error",
            duration: 3500
        })
        spinner.addClass('hidden')
        $('.btn-vender').prop('disabled', false)
        return
    }

    if ($('#data_venda').val() === '') {
        showLottieToast({
            message: "Preencha o campo de data de venda!",
            type: "error",
            duration: 3500
        })
        $('#data_venda').focus()
        spinner.addClass('hidden')
        $('.btn-vender').prop('disabled', false)
        return
    }

    let data_venda = $('#data_venda').val()

    let data = {
        data_venda: data_venda,
        carrinho: carrinho
    }

     $.ajax({
        url: 'new-sale',
        method: 'POST',
        dataType: 'json',
        data: data,
        success: function (response) {
            if (response.status == true) {
                    showLottieToast({
                        message: "Venda realizada com sucesso!!",
                        type: "success",
                        duration: 3500
                    }).then(()=>{
                        carrinho = []
                        atualizarCarrinho()
                        spinner.addClass('hidden')
                        $('.btn-vender').prop('disabled', false)
                        getProducts()
                        getReceitaCusto()
                        getReceitaCustoMes()
                        getKpi()
                    })
            } else {
                showLottieToast({
                    message: response.message,
                    type: "error",
                    duration: 4500
                }).then(()=>{
                    atualizarCarrinho();
                    spinner.addClass('hidden')
                    $('.btn-vender').prop('disabled', false)
                })
            }
        },
    })

}

const validateProduct = () => {

    let produto = $('#produto').val()
    let qtd = $('#qtd').val()
    let valor_venda = stripMoney($('#valor').val())

    if(!produto || !qtd || !valor_venda){
        return
    }
    
    url = 'validate-product'

    data = {produto: produto, qtd: qtd, valor_venda: valor_venda}

    $.ajax({
        url: url,
        method: 'GET', 
        data: data,
        dataType: 'json',
    }).done(function(response) {
        if (!response.status && response.erro === '0902') {
            const atual     = parseInt(response.estoque, 10);
            const diferenca = qtd - atual;
            showLottieModal({
                title: 'Estoque Insuficiente',
                type: 'warning',
                html: `
                Você está tentando vender <b>${qtd}</b> unidades,<br>
                mas só há <b>${atual}</b> no estoque.<br><br>
                Deseja adicionar <b>${diferenca}</b> unidade(s) ao estoque
                para concluir a venda?<br>
                <small>(Use a aba de Estoque para lançamentos mais precisos.)</small>
                `,
                confirmText: 'Adicionar',
                cancelText: 'Cancelar'
            }).then(userConfirmed => {
                if (userConfirmed) {
                    $.ajax({
                        url: 'add-qtd-sale',
                        method: 'POST',
                        data: { produto, qtd: diferenca },
                        dataType: 'json'
                    }).done(resp2 => {
                        if (resp2.status) {
                        showLottieToast({
                            message: resp2.message,
                            type: 'success',
                            duration: 3000
                        }).then(() => {
                            getProducts()
                        });
                        } else {
                        showLottieToast({
                            message: resp2.message,
                            type: 'error',
                            duration: 3500
                        });
                        }
                    })
                } else {    
                    carrinho = []   
                    atualizarCarrinho()                 
                }
            });
            return
        } else {
          if(!response.status && response.erro === '0903'){
            showLottieToast({
                message: response.message,
                type: 'error',
                duration: 4000
            }).then(()=>{
                carrinho = []
                atualizarCarrinho()
            })
          }
        }
    })
}








//funções auxiliares
const hoje = () => {
    const hoje = new Date()
    const ano = hoje.getFullYear()
    const mes = String(hoje.getMonth() + 1).padStart(2, '0')
    const dia = String(hoje.getDate()).padStart(2, '0')

    const dataHoje = `${ano}-${mes}-${dia}`
    $('#data_venda').val(dataHoje)
}
const formatarMoeda = (valor) => {
    return 'R$ ' + parseFloat(valor).toFixed(2).replace('.', ',')
}

const stripMoney = value => {
    if(value == 0) {
        return value = 0 
    }
        
    value = Number(value.replace(/[^0-9\-]+/g, '').replace(/(\..*)\./g, '$1')) / 100;

    return value
}

//eventos ouvintes
$(document).on('change', '#produto', getPlanoContas)
$(document).on('click', '.btn-add-carrinho', validateProduct)
$(document).on('click', '.btn-add-carrinho', addProduct)
$(document).on('click', '.btn-vender', vender)