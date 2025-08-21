let chart1, chart2, chart3, chartAno;
let chart1_mobile, chart2_mobile, chart3_mobile
let mobileData = null;

$(() => {
  setKpiDateInputs()
  getReceitaCusto()
  getReceitaCustoMobile()
  getReceitaCustoMes()
  getKpi()
  getSalesToday()
});

async function getReceitaCusto() {
  const url = 'revenue-cost'
  const response = await $.ajax(url)

  if (chart1) chart1.destroy()
  if (chart2) chart2.destroy()
  if (chart3) chart3.destroy()

  const today = new Date()
  const year = today.getFullYear()
  const month = String(today.getMonth() + 1).padStart(2, '0')
  const brDay = d => String(d).padStart(2, '0')

  const custosArr = Object.values(response.custos).map(v => parseFloat(v))
  const receitasArr = Object.values(response.receitas).map(v => parseFloat(v))
  const lucroArr = Object.values(response.lucros).map(v => parseFloat(v))

  const daysInMonth = custosArr.length
  const labels = Array.from({ length: daysInMonth }, (_, i) =>
    `${brDay(i + 1)}/${month}/${year}`
  )

  const fmtBRL = v =>
    new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(v)

  const totalCustos = custosArr.reduce((a, b) => a + b, 0)
  const totalReceitas = receitasArr.reduce((a, b) => a + b, 0)
  const totalLucro = lucroArr.reduce((a, b) => a + b, 0)

  const allValues = [...custosArr, ...receitasArr, ...lucroArr]
  const globalMin = Math.min(0, ...allValues)
  const globalMax = Math.max(...allValues)

  function opts(id, title, total, color, dataArr) {
    return {
      chart: { id, group: 'sparklines', type: 'area', height: 160, sparkline: { enabled: true } },
      stroke: { curve: 'straight' },
      fill: { opacity: 1 },
      labels,
      xaxis: { type: 'category' },
      yaxis: { min: globalMin, max: globalMax },
      tooltip: {
        enabled: true,
        shared: true,
        intersect: false,
        followCursor: false,
        y: { formatter: val => fmtBRL(val) },
        x: { formatter: val => `${brDay(val)}/${month}/${year}` }
      },
      series: [{ name: title, data: dataArr }],
      title: { text: fmtBRL(total), offsetX: 30, style: { fontSize: '24px', color: '#ffffff' } },
      subtitle: { text: title, offsetX: 30, style: { fontSize: '14px', color: '#ffffff' } },
      colors: [color]
    }
  }

  chart1 = new ApexCharts(document.querySelector('#spark1'), opts('spark1', 'Custos', totalCustos, '#feb019', custosArr))
  chart2 = new ApexCharts(document.querySelector('#spark2'), opts('spark2', 'Receita', totalReceitas, '#008ffb', receitasArr))
  chart3 = new ApexCharts(document.querySelector('#spark3'), opts('spark3', 'Lucro', totalLucro, '#00e396', lucroArr))

  chart1.render()
  chart2.render()
  chart3.render()
}

async function getReceitaCustoMobile() {
  const url = 'revenue-cost';
  const response = await $.ajax(url);

  const today = new Date();
  const year = today.getFullYear();
  const month = String(today.getMonth() + 1).padStart(2, '0');
  const brDay = d => String(d).padStart(2, '0');

  const custosArr = Object.values(response.custos || {}).map(v => parseFloat(v) || 0);
  const receitasArr = Object.values(response.receitas || {}).map(v => parseFloat(v) || 0);
  const lucroArr = Object.values(response.lucros || {}).map(v => parseFloat(v) || 0);

  const daysInMonth = Math.max(custosArr.length, receitasArr.length, lucroArr.length);
  const labels = Array.from({ length: daysInMonth }, (_, i) => `${brDay(i + 1)}/${month}/${year}`);

  const totalCustos = custosArr.reduce((a,b)=>a+b,0);
  const totalReceitas = receitasArr.reduce((a,b)=>a+b,0);
  const totalLucro = lucroArr.reduce((a,b)=>a+b,0);

  const globalMin = Math.min(0, ...custosArr, ...receitasArr, ...lucroArr);
  const globalMax = Math.max(...custosArr, ...receitasArr, ...lucroArr);

  mobileData = {
    custos: { arr: custosArr, total: totalCustos, labels },
    receitas: { arr: receitasArr, total: totalReceitas, labels },
    lucro: { arr: lucroArr, total: totalLucro, labels },
    globalMin,
    globalMax
  };

  // Renderiza a tab inicial (Custos)
  renderMobileChart('custo');
}

