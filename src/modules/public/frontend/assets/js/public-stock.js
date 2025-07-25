$(() => {
    getPlano()
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
