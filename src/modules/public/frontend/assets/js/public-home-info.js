// 1) Declare chart1/2/3 _antes_ de usar
let chart1, chart2, chart3;

$(() => {
  // 2) Agora sim você pode chamar
  getReceitaCusto();
});

async function getReceitaCusto() {
  const url = 'revenue-cost';
  const response = await $.ajax(url);

  // 3) Se já existirem instâncias, destrua antes
  if (chart1) chart1.destroy();
  if (chart2) chart2.destroy();
  if (chart3) chart3.destroy();

  // ——— reste do código: monta labels, arrays e formatadores ———
  const today  = new Date();
  const year   = today.getFullYear();
  const month  = String(today.getMonth()+1).padStart(2,'0');
  const brDay  = d => String(d).padStart(2,'0');

  const custosArr   = Object.values(response.custos);
  const receitasArr = Object.values(response.receitas);
  const lucroArr    = Object.values(response.lucros);

  const daysInMonth = custosArr.length;
  const labels = Array.from({ length: daysInMonth }, (_, i) =>
    `${brDay(i+1)}/${month}/${year}`
  );

  const fmtBRL = v =>
    new Intl.NumberFormat('pt-BR',{ style:'currency',currency:'BRL'}).format(v);

  const totalCustos   = custosArr.reduce((a,b)=>a+b,0);
  const totalReceitas = receitasArr.reduce((a,b)=>a+b,0);
  const totalLucro    = lucroArr.reduce((a,b)=>a+b,0);

  // ——— opções comuns ———
  const baseOpts = {
    chart:      { group:'sparklines', type:'area', height:160, sparkline:{enabled:true} },
    stroke:     { curve:'straight' },
    fill:       { opacity:1 },
    labels:     labels,
    xaxis:      { type:'category' },
    yaxis:      { min:0 },
    title:      { offsetX:30, style:{fontSize:'24px',color:'#fff'} },
    subtitle:   { offsetX:30, style:{fontSize:'14px',color:'#fff'} },
    tooltip:    { enabled:true, shared:true, intersect:false, followCursor:false,
                  y:{formatter:val=>fmtBRL(val)} }
  };

  // ——— chart1 ———
  
  chart1 = new ApexCharts(
    document.querySelector("#spark1"),
    {
      chart: {
        id: 'spark1',
        group: 'sparklines',
        type: 'area',
        height: 160,
        sparkline: { enabled: true },
      },
      stroke: { curve: 'straight' },
      fill:   { opacity: 1 },
      labels: labels,
      xaxis:  { type: 'category' },
      yaxis:  { min: 0 },
      tooltip: {
        enabled: true,
        shared: true,
        intersect: false,
        followCursor: false,
        y: {
          formatter: val => fmtBRL(val)
        },
        x: {
          formatter: val => {
            return `${brDay(val)}/${month}/${year}`;
          }
        }
      },
      series: [{ name: 'Custos', data: custosArr }],
      title: {
        text: fmtBRL(totalCustos),
        offsetX: 30,
        style: { fontSize: '24px', color: '#ffffff' }
      },
      subtitle: {
        text: 'Custos',
        offsetX: 30,
        style: { fontSize: '14px', color: '#ffffff' }
      },
      colors: ['#feb019'],
    }
  );

  chart2 = new ApexCharts(
    document.querySelector("#spark2"),
    {
      chart: {
        id: 'spark2',
        group: 'sparklines',
        type: 'area',
        height: 160,
        sparkline: { enabled: true },
      },
      stroke: { curve: 'straight' },
      fill:   { opacity: 1 },
      labels: labels,
      xaxis:  { type: 'category' },
      yaxis:  { min: 0 },
      tooltip: {
        enabled: true,
        shared: true,
        intersect: false,
        followCursor: false,
        y: {
          formatter: val => fmtBRL(val)
        },
        x: {
          formatter: val => {
            return `${brDay(val)}/${month}/${year}`;
          }
        }
      },
      series: [{ name: 'Receita', data: receitasArr }],
      title: {
        text: fmtBRL(totalReceitas),
        offsetX: 30,
        style: { fontSize: '24px', color: '#ffffff' }
      },
      subtitle: {
        text: 'Receita',
        offsetX: 30,
        style: { fontSize: '14px', color: '#ffffff' }
      },
      colors: ['#008ffb'],
    }
  )


  chart3 = new ApexCharts(
    document.querySelector("#spark3"),
    {
      chart: {
        id: 'spark3',
        group: 'sparklines',
        type: 'area',
        height: 160,
        sparkline: { enabled: true },
      },
      stroke: { curve: 'straight' },
      fill:   { opacity: 1 },
      labels: labels,
      xaxis:  { type: 'category' },
      yaxis:  { min: 0 },
      tooltip: {
        enabled: true,
        shared: true,
        intersect: false,
        followCursor: false,
        y: {
          formatter: val => fmtBRL(val)
        },
        x: {
          formatter: val => {
            return `${brDay(val)}/${month}/${year}`;
          }
        }
      },
      series: [{ name: 'Lucro', data: lucroArr }],
      title: {
        text: fmtBRL(totalLucro),
        offsetX: 30,
        style: { fontSize: '24px', color: '#ffffff' }
      },
      subtitle: {
        text: 'Lucro',
        offsetX: 30,
        style: { fontSize: '14px', color: '#ffffff' }
      },
      colors: ['#00e396'],
    }
  );


  // ——— Render ———
  chart1.render();
  chart2.render();
  chart3.render();
}
















var options = {
    series: [{
    name: 'Receitaaaa',
    data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 44, 56, 76]
  }, {
    name: 'Custo',
    data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 12, 56, 86]
  }, {
    name: 'Lucro',
    data: [35, 41, 36, 26, 45, 48, 52, 53, 41, 23,56,123]
  }],
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
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dez'],
    labels: {
      style: {
        colors: '#ffffff'
      }
    }
  },
  yaxis: {
    title: {
      text: 'Receita x Custo X Lucro',
      labels: {
        style: {
          colors: '#ffffff'
        }
      }
    }
  },
   legend: {
    labels: {
      colors: '#ffffff' // <-- Cor da legenda (Receita, Custo, etc.)
    }
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    theme: 'dark',
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands"
      }
    }
  }
};

var chart = new ApexCharts(document.querySelector("#chart"), options)
chart.render();