function buildMobileOpts(title, total, color, dataArr, labels, globalMin, globalMax) {
  const fmtBRL = v => new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(v);
  return {
    chart: { type: 'area', height: 160, sparkline: { enabled: true } },
    stroke: { curve: 'straight' },
    fill: { opacity: 1 },
    labels,
    xaxis: { type: 'category' },
    yaxis: { min: globalMin, max: globalMax },
    tooltip: { y: { formatter: val => fmtBRL(val) } },
    series: [{ name: title, data: dataArr }],
    title: { text: fmtBRL(total), style: { fontSize: '18px', color: '#ffffff' } },
    subtitle: { text: title, style: { fontSize: '12px', color: '#ffffff' } },
    colors: [color]
  };
}

function renderMobileChart(key) {
  if (!mobileData) return;

  let chartRef, elId, opts;
  if (key === 'custo') {
    elId = 'spark1_mobile';
    chartRef = chart1_mobile;
    opts = buildMobileOpts('Custos', mobileData.custos.total, '#feb019', mobileData.custos.arr, mobileData.custos.labels, mobileData.globalMin, mobileData.globalMax);
  } else if (key === 'receita') {
    elId = 'spark2_mobile';
    chartRef = chart2_mobile;
    opts = buildMobileOpts('Receitas', mobileData.receitas.total, '#008ffb', mobileData.receitas.arr, mobileData.receitas.labels, mobileData.globalMin, mobileData.globalMax);
  } else if (key === 'lucro') {
    elId = 'spark3_mobile';
    chartRef = chart3_mobile;
    opts = buildMobileOpts('Lucro', mobileData.lucro.total, '#00e396', mobileData.lucro.arr, mobileData.lucro.labels, mobileData.globalMin, mobileData.globalMax);
  }

  if (!chartRef) {
    const el = document.querySelector('#'+elId);
    if (el) {
      const chart = new ApexCharts(el, opts);
      chart.render();
      if (key === 'custo') chart1_mobile = chart;
      if (key === 'receita') chart2_mobile = chart;
      if (key === 'lucro') chart3_mobile = chart;
    }
  }
}

$('#sparkTabs .tab-link').on('click', function(e){
  e.preventDefault();
  const target = $(this).attr('href');

  $('.tab-panel').addClass('hidden');
  $(target).removeClass('hidden');

  $('#sparkTabs .tab-link').removeClass('active');
  $(this).addClass('active');

  const keyMap = {
    '#tab-custo': 'custo',
    '#tab-receita': 'receita',
    '#tab-lucro': 'lucro'
  };
  renderMobileChart(keyMap[target]);
});


const getReceitaCustoMes = async () => {
  const url = 'revenue-cost-year'

  const response = await $.ajax(url)

  renderChartsAno(response)

}


const renderChartsAno = (response) => {

  if (chartAno) {
    chartAno.destroy()
  }

  const meses = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dez']

  const receitas = response.receitas.map(item => parseFloat(item.total))
  const custos = response.custos.map(item => parseFloat(item.total))
  const lucros = response.lucros.map(item => parseFloat(item.total))

  const options = {
    series: [
      { name: 'Receita', data: receitas },
      { name: 'Custo', data: custos },
      { name: 'Lucro', data: lucros }
    ],
    chart: {
      type: 'bar',
      height: 350,
      foreColor: '#ffffff'
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        borderRadius: 5,
        borderRadiusApplication: 'end'
      },
    },
    dataLabels: { enabled: false },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: meses,
      labels: { style: { colors: '#ffffff' } }
    },
    yaxis: {
      title: { text: 'Receita x Custo x Lucro' },
      labels: { style: { colors: '#ffffff' } }
    },
    legend: {
      labels: { colors: '#ffffff' }
    },
    fill: { opacity: 1 },
    tooltip: {
      theme: 'dark',
      y: {
        formatter: val => "R$ " + val.toLocaleString('pt-BR', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        })
      }
    }
  }


  chartAno = new ApexCharts(document.querySelector("#chart"), options)
  chartAno.render()
}

