<template>
    <div id="app">
        <div class="wheel-container">
            <Wheel></Wheel>
            <div class="wheel-border"></div>
            <div class="wheel-middle"></div>
        </div>
        <div class="noise"></div>
    </div>
</template>

<script>

import Wheel from "./components/Wheel";

export default {
  name: 'app',
  components: {
      Wheel
  },

  data() {
      return {
        
      }
  }
}
</script>

<style>

html, body {
    min-height: 100%;
    display: flex;
}

body {
    flex: 1 1 auto;
    align-items: center;
    justify-content: center;
    background: url(assets/bg.svg) 50% 50% no-repeat;
    background-size: cover;
}
    
#app {
    display: flex;
    align-items: center;
    justify-content: center;
}

.noise {
    position: absolute;
    z-index: 10;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    pointer-events: none;

    background: url(assets/noise.png) 0 0 repeat;
}

.wheel-container {
    position: relative;
}

.wheel-border {
    position: absolute;
    top: 10px;
    right: 10px;
    bottom: 10px;
    left: 10px;
    pointer-events: none;

    background: url(assets/wheel-overlay.svg) 0 0 no-repeat;
    background-size: 100% 100%;
}

.wheel-middle {
    position: absolute;
    top: 10px;
    right: 10px;
    bottom: 10px;
    left: 10px;
    pointer-events: none;

    background: url(assets/wheel-middle@4x.png) 50% 50% no-repeat;
    background-size: 15% 15%;
}

</style>
