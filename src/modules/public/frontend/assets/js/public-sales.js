$(()=>{
    getSales()
    getPlano()
})

var currentPage, totalPages

const getSales = async (page = 1) => {

    const container = $('.container-sales')

    container.empty()

    $('.loading').removeClass('hidden')

    const url = 'get-sales'

    data = {
        data_de: $('#de').val(),
        data_ate: $('#ate').val(),
        produto: $('#produto').val(),
        plano_contas: $('#plano_contas').val(),
        venda_id: $('#venda_id').val(),
        page: page
    }

    if (isNaN(page)) page = 1;

    const response = await $.ajax(url, {data})

    renderSales(response)
}

const renderSales = (response) => {

    const container = $('.container-sales')

    currentPage = Number(response.page)
    totalPages = Number(response.pages)

    $('.pagination-info-card').html(`Página <strong>${currentPage}</strong> de ${totalPages}`)

    $('.loading').addClass('hidden')

    if (response.data.length === 0) {
        container.append(`
            <div class="flex flex-col justify-center items-center py-8">
                <span class="text-white text-sm">Nenhuma venda encontrada!</span>
            </div>
        `)
        return
    }

    response.data.forEach(elm => {

        container.append(`
                <div class="grid grid-cols-12 gap-2 p-3 bg-[#2b2d3e] text-white text-sm items-center hover:bg-[#3b3d4e] transition">
                    <div class="col-span-2">${elm.venda_id}</div>
                    <div class="col-span-1 truncate">${elm.data_venda_formatada}</div>
                    <div class="col-span-4 truncate">${elm.produto}</div>
                    <div class="col-span-1 text-start">${elm.qtd_venda}</div>
                    <div class="col-span-2 text-start">R$ ${parseFloat(elm.valor_total).toFixed(2)}</div>
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

    const container = $('.container-sales')

    container.empty()

    const page = Number(currentPage) + 1

    getSales(page)
}

const prevCard = () => {

    const container = $('.container-sales')

    container.empty()

    const page = Number(currentPage) - 1

    getSales(page)
}


const getPlano = async () => {
    const url = 'get-plano'

    const response = await $.ajax(url)

    renderPlano(response, ['#plano_contas'])

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

$('#btn-sales-excel').on('click', function () {
    const produto = $('#produto').val()
    const dataEntradaDe = $('#de').val()
    const dataEntradaAte = $('#ate').val()
    const planoContas = $('#plano_contas').val()
    const venda_id = $('#venda_id').val()

    const params = new URLSearchParams({
        produto: produto,
        data_entrada_de: dataEntradaDe,
        data_entrada_ate: dataEntradaAte,
        plano_contas: planoContas,
        venda_id: venda_id
    })

    window.open(`get-sales-excel?${params.toString()}`, '_blank')
})


let debounceTimer

$(document).on('input', '#produto, #venda_id', function () {
  clearTimeout(debounceTimer)
  debounceTimer = setTimeout(() => {
    getSales(1)   
  }, 300)
})
$(document).on('change', '#de, #ate, #produto, #plano_contas',  () => {
  getSales(1)
})
$('.btn-prev-card').on('click', () => {
  if (currentPage > 1) getSales(currentPage - 1)
})
$('.btn-next-card').on('click', () => {
  if (currentPage < totalPages) getSales(currentPage + 1)
})