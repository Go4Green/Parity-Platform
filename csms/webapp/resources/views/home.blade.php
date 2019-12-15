@extends('layouts.app')

@section('content')
<app>
  <v-container grid list-md>
    <v-layout wrap>
      <v-flex xs12>
        <h1 class="accent-text">{{ __('Dashboard') }}</h1>
      </v-flex>

      <v-flex xs12>
        <dashboard 
          :demand="{{ $demand }}"
          :res-capacity="{{ $resCapacity }}"
          :kwh-cost="{{ $kwhCost }}"
        ></dashboard>
      </v-flex>
    </v-layout>
  </v-container>
</app>
@endsection
