<template>
  <v-container>
		<v-row>
			<v-col cols="6">
				<v-card color="primary">
					<v-card-text>
						<p class="display-1 text--primary">
							{{ walletData.balance }} {{ walletData.currency }}
						</p>
						<p>Balance</p>
					</v-card-text>
				</v-card>
			</v-col>
			<v-col cols="6">
				<v-card mt-4>
					<v-card-text>
						<p class="display-1 text--primary">
							Update Wallet
						</p>
						<v-btn>Buy Credits</v-btn>
						<v-btn>Add new Card</v-btn>
					</v-card-text>
				</v-card>
			</v-col>
		</v-row>
  </v-container>
</template>

<script>
export default {
	props: {
		walletData: Object
	}
}
</script>

<style>

</style>