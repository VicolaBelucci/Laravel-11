<div class="">
  
  <!-- Bar chart card -->
  <div class="col-span-2 bg-white rounded-md  dark:bg-darker">
    
    <!-- Card header -->
    <div class="flex items-center justify-between  p-4 border-b dark:border-primary" style="height: 60.8px;">
      <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Bar Chart</h4>

      <!-- Dropdown do Tailwind --> 
      <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-left">
        <div>
            <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="x-bind:aria-expanded='open'" aria-haspopup="true">
                Options
                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>  
            </button>
        </div>
    
        <div x-show="open"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Menu items -->
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Grafico Donuts</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Gráfico Barras</a>
            </div>
        </div>
    </div>
    </div>

    <!-- Chart -->
    <div class="relative">
      
      <div x-data="chart" class="p-6 pb-4 text-gray-900 dark:text-gray-100 " wire:ignore>
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