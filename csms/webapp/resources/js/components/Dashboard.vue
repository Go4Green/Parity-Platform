<template>
  <v-container>
		<v-row>
			<v-col cols="6">
				<v-row>
					<v-col cols="6" class="mx-auto">
						<v-card>
							<v-card-text>
								<p class="display-1 text--primary">
									24%
								</p>
								<p>Nissan Leaf Battery</p>
							</v-card-text>
						</v-card>
					</v-col>
					<v-col cols="6">
						<v-card color="primary">
							<v-card-text>
								<p class="display-1 text--primary">
									PRT 0.2217EUR/PRT
								</p>
							</v-card-text>
						</v-card>
					</v-col>
				</v-row>
				<v-row mt-4>
					<v-col cols="12">
						<div id="chart">
							<canvas id="token-chart"></canvas>
						</div>
					</v-col>
				</v-row>
			</v-col>
			<v-col cols="6">
				<charging-cost></charging-cost>
			</v-col>
		</v-row>
		<v-row mt-4>
			<v-col cols="6">
				<div id="chart">
					<canvas id="token-chart"></canvas>
				</div>
			</v-col>
			<v-col cols="6">
				<v-card>
					<v-card-text>
						<p class="display-1 text--primary">
							Transactions
						</p>
					</v-card-text>
				</v-card>
			</v-col>
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