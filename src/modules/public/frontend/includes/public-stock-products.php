<div class="p-4">
    <div class="grid grid-cols-6 p-3 mt-7 gap-2.5">
        <div class="">
            <label class="label" for="grid-first-name">Produto</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-[#343e59] leading-tight focus:outline-none" id="produto_filtro" type="text" placeholder="Caixa de cerveja">
        </div>

        <div class="">
            <label class="label" for="grid-first-name">
                Data de entrada
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-[#343e59] leading-tight focus:outline-none" id="data_entrada_filtro" type="date" placeholder="01/01/2025">
        </div>

        <div class="">
            <label class="label" for="grid-first-name">
                Quantidade
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-[#343e59] leading-tight focus:outline-none" id="quantidade_filtro" type="number" placeholder="Quantidade">
        </div>

        <div class="">
            <label class="label" for="grid-first-name">
                Plano de Contas
            </label>
            <select name="plano_contas" id="plano_contas_filtro" class="shadow appearance-none border rounded w-full py-2 px-3 text-[#343e59] leading-tight focus:outline-none">
                <option value="">Selecione</option>
            </select>
        </div>

        <div class="">
            <label class="label" for="grid-first-name">
                Valor de Compra
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-[#343e59] leading-tight focus:outline-none" id="valor_compra_filtro" type="text" placeholder="R$ 35,00">
        </div>

        
        <div class="">
            <label class="label" for="grid-first-name">
                Valor de Venda
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-[#343e59] leading-tight focus:outline-none" id="valor_venda_filtro" type="text" placeholder="R$ 70,00">
        </div>
    </div>
    <div class="flex justify-start p-3 gap-2.5">
        <button class=" w-3.5 text-amber-50">
            <i class="fa-regular fa-file-excel fa-2x"></i>
        </button>
    </div>
    <div class="grid grid-cols-1 p-3 mt-2.5 justify-center">
        <div class=" overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class=" text-start">
                        <th scope="col" class="px-6 py-3">
                            Data de Entrada
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Produto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Plano de Contas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantidade
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Valor de Compra
                        </th>
                         <th scope="col" class="px-6 py-3">
                            Valor de Venda
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Excluir venda
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th class="px-6 py-4">
                            21/7/2025
                        </th>
                        <td class="px-6 py-4">
                            Cx - Brahma Duplo Malte - 12un
                        </td>
                        <td class="px-6 py-4">
                            Cerveja
                        </td>
                        <td class="px-6 py-4">
                            1
                        </td>
                        <td class="px-6 py-4">
                            R$ 46,90
                        </td>
                        <td class="px-6 py-4">
                            R$ 96,90
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Excluir</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
