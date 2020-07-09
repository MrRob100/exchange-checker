<template>
  <div>

    <div class="outer" v-for="event in events_formatted" :key="event.symbol">
      <listing
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
        };
    },

    mounted() {
      var events_formatted = JSON.parse(this.events);
      this.events_formatted = events_formatted;

    }
  }
</script>
