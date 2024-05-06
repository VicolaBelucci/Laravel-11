<div>
    <div class="w-full">
        <div class="py-12 flex justify-center">
            <div class=" w-full mx-auto sm:px-6 lg:px-8">
                <div class="relative">
                    <div class="bg-white overflow-y-auto dark:bg-gray-800 shadow-sm sm:rounded-lg">
                        <h2 class="p-6 pb-0 text-gray-900">Gráfico Tarefas</h2>
                        <div x-data="chart" class="p-6 text-gray-900 dark:text-gray-100 max-h-80 w-full" wire:ignore>
                            <!-- Conteúdo do card -->
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div wire:loading class="absolute inset-0 bg-white bg-opacity-50">
    
                </div>
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