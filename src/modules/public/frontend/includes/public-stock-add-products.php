<div class="bg-[#2b2d3e] p-4 rounded-2xl shadow-2xl">
    <div class="flex justify-center">
        <span class="text-2xl text-amber-50 font-semibold text-center">Novo Produto</span>
    </div>
    <div class="grid grid-cols-3 mt-4 gap-2">
        <div class="col-span-2">
            <label class="label">Data entrada</label>
            <input type="date" class="form-input" name="data_entrada" id="data_entrada">
        </div>
        <div class="col-span-1">
            <label class="label">Quantidade</label>
            <input type="text" class="form-input" name="qtd" id="qtd" placeholder="5">
        </div>
    </div>
    <div class="grid grid-cols-1 mt-4 gap-2">
        <label class="label">Produto</label>
        <input type="text" class="form-input" name="produto" id="produto" placeholder="Caixa de cerveja">
    </div>
    <div class="grid grid-cols-1 mt-4 gap-2">
        <label class="label">Plano de Contas</label>
        <select name="plano_contas" id="plano_contas" class="form-input">
        </select>
    </div>
    <div class="grid grid-cols-2 mt-4 gap-2">
        <div>
            <label class="label">Valor de Compra</label>
            <input type="text" class="form-input" name="valor_compra" id="valor_compra" placeholder="R$ 18,00">
        </div>
         <div>
            <label class="label">Valor de Venda</label>
            <input type="text" class="form-input" name="valor_venda" id="valor_venda" placeholder="R$ 45,00">
        </div>
    </div>
    <div class="flex justify-center mt-4 gap-2">
        <div class="flex justify-center mt-4">
            <button type="button" class="btn btn-add-product inline-flex gap-2 items-center">
                Lançar Produto
                <svg aria-hidden="true" role="status" class=" w-4 h-4 me-3 text-white animate-spin loading-add-product hidden" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
            </button>
        </div>
    </div>
</div>

