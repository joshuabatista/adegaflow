let chart1, chart2, chart3, chartAno;

$(() => {
  getReceitaCusto()
  getReceitaCustoMes()
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








