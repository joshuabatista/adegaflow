

<div class="p-0 md:p-0 md:pr-4 md:pb-4 md:pt-4">
    <div class="hidden md:grid grid-cols-12 p-3 gap-3">
        <div class="col-span-4">
            <div class="box box1 shadow-2xl bg-[#2b2d3e]">
                <div id="spark1"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="box box2 shadow-2xl bg-[#2b2d3e]">
                <div id="spark2"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="box box3 shadow-2xl bg-[#2b2d3e]">
                <div id="spark3"></div>
            </div>
        </div>
    </div>

    <div class="md:hidden bg-[#2b2d3e] p-4 rounded shadow-2xl">
        <ul id="sparkTabs" class="flex flex-wrap text-sm font-medium text-center gap-2">
            <li>
                <a href="#tab-custo"
                    class="tab-link inline-block px-4 py-2 text-[#2b2d3e] bg-[#feb019] text-xs font-extrabold rounded-4xl active"
                    aria-current="page">Custos</a>
            </li>
            <li>
                <a href="#tab-receita"
                    class="tab-link inline-block px-4 py-2 text-[#2b2d3e] bg-[#008ffb] text-xs font-extrabold rounded-4xl">Receitas</a>
            </li>
            <li>
                <a href="#tab-lucro"
                    class="tab-link inline-block px-4 py-2 text-[#2b2d3e] bg-[#00e396] text-xs font-extrabold rounded-4xl">Lucros</a>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <div id="tab-custo" class="tab-panel">
                <div id="spark1_mobile" style="min-height:160px;"></div>
            </div>
            <div id="tab-receita" class="tab-panel hidden">
                <div id="spark2_mobile" style="min-height:160px;"></div>
            </div>
            <div id="tab-lucro" class="tab-panel hidden">
                <div id="spark3_mobile" style="min-height:160px;"></div>
            </div>
        </div>
    </div>

    <div class="hidden md:block">
        <div class="p-3 mt-6">
            <div class="box box3 shadow-2xl bg-[#2b2d3e]">
                <div id="chart"></div>
            </div>
        </div>
    </div>
   
</div>