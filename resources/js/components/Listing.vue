<template>
    <div class="ctr">
        
      <div class="what">{{ symbol }} added to {{ exchange }}</div>

      <div class="when">{{ date }}}</div>

      <div class="avail"></div>

      <p>also on: {{ also }}</p>

      <div class="price-action"></div>

    </div>
</template>

<script>
    export default {

      props: ['symbol', 'exchange', 'timestamp', 'also'],

      data: function() {
        return {
          date: "",
          priceAction: {}
        };
    },

    mounted() {

      this.date = new Date(this.timestamp * 1000);

      var request = new XMLHttpRequest();

      var path = "data/price/" + this.symbol + "-" + this.exchange + ".json";
      request.open("GET", path, true);

      var that = this;
      request.send();
      request.onload = function() {
        if (request.status === 200) {
          that.priceAction = JSON.parse(request.response).price_data;
          console.log(that.priceAction);
        }
      };

    }
  }
</script>
