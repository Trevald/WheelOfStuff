<template>
    <div id="index" @click="bodyClick">
        <div class="layout" v-if="items">
            <div class="main">
                <Wheel ref="wheel" :items="items"  @spin-begin="spinBegin" @spin-complete="spinComplete"></Wheel>
            </div>
            <div class="aside">
                <div class="list">
                    <div class="list-wrapper">
                        <p class="list-legend">Wheel of</p>
                        <div class="list-content">
                            <input class="list-title"  type="text" v-model="title">
                            <!--
                            <ul>
                                <li v-for="(item, index) in items" :key="index">
                                    <input type="text" placeholder="New item" v-model="item.title" @input="shouldAddNew(index)" :key="index" @keyup.8="shouldDelete(index)">
                                </li>
                            </ul>    
                            -->
                            <ListArea :items="items" @change="itemsChange"></ListArea>
                        </div>
                        <div class="actions">
                            <button :disabled="isSpinning" @click="spinWheel()"  class="btn-spin-2">Spin!</button>
                            <button class="btn-share" @click="share()" :disabled="isSharing">
                                <span class="visually-hidden">Share</span>
                                <svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.5 19.5H16.5V6H19.5L15 0L10.5 6H13.5V19.5ZM25.5 10.5H21V13.5H24V27H6V13.5H9V10.5H4.5C3.6705 10.5 3 11.1705 3 12V28.5C3 29.328 3.6705 30 4.5 30H25.5C26.3295 30 27 29.328 27 28.5V12C27 11.172 26.3295 10.5 25.5 10.5Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="winner-wrapper">
            <transition name="winner">
                <Winner :winner="winner" v-if="winner"></Winner>
            </transition>
        </div>
        
    </div>
</template>

<script>

import ListArea from "./ListArea";
import Wheel from "./Wheel";
import Winner from "./Winner";

export default {
  name: 'app',
  components: {
      ListArea,
      Wheel,
      Winner
  }, 

  data() {
      return {
          winner: undefined,
          isSharing: false,
          isSpinning: false,
          title: undefined,
          items: undefined
      }
  },

  beforeRouteUpdate(to, from, next) {
      // eslint-disable-next-line no-console
      console.log(to.params.id);
      this.getWheel(to.params.id);
      next();
  },

  mounted() {
      
      this.getWheel(this.$route.params.id);
      
  },


    methods : {

        share() {
            this.isSharing = true;
            const apiUrl = window.APP_API_URL; // Vue.prototype.$api;

            fetch(`${apiUrl}/api/wheel`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                        title: this.title,
                        items: this.items
                    })
                }).then((response) => {
                    this.isSharing = false;
                    // eslint-disable-next-line no-console
                    console.log("POST", response);

                    return response.text();
                    
                }).then((data) => {
                    navigator.clipboard.writeText(`${data}`);
                });
        },

        getWheel(id) {
            const uuid = id !== undefined ? id : "random";

// eslint-disable-next-line no-console
      console.log("getWheel", uuid, window.APP_API_URL);

      const apiUrl = window.APP_API_URL; // Vue.prototype.$api;

            fetch(`${apiUrl}/api/wheel/${uuid}`).then((response) => {
                return response.json();
            })
            .then((data) => {
                // eslint-disable-next-line no-console
      console.log("r", data);
                if (data.items) {
                    this.title = data.title;
                    this.items = data.items;
                }
            });
            
        },

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

    
#index {
    flex: 1 1 auto;
    
    display: flex;
    align-items: stretch;
    justify-content: center;

    transform: translate3d(0px, 0px, 0px);
}

.winner-wrapper {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    transform: translateZ(1000px);
transform-style: preserve-3d;
pointer-events: none;
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
    font-size: 4vh;
    letter-spacing: 0.1em;
    text-align: center;
    color: #253F2B;
    text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.35), -1px -1px 0px #000000;


    background: linear-gradient(180deg, #FFFFFF 0%, #E4E6BC 45%, #989B5E 100%);
    box-shadow: 0px 1px 10px #000000, 0px 1px 3px #000000, inset 0px 2px 5px #FFFFFF;
    border-radius: 100rem;
    border: none;

    transition: all .3s ease;
    will-change: transform;
    
    transform: translate3d(0,0,0);    
}

