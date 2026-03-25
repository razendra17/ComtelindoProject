import ApexCharts from "apexcharts";

const percent =Number (((current / target)*100).toFixed(2));
// const percent =Number (((total / target) * 100).toFixed(2));
// ===== chartTwo
const chart02 = () => {
  const chartTwoOptions = {
    series: [percent],
    colors: ["#FFA500"],
    chart: {
      fontFamily: "Outfit, sans-serif",
      type: "radialBar",
      height: 330,
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      radialBar: {
        startAngle: -90,
        endAngle: 90,
        hollow: {
          size: "80%",
        },
        track: {
          background: "#E4E7EC",
          strokeWidth: "100%",
          margin: 5, // margin is in pixels
        },
        dataLabels: {
          name: {
            show: false,
          },
          value: {
            fontSize: "36px",
            fontWeight: "600",
            offsetY: 60,
            color: "#1D2939",
            formatter: function (val) {
              return val + "%";
            },
          },
        },
      },
    },
    fill: {
      type: "solid",
      colors: ["#FFA500"],
    },
    stroke: {
      lineCap: "round",
    },
    labels: ["Progress"],
  };

  const chartSelector = document.querySelectorAll("#chartTwo");

  if (chartSelector.length) {
    const chartFour = new ApexCharts(
      document.querySelector("#chartTwo"),
      chartTwoOptions,
    );
    chartFour.render();
  }
};

export default chart02;
