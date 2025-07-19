var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];

var randomizeArray = function (arg) {
  var array = arg.slice();
  var currentIndex = array.length, temporaryValue, randomIndex;

  while (0 !== currentIndex) {

      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;

      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
  }

  return array;
}

var spark1 = {
  chart: {
      id: 'sparkline1',
      group: 'sparklines',
      type: 'area',
      height: 160,
      sparkline: {
        enabled: true
      },
  },
  stroke: {
    curve: 'straight'
  },
  fill: {
    opacity: 1,
  },
  series: [{
    name: 'Receita',
    data: randomizeArray(sparklineData)
  }],
  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
  yaxis: {
      min: 0
  },
  xaxis: {
      type: 'datetime',
  },
  colors: ['#DCE6EC'],
  title: {
      text: '$424,652',
      offsetX: 30,
      style: {
      fontSize: '24px',
      color: '#ffffff'
      }
  },
  subtitle: {
      text: 'Receita',
      offsetX: 30,
      style: {
      fontSize: '14px',
      color: '#ffffff'
      }
  }
}

var spark2 = {
  chart: {
    id: 'sparkline2',
    group: 'sparklines',
    type: 'area',
    height: 160,
    sparkline: {
      enabled: true
    },
  },
  stroke: {
    curve: 'straight'
  },
  fill: {
    opacity: 1,
  },
  series: [{
    name: 'Custos',
    data: randomizeArray(sparklineData)
  }],
  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
  yaxis: {
    min: 0
  },
  xaxis: {
    type: 'datetime',
  },
  colors: ['#DCE6EC'],
  title: {
    text: '$235,312',
    offsetX: 30,
    style: {
      fontSize: '24px',
      color: '#ffffff'
    }
  },
  subtitle: {
    text: 'Custos',
    offsetX: 30,
    style: {
      fontSize: '14px',
      color: '#ffffff'
    }
  }
}

var spark3 = {
  chart: {
    id: 'sparkline3',
    group: 'sparklines',
    type: 'area',
    height: 160,
    sparkline: {
      enabled: true
    },
  },
  stroke: {
    curve: 'straight'
  },
  fill: {
    opacity: 1,
  },
  series: [{
    name: 'Lucro',
    data: randomizeArray(sparklineData)
  }],
  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
  xaxis: {
    type: 'datetime',
  },
  yaxis: {
    min: 0
  },
  colors: ['#008FFB'],
  //colors: ['#5564BE'],
  title: {
    text: '$135,965',
    offsetX: 30,
    style: {
      fontSize: '24px',
      color: '#ffffff'
    }
  },
  subtitle: {
    text: 'Lucro',
    offsetX: 30,
    style: {
      fontSize: '14px',
      color: '#ffffff'
    }
  }
}

var options = {
    series: [{
    name: 'Receita',
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
new ApexCharts(document.querySelector("#spark1"), spark1).render();
new ApexCharts(document.querySelector("#spark2"), spark2).render();
new ApexCharts(document.querySelector("#spark3"), spark3).render();