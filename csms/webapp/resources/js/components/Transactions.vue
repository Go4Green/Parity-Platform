<template>
  <v-card>
    <v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="transactions"
      :search="search"
    ></v-data-table>
  </v-card>
</template>

<script>
export default {
	props: {
		transactions: Array
	},

	data () {
		return {
			search: '',
			headers: [
				{ text: 'TX ID', value: 'id' },
				{ text: 'Station ID', value: 'charging_station_id' },
				{ text: 'Charge Start', value: 'charge_start' },
        { text: 'Charge End', value: 'charge_end' },
        { text: 'Total Cost (in Credits)', value: 'total_charging_cost' },
			],
		}
	},
}
</script>