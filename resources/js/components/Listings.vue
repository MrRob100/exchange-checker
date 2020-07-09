<template>
  <div>
  <div class="toggle-button">

      <button 
      v-if="show"
      @click="toggle()"
      >Hide All Prices</button>

      <button 
      v-else
      @click="toggle()"
      >Show All Prices</button>

  </div>
  <br>
    <div class="outer" v-for="event in events_formatted" :key="event.symbol">
      <listing
        :show="show"
        :symbol="event.symbol"
        :exchange="event.exchange"
        :timestamp="event.timestamp"
        :also="event.alsoOn"
      ></listing>
    </div>

  </div>

</template>

<script>
    export default {

      props: ['events'],

      data: function() {
        return {
          events_formatted: {},
          show: false,
        };
    },

    mounted() {
      var events_formatted = JSON.parse(this.events);
      this.events_formatted = events_formatted;
    },

    methods:{
      toggle: function() {
        this.show = !this.show;
      }
    }
  }

</script>
