<div class="py-12 overflow-x-auto">
  
  <!-- Bar chart card -->
  <div class="col-span-2 bg-white rounded-md w-[544px]  dark:bg-darker">
    
    <!-- Card header -->
    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
      <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Bar Chart</h4>
    </div>

    <!-- Chart -->
    <div class="relative">
      
      <div x-data="chart" class="p-6 text-gray-900 dark:text-gray-100 max-h-80 w-[544px] " wire:ignore>
        <!-- Conteúdo do card -->
        <canvas id="myChart"></canvas>
      </div>
      
      <div wire:loading class="absolute inset-0 bg-white bg-opacity-50">
    
      </div>

    </div>
  </div>
</div>



@assets
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
    <script>
      Alpine.data('chart', () => {
        return {
          init() {
            let chart = this.initChart(this.$wire.dataset)

            this.$wire.$watch('dataset', () => {
              this.updateChart(chart, this.$wire.dataset)
            })
          },

          updateChart(chart, dataset){
            let labels = dataset.labels
            let values = dataset.datasets[0].data

            chart.data.labels = labels
            chart.data.datasets[0].data = values
            chart.update()
          },

          initChart(dataset){
            const ctx = document.getElementById('myChart').getContext('2d');
          
             return new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: dataset.labels,
                  datasets: dataset.datasets,
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: true,
                  scales: {
                    y: {
                      beginAtZero: true,
                      grid: {
                        display: false // Isso remove as linhas de grade do eixo X
                      }
                    },
                    x: {
                      grid: {
                        display: false // Isso remove as linhas de grade do eixo X
                      }
                    }
                  },
                  plugins: {
                    legend: {
                      display: false
                    }
                  }
                }
              });

          }
        }
      })
    </script>
@endscript