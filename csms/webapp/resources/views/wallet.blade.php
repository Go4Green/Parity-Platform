@extends('layouts.app')

@section('content')
<app>
  <v-container grid list-md>
    <v-layout wrap>
      <v-flex xs12>
        <h1 class="accent-text">{{ __('My Wallet') }}</h1>
      </v-flex>

      <v-flex xs12>
        <wallet></wallet>
      </v-flex>
    </v-layout>
  </v-container>
</app>
@endsection
