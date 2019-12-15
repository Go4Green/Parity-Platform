<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
    >
      <v-list dense>
        <a href="/home">
          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-view-dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </a>
        <a href="/transactions">
          <v-list-item link>
            <v-list-item-action>
              <v-icon>sync_alt</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>My Transactions</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </a>
        <a href="/wallet">
          <v-list-item link>
            <v-list-item-action>
              <v-icon>account_balance_wallet</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>My Wallet</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </a>
        <a href="/charging-stations">
          <v-list-item link>
            <v-list-item-action>
              <v-icon>map</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Charging Stations</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </a>
        <a href="/settings">
          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-settings</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Settings</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </a>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      clipped-left
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title> Parity GoGreen </v-toolbar-title>

      <v-spacer></v-spacer>
      
      <v-btn icon onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <v-icon>exit_to_app</v-icon>
      </v-btn>
    </v-app-bar>

    <v-content>
      <v-container fluid fill-height>
        <v-layout>
          <slot></slot>
        </v-layout>
      </v-container>
    </v-content>

    <v-footer app>
      <div>&copy; Parity Platform PC {{ new Date().getFullYear() }}</div>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
    }),
    created () {
      this.$vuetify.theme.dark = true
    },
  }
</script>

<style scoped>
a:hover {
  text-decoration: none;
  color: #F18D0F;
}
</style>