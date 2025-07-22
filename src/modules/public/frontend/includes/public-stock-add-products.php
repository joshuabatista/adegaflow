<div class="bg-[#2b2d3e] p-4 rounded shadow-2xl">
    <div class="flex justify-center">
        <span class="text-2xl text-amber-50 font-semibold text-center">Novo Produto</span>
    </div>
    <div class="grid grid-cols-3 mt-4 gap-2">
        <div class="col-span-2">
            <label class="label">Data entrada</label>
            <input type="date" class="form-input" name="data_entrada">
        </div>
        <div class="col-span-1">
            <label class="label">Quantidade</label>
            <input type="text" class="form-input" name="qtd" id="qtd">
        </div>
    </div>
    <div class="grid grid-cols-1 mt-4 gap-2">
        <label class="label">Plano de Contas</label>
        <select name="plano_contas" id="plano_contas" class="form-input">
            <option value="">Selecione</option>
        </select>
    </div>
    <div class="grid grid-cols-2 mt-4 gap-2">
        <div>
            <label class="label">Valor de Compra</label>
            <input type="text" class="form-input" name="valor_compra" id="valor_compra">
        </div>
         <div>
            <label class="label">Valor de Venda</label>
            <input type="text" class="form-input" name="valor_venda" id="valor_venda">
        </div>
    </div>
    <div class="flex justify-center mt-4 gap-2">
        <div class="flex justify-center mt-4">
            <button type="button" class="btn">Lançar Produto</button>
        </div>
    </div>
</div>