@media (orientation: portrait) {
    .btn-spin {
        font-size: 4vw;
    }
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

@media (orientation: portrait) {
    .btn-wrapper {
        padding: 2vw;
    }
}

/* Layout */

.layout {
    flex: 1 1 auto;
    display: flex;
    justify-content: center;
    align-items: stretch;
    padding: 2rem;
}

.layout .main {
    display: flex;
    flex: 0 0 auto;
    justify-content: center;
    align-items: center;
    padding: 0 2vw 0 0;
}

.layout .aside {
    flex: 0 1 30vw;
    display: flex;
    justify-content: stretch;
    align-items: stretch;
    padding: 1.5rem 0 1.5rem 2vw;
}

@media (orientation: portrait) {

    .layout {}
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

.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2vh 0;
    margin: 0 1rem;
    background: url(./../assets/hr.svg) 0 0 repeat-x;
}

.btn-spin-2 {
    position: relative;
    overflow: hidden;
    padding: 2vh;
    min-width: 15vw;
    font-family: Lobster Two;
    font-size: 2.75vh;
    line-height: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    letter-spacing: 0.1em;

    color: #000000;

    text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.5);


    background: linear-gradient(180deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0) 100%), 
    linear-gradient(191.88deg, #884B12 5.87%, #B69D34 24.26%, #FDF8E0 42.64%, #B79831 57.36%, #7D5515 69.77%, #BA9935 80.8%, #753F0B 94.13%);
    box-shadow: 0px 1px 10px #000000;
    border-radius: 100rem;
    border: none;
    transition: all .3s ease;
    animation: glowText 3s ease infinite; 
    mask-image: -webkit-radial-gradient(white, black);
}

.btn-spin:focus {
    outline: none;
}

.btn-spin-2:disabled {
    opacity: 0.5;
}

.btn-spin-2::after {
    content: "";
    position: absolute;
    top: -20%;
    right: 50%;
    bottom: -20%;
    left: 0;

    background: linear-gradient(-250deg, rgba(255, 255, 255, 0) 15.05%, rgba(255, 255, 255, 0.25) 31.74%, #FFFFFF 48.9%, rgba(255, 255, 255, 0.25) 69.76%, rgba(255, 255, 255, 0) 87.84%);
    transform: translateX(-100%);
    opacity: 0.5;
}

/*
.btn-spin-2:not(:disabled):hover {
        color: rgba(0,0,0,0.55);
        text-shadow: 1px 1px 7px rgba(255, 255, 255, 0.85);

        box-shadow: 0px 0px 20px rgba(255, 250, 245, 0.65), 
        0px 1px 10px #000000, 
        inset 0 0 15px rgba(255, 255, 255, 0.45);

    animation: none; 
}
*/

.btn-spin-2:not(:disabled)::after {
    animation: glow 6s ease infinite;
}

@keyframes glowText {
    0% {
        color: rgba(0,0,0,1);
        text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.5);
        box-shadow: 0px 0px 10px rgba(255, 250, 245, 0.35), 
        0px 1px 10px #000000, 
        inset 0 0 8px rgba(255, 255, 255, 0.15);
    }

    50% {
        color: rgba(0,0,0,0.55);
        text-shadow: 1px 1px 7px rgba(255, 255, 255, 0.85);

        box-shadow: 0px 0px 15px rgba(255, 250, 245, 0.5), 
        0px 1px 10px #000000, 
        inset 0 0 15px rgba(255, 255, 255, 0.45);
    }

    100% {
        color: rgba(0,0,0,1);
        text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.5);
                box-shadow: 0px 0px 10px rgba(255, 250, 245, 0.35), 
        0px 1px 10px #000000, 
        inset 0 0 8px rgba(255, 255, 255, 0.15);
    }
}

@keyframes glow {
    0% {
        opacity: 0.5;
        transform: translateX(-100%);
    }
  10% {
    transform: translateX(-100%);
  }
  40% {
    transform: translateX(200%);
    opacity: 0.5;
  }
  50% {
    transform: translateX(200%);
    opacity: 0;
  }  
  60% {
    transform: translateX(-100%);
    opacity: 0;
  }  
  100% {
    
  }  
}


.btn-share {
    width: 5vh;
    height: 5vh;
    display: flex;
    justify-content: center;
    align-items: center;

    filter: drop-shadow(rgba(0, 0, 0, 0.75) 2px 2px 1px);

    transition: all .3s ease;
}

.btn-share svg {
    flex: 1 1 auto;
    transition: inherit;
}

.btn-share path {
    fill: #E6EABE;
    transition: inherit;
}

.btn-share:not(:disabled):hover svg {
    transform: scale(1.5) translateY(-25%);
}

.btn-share:not(:disabled):hover path {
    fill: white;
}

.btn-share:disabled {
    opacity: 0.5;
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