const getKpi = async () => {

  let de = $('#kpi_de').val()
  let ate = $('#kpi_ate').val()

  let data = {
    de: de,
    ate: ate
  }
  
  const url = 'get-kpi'

  const response = await $.ajax(url, {data})

  renderKpi(response)
  
}

const renderKpi = (response) => {
  animateCount('#vendas', 0, parseCurrency(response.vendas), 1000, {
    decimals: 0,
    prefix: '',
    suffix: ''
  })

  animateCount('#ticket', 0, parseCurrency(response.ticket_medio), 1000, {
    decimals: 2,
    prefix: 'R$ ',
    suffix: ''
  })

  animateCount('#margem', 0, parseCurrency(response.margem_media), 1000, {
    decimals: 2,
    prefix: '',
    suffix: '%'
  })

  animateCount('#crescimento', 0, parseCurrency(response.crescimento), 1000, {
    decimals: 2,
    prefix: '',
    suffix: '%'
  })
}

const getSalesToday = async () => {

    const url = 'sales-today'

    const response = await $.ajax(url)

    renderSalesToday(response)
    
}

const renderSalesToday = (response) => {
    animateCount('.vendasHoje', 0, parseCurrency(response.data), 1000, {
    decimals: 2,
    prefix: 'R$ ',
    suffix: ''
  })
}

function month() {
  const hoje = new Date()
  const ano = hoje.getFullYear()
  const mes = hoje.getMonth() // 0-based

  const primeiroDia = new Date(ano, mes, 1)
  const ultimoDia = new Date(ano, mes + 1, 0)

  const formatDate = (date) => {
    const anoF = date.getFullYear()
    const mesF = String(date.getMonth() + 1).padStart(2, '0')
    const diaF = String(date.getDate()).padStart(2, '0')
    return `${anoF}-${mesF}-${diaF}`
  }

  return {
    primeiroDia: formatDate(primeiroDia),
    ultimoDia: formatDate(ultimoDia)
  }
}

const setKpiDateInputs = () => {
  const { primeiroDia, ultimoDia } = month()
  $('#kpi_de').val(primeiroDia)
  $('#kpi_ate').val(ultimoDia)
}




const animateCount = (selector, start, end, duration, options = {}) => {
  let { decimals = 2, prefix = '', suffix = '' } = options
  let current = start
  const range = end - start
  const stepTime = 10
  const steps = Math.ceil(duration / stepTime)
  const increment = range / steps
  let stepCount = 0

  const interval = setInterval(() => {
    stepCount++
    current += increment

    if (stepCount >= steps) {
      clearInterval(interval)
      current = end
    }

    const formatted = current.toLocaleString('pt-BR', { minimumFractionDigits: decimals, maximumFractionDigits: decimals })

    $(selector).html(prefix + formatted + suffix)
  }, stepTime)
}

const parseCurrency = (value) => {
  if (typeof value === 'number') return value
  if (typeof value === 'string') {
    const normalized = value.replace(/[^\d,.-]/g, '').replace(/\./g, '').replace(',', '.')
    const parsed = parseFloat(normalized)
    return isNaN(parsed) ? 0 : parsed
  }
  return 0
}

const showFiltro = () => {
  const show = $('#showFiltro')
  const hidden = $('#hiddenFiltro')
  const filtro = $('.filtros')

  show.addClass('hidden')
  hidden.removeClass('hidden')

  filtro.removeClass('hidden')


}

const hiddenFiltro = () => {
  const show = $('#showFiltro')
  const hidden = $('#hiddenFiltro')
  const filtro = $('.filtros')

  show.removeClass('hidden')
  hidden.addClass('hidden')
  filtro.addClass('hidden')


}

$(document).on('click', '#showFiltro', showFiltro)
$(document).on('click', '#hiddenFiltro', hiddenFiltro)
$(document).on('change', '#kpi_de, #kpi_ate', getKpi)







