<div id="modal-venda" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl">
        <div class="relative bg-[#2b2d3e] rounded-lg shadow-sm dark:bg-gray-700">

            <div class="p-4 flex-col">
                <div class="grid grid-cols-3 gap-2 mt-2">
                    <div class="col-span-2">
                        <span class="text-2xl font-semibold text-amber-50">Nova venda</span>
                    </div>
                    <div class="col-span-1">
                        <input type="date" class="form-input text-sm data_venda" name="data_venda">
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-4 gap-2">
                    <div class="col-span-1">
                        <label class="label">Produto</label>
                        <select name="produto" class="form-input produto">
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-4 gap-2">
                    <div class="col-span-1">
                        <label class="label">Plano de Contas</label>
                        <input type="text" name="plano_contas" class="form-input plano_contas" readonly>
                    </div>
                </div>

                <div class="grid grid-cols-2 mt-4 gap-2">
                    <div class="col-span-1">
                        <label class="label">Valor</label>
                        <input type="text" name="valor" class="form-input valor" readonly disabled>
                    </div>
                    <div class="col-span-1">
                        <label class="label">Quantidade</label>
                        <input type="number" name="qtd" class="form-input qtd">
                    </div>
                </div>

                <div class="flex mt-4 justify-center">
                    <button class="btn w-full btn-add-carrinho">
                        <i class="fa-solid fa-cart-shopping"></i> Adicionar ao carrinho
                    </button>
                </div>

                <div class="carrinho flex-1 overflow-auto mt-4 carrinhoLista">
                </div>

                <div class="flex justify-end text-white text-sm p-2">
                    <span class="carrinhoTotal">Total R$ 0,00</span>
                </div>

                <div class="flex justify-center mt-auto">
                    <button class="btn-success w-full btn-vender inline-flex gap-2 items-center justify-center">
                        <i class="fa-solid fa-hand-holding-dollar"></i> Finalizar venda
                        <svg aria-hidden="true" role="status" class=" w-4 h-4 me-3 text-white animate-spin loading-new-sale hidden "
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="flex items-center justify-end p-3 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 text-end">
                <button data-modal-hide="modal-venda" type="button" class="btn">Cancelar</button>
            </div>
        </div>
    </div>
</div>