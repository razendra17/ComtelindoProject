import ApexCharts from "apexcharts";

window.chart = null;

const chartOptions = {
  series: [
    {
      name: "Pengajuan",
      data: chartData
    }
  ],

  colors: ["#FFA500"],

  chart: {
    fontFamily: "Outfit, sans-serif",
    height: 310,
    type: "area",
    toolbar: {
      show: false
    }
  },

  fill: {
    gradient: {
      enabled: true,
      opacityFrom: 0.55,
      opacityTo: 0
    }
  },

  stroke: {
    curve: "smooth",
    width: 2
  },

  markers: {
    size: 4
  },

  grid: {
    xaxis: {
      lines: { show: false }
    },
    yaxis: {
      lines: { show: true }
    }
  },

  dataLabels: {
    enabled: false
  },

  xaxis: {
    type: "category",
    categories: chartLabels,
    axisBorder: { show: false },
    axisTicks: { show: false }
  }
};

const chart03 = () => {

  const chartSelector = document.querySelector("#chartThree");

  if (!chartSelector) return;

  window.chart = new ApexCharts(chartSelector, chartOptions);
  window.chart.render();
};



export default chart03;