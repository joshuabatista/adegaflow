<div id="modalIa" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-6xl max-h-full mx-auto"> <!-- max-w-4xl para mais compacto e profissional; mx-auto para centralizar -->
    <div class="relative bg-white rounded-xl shadow-lg dark:bg-gray-800 h-[90vh] max-h-[800px] flex flex-col overflow-hidden"> <!-- rounded-xl para bordas mais suaves; shadow-lg para profundidade -->
      <!-- Header -->
      <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 dark:bg-gray-700/50"> <!-- Fundo sutil no header para profissionalismo -->
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center"> <!-- Ícone ou avatar simples para IA -->
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Análises com IA </h3>
        </div>
        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition-colors duration-200" data-modal-hide="modalIa">
          <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Fechar modal</span>
        </button>
      </div>
      <div class="flex-1 flex flex-col overflow-hidden"> <!-- Área de mensagens/conversa (scrollable, com fundo neutro profissional) -->
        <!-- Chat messages: Agora ganha mais espaço no mobile -->
        <div id="chat-messages" class="flex-1 overflow-y-auto px-4 py-6 space-y-6 bg-gray-700  scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600"> <!-- Gradiente sutil para elegância; space-y-6 para espaçamento maior -->
          <!-- Mensagem inicial da IA -->
          <div class="flex justify-start">
            <div class="max-w-md bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl p-4 shadow-md"> <!-- rounded-2xl para balões mais suaves; shadow-md para elevação -->
              <p class="text-sm text-gray-900 dark:text-white leading-relaxed">Olá! Sou a IA de análises da sua Adega. Escolha uma das opções abaixo para obter insights rápidos e profissionais sobre o seu negócio.</p>
              <span class="text-xs text-gray-500 dark:text-gray-400 block mt-2 font-medium">Flowzinho • Agora</span>
            </div>
          </div>
          <div class="flex flex-col space-y-3 max-w-md ml-auto"> <!-- perguntas para a ia feita via js -->
          </div>
        </div>
        <!-- ALTERAÇÃO: Área de botões agora com altura limitada no mobile, scrollable vertical, padding/gap reduzido para compactar -->
        <!-- Adicionei classe 'buttons-container' para JS opcional -->
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 buttons-container md:max-h-full max-h-48 overflow-y-auto flex-none">
          <!-- ALTERAÇÃO: Grid responsivo mantido, mas gap/padding menores no mobile -->
          <div class="w-full grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-2 md:gap-3"> <!-- gap-2 no mobile para compactar -->
            <button type="button" class="btn-pergunta-ia cursor-pointer w-full bg-gradient-to-r dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-white rounded-xl p-2 md:p-3 shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-left focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-xs md:text-sm" data-option="Analise meu estoque atual e minhas vendas, e me forneça uma análise financeira completa do meu negócio. Identifique possíveis gargalos, oportunidades de melhoria e destaque os produtos com maior potencial para aumentar minha receita."> <!-- ALTERAÇÃO: p-2 md:p-3 e text-xs md:text-sm para mobile mais compacto -->
              <p class="text-xs font-medium leading-relaxed">Faça uma análise financeira do meu negócio </p>
            </button>
            <button type="button" class="btn-pergunta-ia cursor-pointer w-full bg-gradient-to-r dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-white rounded-xl p-2 md:p-3 shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-left focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-xs md:text-sm" data-option="calcule a margem de contribuição por produto (valor_venda - valor_compra), percentual de margem, e ordene do maior para o menor. Indique top 5 produtos com maior margem e top 5 com menor margem.">
              <p class="text-xs font-medium leading-relaxed">Calcule margens de contribuição dos meus produtos.</p>
            </button>
            <button type="button" class="btn-pergunta-ia cursor-pointer w-full bg-gradient-to-r dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-white rounded-xl p-2 md:p-3 shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-left focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-xs md:text-sm" data-option="calcule o giro de estoque (vendas / estoque médio) por produto no último 90 dias. Identifique produtos de baixa rotatividade (giro < 0.5) e produtos de alta rotatividade (giro > 3).">
              <p class="text-xs font-medium leading-relaxed">Giro de estoque e reabastecimento.</p>
            </button>
            <button type="button" class="btn-pergunta-ia cursor-pointer w-full bg-gradient-to-r dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-white rounded-xl p-2 md:p-3 shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-left focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-xs md:text-sm" data-option="Liste produtos com **alta margem** e **alta rotação** (melhor combinação). Indique 3 ações para cada (promoção, exposição, compra em volume).">
              <p class="text-xs font-medium leading-relaxed">Produtos com maior potencial.</p>
            </button>
            <button type="button" class="btn-pergunta-ia cursor-pointer w-full bg-gradient-to-r dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-white rounded-xl p-2 md:p-3 shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-left focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-xs md:text-sm" data-option="Sugira 5 promoções (ex.: 2x1, desconto percentual, combo) para produtos com excesso de estoque e previsão do impacto esperado na receita e margem.">
              <p class="text-xs font-medium leading-relaxed">Sugira Promoções</p>
            </button>
            <button type="button" class="btn-pergunta-ia cursor-pointer w-full bg-gradient-to-r dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-white rounded-xl p-2 md:p-3 shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-left focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-xs md:text-sm" data-option="Sugira combos (2-3 itens) que historicamente vendem juntos ou que fariam sentido montar com base em categoria/plano de contas.">
              <p class="text-xs font-medium leading-relaxed">Sugira Combos</p>
            </button>
            <button type="button" class="btn-pergunta-ia cursor-pointer w-full bg-gradient-to-r dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-white rounded-xl p-2 md:p-3 shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-left focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-xs md:text-sm" data-option="Liste produtos com estoque que não teve saída nos últimos 180 dias (aging stock). Para cada um, sugira ação">
              <p class="text-xs font-medium leading-relaxed">Produtos com risco de perda</p>
            </button>
          </div>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-4 text-center">Selecione uma opção acima para iniciar a análise.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Seus styles existentes de typing permanecem aqui -->
<style>

@media (max-width: 640px) {
  .buttons-container::-webkit-scrollbar { width: 4px; height: 4px; }
  .buttons-container::-webkit-scrollbar-track { background: transparent; }
  .buttons-container::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 2px; }
  .buttons-container::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
}
</style>


<style>
    .typing-container {
        display: flex;
        align-items: center;
    }

    .typing-dots {
        display: flex;
        gap: 4px;
    }

    .dot {
        width: 8px;
        height: 8px;
        background-color: #9CA3AF;
        /* Cor cinza para combinar com o tema */
        border-radius: 50%;
        animation: typing 1.4s infinite ease-in-out;
    }

    .dot:nth-child(1) {
        animation-delay: -0.32s;
    }

    .dot:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes typing {

        0%,
        80%,
        100% {
            transform: translateY(0);
            opacity: 0.5;
        }

        40% {
            transform: translateY(-10px);
            opacity: 1;
        }
    }
</style>