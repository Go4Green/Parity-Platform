<template>
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
            label="Total Charging Cost"
            outlined
						readonly
						v-model="chargeCost"
          ></v-text-field>
        </v-col>
			</v-row>
		</v-card-text>
	</v-card>
</template>

<script>
export default {
	data() {
		return {
			chargeTime: null
		}
	},

	computed: {
		kWh: function() {
			return Math.round((this.chargeTime * 50 / 60) * 100) / 100;
		},

		chargeCost: function() {
			return this.kWh;
		}
	}
}
</script>

<style>

</style>