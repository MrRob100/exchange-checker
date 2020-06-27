<template>
    <div class="ctr">

<div class="toggle-button">

    <button 
    v-if="showPrice"
    @click="toggle()"
    >Hide Price</button>

    <button 
    v-else
    @click="toggle()"
    >Show Price</button>

</div>

      <div class="what">{{ symbol }} added to {{ exchange }}</div>

      <div class="when">{{ date }}}</div>

      <div class="avail"></div>

      <div>also on: {{ also }}</div>

      <div
      v-if="showPrice" 
      class="price-action">
        PRICE!!!!
          <li v-for="price in priceAction" :key="price">
            {{ price }}
          </li>
      </div>

    </div>
</template>

<script>
    export default {

      props: ['symbol', 'exchange', 'timestamp', 'also'],

      data: function() {
        return {
          date: "",
          priceAction: {},
          showPrice: false
        };
    },

    mounted() {

      this.date = new Date(this.timestamp * 1000);

    },

    methods: {
      toggle: function() {
        this.showPrice = !this.showPrice;
        if (this.showPrice) {
          this.fetchPrice();
        }
      },

      fetchPrice: function() {

        var request = new XMLHttpRequest();
        var path = "data/price/" + this.symbol + "-" + this.exchange + ".json";
        request.open("GET", path, true);

        var that = this;
        request.send();
        request.onload = function() {
          if (request.status === 200) {
            that.priceAction = JSON.parse(request.response).price_data;
          }
        };
      }
    }

  }
</script>
