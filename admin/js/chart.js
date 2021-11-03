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
gradient.addColorStop(0, '#A788FF');
gradient.addColorStop(1, '#e4d9ff86');

const data = {
   labels,
   datasets: [
      {
         label: "Sales",
         data: [500, 1800, 1600, 3800, 2100, 4600, 2900, 2300],
         tension: 0.4,
         fill: true,
         borderColor: "#643AFF",
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
      scales: {
         xAxes: {
            grid: {
               display: false,
               color: "#FFFFFF"
            }
         }
      }
   },
   
}

const myChart = new Chart(ctx, config);