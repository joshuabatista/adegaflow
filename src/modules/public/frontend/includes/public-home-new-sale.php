<div class="bg-[#2b2d3e] p-4 rounded shadow-2xl">
    <div class="grid grid-cols-3 gap-2 mt-2">
        <div class=" col-span-2">
            <span class="text-2xl font-semibold text-amber-50 mx-auto">Nova venda</span>
        </div>
        <div class=" col-span-1">
            <input type="date" class="form-input text-sm" name="data_venda" id="data_venda">
        </div>
    </div>
    <div class="grid grid-cols-1 mt-4 gap-2">
        <div class="col-span-1">
            <label class="label">Produto</label>
            <select name="produto" id="produto" class="form-input">
                <option value="">Selecione</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-1 mt-4 gap-2">
        <div class="col-span-1">
            <label class="label">Plano de Contas</label>
            <select name="plano_contas" id="plano_contas" class="form-input" disabled>
                <option value="">Selecione</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-2 mt-4 gap-2">
        <div class="col-span-1">
            <label class="label">Valor</label>
            <input type="text" name="valor" id="valor" class="form-input" readonly>
        </div>
        <div class="col-span-1">
            <label class="label">Quantidade</label>
            <input type="number" name="qtd" id="qtd" class="form-input">
        </div>
    </div>
    <div class="flex mt-4 gap-2 justify-center">
        <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Adicionar ao carrinho</button>
    </div>

     <div class="flex mt-4 gap-2 justify-center">
        <button class="btn-success"><i class="fa-solid fa-hand-holding-dollar"></i> Finalizar venda</button>
    </div>
</div>

