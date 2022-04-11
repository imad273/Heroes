const ctx = document.getElementById("myChart").getContext("2d");

let labels = [
   '',
   '2015',
   '2016',
   '2017',
   '2018',
   '2019',
   '2020',
   '2021'
];

let gradient = ctx.createLinearGradient(0, 0, 100, 400);
gradient.addColorStop(0, '#EDFDFD');
gradient.addColorStop(1, '#EDFDFD59');

const data = {
   labels,
   datasets: [
      {
         label: "",
         data: [500, 1800, 1600, 3800, 2100, 4600, 2900, 2300],
         tension: 0.4,
         fill: true,
         borderColor: "#1CD4D4",
         color: "#000",
         backgroundColor: gradient,
      }
   ]
}


const config = {
   type: 'line',
   data: data,

   options: {
      responsive: true,
      plugins: {
         legend: {
            display: false,
         }
      },
      scales: {
         y: {
            display: false,
         },
         x: {
            display: true,  // this will remove all the x-axis grid lines
            grid: {
               display: false,
            },
            ticks: {
               color: "#BAC0CA"
            }
         },

      }
   },

}

const myChart = new Chart(ctx, config);