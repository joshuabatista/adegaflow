$(() => {
    getPlano()
    getProdutos()
    $('#valor_compra').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true})
    $('#valor_venda').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true})
    hoje()
})

var currentPage, totalPages


const getPlano = async () => {
    const url = 'get-plano'

    const response = await $.ajax(url)

    renderPlano(response, ['#plano_contas', '#plano_contas_filtro'])

}

const renderPlano = (response, selects) => {
    selects.forEach(selector => {
        const select = $(selector);

        select.empty().append('<option value=""></option>');

        response.data.forEach(grupo => {
            const optgroup = $('<optgroup>', { label: grupo.label });
            grupo.options.forEach(opcao => {
                optgroup.append(
                    $('<option>', { value: opcao.value, text: opcao.text })
                );
            });
            select.append(optgroup);
        });

        if (select.hasClass("select2-hidden-accessible")) {
            select.select2('destroy');
        }

        select.select2({
            placeholder: 'Selecione um plano de contas',
            allowClear: true,
            width: '100%',
            minimumResultsForSearch: 0,
            dropdownParent: select.parent()
        });
    });
};

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
                    getProdutos()
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

const getProdutos = async (page = 1) => {

    const container = $('.container-products')

    container.empty()

    $('.loading').removeClass('hidden')

    const url = 'get-products'

    data = {
        produto: $('#produto_filtro').val(),
        data_entrada_de: $('#data_entrada_de').val(),
        data_entrada_ate: $('#data_entrada_ate').val(),
        plano_contas: $('#plano_contas_filtro').val(),
        page: page
    }

    if (isNaN(page)) page = 1

    const response = await $.ajax(url, {data})

    renderProdutos(response)
}

const renderProdutos = (response) => {
    
    const container = $('.container-products')

    currentPage = Number(response.page)
    totalPages = Number(response.pages)

    $('.pagination-info-card').html(`Página <strong>${currentPage}</strong> de ${totalPages}`)

    $('.loading').addClass('hidden')

    if (response.data.length === 0) {
        container.append(`
            <div class="flex flex-col justify-center items-center py-8">
                <span class="text-white text-sm">Nenhum produto encontrado!</span>
            </div>
        `)

        return
    }

    response.data.forEach(elm => {

        container.append(`
                <div class="grid grid-cols-12 gap-2 p-3 bg-[#2b2d3e] text-white text-sm items-center hover:bg-[#3b3d4e] transition">
                    <div class="col-span-1">${elm.data_entrada}</div>
                    <div class="col-span-3 truncate">${elm.produto}</div>
                    <div class="col-span-3 truncate">${elm.plano_contas}</div>
                    <div class="col-span-1 text-start">${elm.quantidade}</div>
                    <div class="col-span-1 text-start">R$ ${parseFloat(elm.valor_compra).toFixed(2)}</div>
                    <div class="col-span-1 text-start">R$ ${parseFloat(elm.valor_venda).toFixed(2)}</div>
                    <div class="col-span-1 text-center">
                        <button class="text-red-500 hover:text-red-400">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    <div class="col-span-1 text-center">
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                </div>
            `)
    })
    const allCards = container.children('.grid')
    allCards.removeClass('rounded-b-xl')
    allCards.last().addClass('rounded-b-xl')

    $('.pagination-card').removeClass('hidden')

    $('.btn-next-card').prop('disabled', currentPage + 1 > totalPages)
    $('.btn-prev-card').prop('disabled', currentPage - 1 <= 0)

}

const nextCard = () => {

    const container = $('.container-products')

    container.empty()

    const page = Number(currentPage) + 1

    getProdutos(page)
}

const prevCard = () => {

    const container = $('.container-products')

    container.empty()

    const page = Number(currentPage) - 1

    getProdutos(page)
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

$('#btn-exportar-excel').on('click', function () {
    const produto = $('#produto_filtro').val()
    const dataEntradaDe = $('#data_entrada_de').val()
    const dataEntradaAte = $('#data_entrada_ate').val()
    const planoContas = $('#plano_contas_filtro').val()

    const params = new URLSearchParams({
        produto: produto,
        data_entrada_de: dataEntradaDe,
        data_entrada_ate: dataEntradaAte,
        plano_contas: planoContas
    })

    window.open(`get-products-excel?${params.toString()}`, '_blank')
})

//eventos
$(document).on('click', '.btn-add-product', addProduct)

let debounceTimer
$(document).on('input', '#produto_filtro', function () {
  clearTimeout(debounceTimer)
  debounceTimer = setTimeout(() => {
    getProdutos(1)   
  }, 300)
})
$(document).on('change', '#data_entrada_de, #data_entrada_ate, #plano_contas_filtro', () => {
  getProdutos(1)
})
$('.btn-prev-card').on('click', () => {
  if (currentPage > 1) getProdutos(currentPage - 1)
})
$('.btn-next-card').on('click', () => {
  if (currentPage < totalPages) getProdutos(currentPage + 1)
})