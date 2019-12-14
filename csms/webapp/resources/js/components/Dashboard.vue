<template>
  <v-container>
		<v-row>
			<v-flex xs3 class="mx-auto">
				<v-card>
					<v-card-text>
						<p class="display-1 text--primary">
							24%
						</p>
						<p>Nissan Leaf Battery</p>
					</v-card-text>
				</v-card>
			</v-flex>
			<v-flex xs3>
				<v-card color="primary">
					<v-card-text>
						<p class="display-1 text--primary">
							PRT 0.2217EUR/PRT
						</p>
					</v-card-text>
				</v-card>
			</v-flex>
			<v-flex xs6>
				<v-card>
					<v-card-text>
						<p class="display-1 text--primary">
							Transactions
						</p>
					</v-card-text>
				</v-card>
			</v-flex>
		</v-row>
		<v-row mt-4>
			<v-flex xs6>
				<div id="chart">
					<canvas id="token-chart"></canvas>
				</div>
			</v-flex>
		</v-row>
  </v-container>
</template>

<script>
import Chart from 'chart.js'
import tokenChartData from './token-data.js';

export default {  
  data() {
    return {
      tokenData: tokenChartData,
    }
  },

  mounted() {
    this.createChart('token-chart', this.tokenData);
  },

  methods: {
    createChart(chartId, chartData) {
      const ctx = document.getElementById(chartId);
      const myChart = new Chart(ctx, {
        type: chartData.type,
        data: chartData.data,
        options: chartData.options,
      });
    }
  } 
}
</script>