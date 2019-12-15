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
									{{ kwhCost }}
								</p>
								<p>Credits per kWh</p>
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
				<v-row mt-4>
					<v-col cols=12>
						<v-card>
							<v-container>
								<v-row>
									<v-col cols="6" class="mx-auto">
										<v-text-field
											label="Demand (MW)"
											v-model="newDemand"
											outlined
										></v-text-field>
									</v-col>
									<v-col cols="6" class="mx-auto">
										<v-text-field
											label="RES Capacity (MW)"
											v-model="newResCapacity"
											outlined
										></v-text-field>
									</v-col>
									<v-btn class="lx-auto" @click="updateKwhCostParameters">Update values</v-btn>
								</v-row>
							</v-container>
						</v-card>
					</v-col>
				</v-row>
			</v-col>

			<v-col cols="6">
				<v-row>
					<v-col cols="12">
						<v-card :color="notificationColor">
							<v-card-text>
								<p class="display-1 text--primary">
									{{ chargingNotification }}
								</p>
							</v-card-text>
						</v-card>
					</v-col>
				</v-row>
				<v-row>
					<v-col cols="12">
						<v-card>
							<v-card-text>
								<p class="display-1 text--primary">
									Charging Cost
								</p>
								<v-row>
									<v-col cols="12">
										<v-text-field
											label="Charging Time (minutes)"
											v-model="chargeTime"
											outlined
										></v-text-field>
									</v-col>
								</v-row>
								<v-row>
									<v-col cols="12">
										<v-text-field
											label="kWh"
											outlined
											readonly
											v-model="kWh"
										></v-text-field>
									</v-col>
								</v-row>
								<v-row>
									<v-col cols="12">
										<v-text-field
											label="Total Charging Cost (in Credits)"
											outlined
											readonly
											v-model="chargeCost"
										></v-text-field>
									</v-col>
								</v-row>
							</v-card-text>
						</v-card>
					</v-col>
				</v-row>
			</v-col>
		</v-row>

		<v-row mt-4>
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
import axios from 'axios';

export default {  
	props: {
		demand: Number,
		resCapacity: Number,
		kwhCost: Number
	},

  	data() {
    	return {
			tokenData: tokenChartData,
			chargeTime: null,
			newResCapacity: null,
			newDemand: null,
			notificationColor: ""
    	}
	},
	
	computed: {
		kWh: function() {
			return Math.round((this.chargeTime * 50 / 60) * 100) / 100;
		},

		kWhCost: function() {
			return 1.2*(this.newDemand/6000)-0.6* (this.newResCapacity/this.newDemand) + 6*((this.newDemand - this.newResCapacity)/ this.newDemand);
		},

		chargeCost: function() {
			return Math.round((this.kWh * this.kWhCost) * 100) / 100;
		},

		chargingNotification: function() {
			if (this.kwhCost <= 0.6) {
				this.notificationColor = "green";
				return "Το κόστος φόρτισης είναι φθηνότερο για την επόμενη ώρα."
			} else {
				this.notificationColor = "red";
				return "Το κόστος φόρτισης είναι ακριβότερο για την επόμενη ώρα."
			}
		}
	},

  mounted() {
		this.createChart('token-chart', this.tokenData);
		this.newResCapacity = this.resCapacity;
		this.newDemand = this.demand;
  },

  methods: {
    createChart(chartId, chartData) {
      const ctx = document.getElementById(chartId);
      const myChart = new Chart(ctx, {
        type: chartData.type,
        data: chartData.data,
        options: chartData.options,
      });
		},
		
		updateKwhCostParameters() {
			axios.post('/kwh-costs', {
				demand: this.newDemand,
				res_capacity: this.newResCapacity,
				cost: this.kWhCost
			}).then(res => {
				console.log(res.data)
				location.reload()
			})
		}
  } 
}
</script>