<template>
    <div id="app" @click="bodyClick">
        <div class="layout">
            <div class="main">
                <div class="one">
                    <Wheel ref="wheel" :items="items"  @spin-begin="spinBegin" @spin-complete="spinComplete"></Wheel>
                </div>
                <div class="two">
                    <div class="btn-wrapper">
                        <button :disabled="isSpinning" @click="spinWheel()" class="btn-spin">Spin!</button>
                    </div>
                </div>
            </div>
            <div class="aside">
                <List :items="items" @change="itemsChange"></List>
            </div>
        </div>
        <transition name="winner">
            <Winner :winner="winner" v-if="winner"></Winner>
        </transition>
        <div class="noise"></div>
    </div>
</template>

<script>

import List from "./components/List";
import Wheel from "./components/Wheel";
import Winner from "./components/Winner";

export default {
  name: 'app',
  components: {
      List,
      Wheel,
      Winner
  },

  data() {
      return {
          winner: undefined,
          isSpinning: false,
          items: [
              {title: "Apple"},
              {title: "Banana"},
              {title: "Blueberry"},
              {title: "Lemon"},
              {title: "Orange"},
              {title: "Pear"},
              {title: "Pineapple"},
              {title: "Raspberry"},
              {title: "Strawberry"},
              {title: ""}
          ]
      }
  },

    methods : {

        bodyClick() {
            if (this.winner !== undefined) {
                this.winner = undefined;
                this.$confetti.stop();
            }
        },

        itemsChange(items) {
            this.items = items;
        },

        spinWheel() {
            this.$refs.wheel.spinWheel();
        },

        spinBegin() {
            this.isSpinning = true;
            // eslint-disable-next-line no-console
            console.log("ab" );
        },

        spinComplete(winner) {
            this.winner = winner;
            this.isSpinning = false;
            this.$confetti.start({
                particlesPerFrame: 1
            });
        }
    }
}
</script>

<style>

/*

font-family: 'Henny Penny', cursive;
font-family: 'Lobster Two', cursive;
*/


html, body {
    min-height: 100%;
    display: flex;
}

body {
    flex: 1 1 auto;
    align-items: stretch;
    justify-content: stretch;
    background: url(assets/bg.svg) 50% 50% no-repeat;
    background-size: cover;
}
    
#app {
    flex: 1 1 auto;
    display: flex;
    align-items: stretch;
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


.btn-spin {
    position: relative;
    z-index: 2;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2vh 10vh;
    appearance: none;

    font-family: 'Lobster Two', cursive;
    font-size: 5vh;
    letter-spacing: 0.1em;
    text-align: center;
    color: #253F2B;
    text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.35), -1px -1px 0px #000000;


    background: linear-gradient(180deg, #FFFFFF 0%, #E4E6BC 45%, #989B5E 100%);
    box-shadow: 0px 1px 10px #000000, 0px 1px 3px #000000, inset 0px 2px 5px #FFFFFF;
    border-radius: 100rem;
    border: none;

    transition: all .3s ease;
}

.btn-spin:hover {
    color: #6930B1;
    text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.35), -1px -1px 0px rgba(0,0,0,0.75);
}


.btn-spin:active {
    transform: translateY(2px);
    outline: none;
    color: #854FC9;
    text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.25), -1px -1px 0px rgba(0,0,0,0.5);
    box-shadow: 0px -2px 10px #000000, 
                0px -1px 3px #000000, 
                inset 0px 2px 5px #FFFFFF,
                inset 0 1px 3px rgba(0,0,0,25);
}

.btn-spin:focus {
    outline: none;
}

.btn-spin:disabled {
    opacity: 0.5;
}

.btn-wrapper {
    padding: 2vh;
    

    background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.15) 0.01%, rgba(0, 0, 0, 0.05) 100%);
    box-shadow: inset 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px -1px 0px rgba(255, 255, 255, 0.1);
    border-radius: 100px;
}

/* Layout */

.layout {
    flex: 1 1 auto;
    display: flex;
    justify-content: space-between;
    padding-bottom: 2rem;
}

.layout .main {
    display: flex;
    flex: 1 1 60%;
    min-width: 60%;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
}

.layout .main .one {}

.layout .main .two {}

.layout .aside {
    flex: 1 1 35%;
    display: flex;
    min-width: 35%;
    justify-content: stretch;
    align-items: stretch;
}


/* Transitions */

.winner-enter-active {
    animation: flipInX 2s;
    backface-visibility: visible !important;
}

.winner-leave-active {
    animation: flipInX 0.5s reverse;
    backface-visibility: visible !important;
}

.winner-enter, .winner-leave-to {
    opacity: 1;
}

.winner-leave, .winner-enter-to {
    opacity: 1;
}

@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}

@keyframes jackInTheBox {
  from {
    opacity: 0;
    -webkit-transform: scale(0.1) rotate(30deg);
    transform: scale(0.1) rotate(30deg);
    -webkit-transform-origin: center bottom;
    transform-origin: center bottom;
  }

  50% {
    -webkit-transform: rotate(-10deg);
    transform: rotate(-10deg);
  }

  70% {
    -webkit-transform: rotate(3deg);
    transform: rotate(3deg);
  }

  to {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}

@keyframes flipInX {
  from {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
    opacity: 0;
  }

  40% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  60% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
    transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
    transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
  }

  to {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }
}



</style>
