<template>
  <div id="wheel">
      <div class="wheel-wrapper">
          <div class="wheel">
            <svg viewBox="0 0 500 500" class="wheel-svg" ref="wheel">
                <ellipse class="wheel-background" cx="250" cy="250" rx="250" ry="250" fill="#D24683"/>
                <g v-for="(label, index) in labels" :key="index" :transform="getPathTransform(index)">
                    <path :d="getSVGData()" :fill="getFillColor(index)"  />
                    <text x="450" y="250" :fill="getTextFill(index)" text-anchor="end" :transform="getTextTransform(index)">{{label.title}}</text>
                </g>

                <ellipse class="wheel-dots" cx="251" cy="251" rx="225" ry="225" fill="transparent" stroke="#000000" stroke-opacity="0.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0 20"/>
                <ellipse class="wheel-dots" cx="250" cy="250" rx="225" ry="225" fill="transparent" stroke="#4B5156" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0 20"/>
            
            </svg>
        </div>
      </div>
    <div class="wheel-border">
<svg viewBox="0 0 594 594" fill="none" xmlns="http://www.w3.org/2000/svg">
<g filter="url(#filter0_ii)">
<circle cx="297" cy="297" r="274" fill="url(#paint0_radial)"/>
</g>
<g filter="url(#filter1_ii)">
<path fill-rule="evenodd" clip-rule="evenodd" d="M297 594C461.029 594 594 461.029 594 297C594 132.971 461.029 0 297 0C132.971 0 0 132.971 0 297C0 461.029 132.971 594 297 594ZM297 571C448.326 571 571 448.326 571 297C571 145.674 448.326 23 297 23C145.674 23 23 145.674 23 297C23 448.326 145.674 571 297 571Z" fill="url(#paint1_linear)"/>
</g>
<defs>
<filter id="filter0_ii" x="23" y="23" width="548" height="550" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dy="2"/>
<feGaussianBlur stdDeviation="5"/>
<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
<feBlend mode="normal" in2="shape" result="effect1_innerShadow"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dy="1"/>
<feGaussianBlur stdDeviation="1"/>
<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.5 0"/>
<feBlend mode="normal" in2="effect1_innerShadow" result="effect2_innerShadow"/>
</filter>
<filter id="filter1_ii" x="0" y="-2" width="594" height="597" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dy="1"/>
<feGaussianBlur stdDeviation="1"/>
<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.69 0"/>
<feBlend mode="normal" in2="shape" result="effect1_innerShadow"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dy="-2"/>
<feGaussianBlur stdDeviation="2"/>
<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
<feBlend mode="normal" in2="effect1_innerShadow" result="effect2_innerShadow"/>
</filter>
<radialGradient id="paint0_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(297 297) rotate(90) scale(274)">
<stop stop-opacity="0.07"/>
<stop offset="0.375" stop-opacity="0.03"/>
<stop offset="1" stop-opacity="0.15"/>
</radialGradient>
<linearGradient id="paint1_linear" x1="297" y1="0" x2="297" y2="594" gradientUnits="userSpaceOnUse">
<stop stop-color="#BA1F1F"/>
<stop offset="0.565657" stop-color="#A91515"/>
<stop offset="1" stop-color="#751212"/>
</linearGradient>
</defs>
</svg>

    </div>
    <div class="wheel-middle"></div>      
      <div class="top"></div>
    <div  style="position: fixed; top: 10px; left: 10px; display: none;">
        <p style="color: white; margin-top: 20px; font-size: 18px;">{{labels[winner]}}</p>
    </div>
  </div>
</template>

<script>

import anime from "animejs/lib/anime.es.js";
const tinycolor = require("tinycolor2");

export default {
  name: 'wheel',
  components: {
    
  },

  props: {
      items: Array
  },

  data() {
      return {
          isspining: false,
          winner: undefined,
          wheelRotation: undefined,
          bgColors: [
              "#D24683",
              "#9559E2",
              "#F5B404",
              "#E34443",
              "#F0F2E6",
              "#31873A",
              "#4F4BFB",
              "#F5B404",
              "#F0F2E6",
              "#86B89A",
              "#A42361",
              "#7636C9",
              "#CF9804",
              "#E34E4E",
              "#F0F2E6",
              "#F5B404"
          ]
      }
  },

    computed: {
        numOfParts() {
            return this.labels.length;
        },

        localItems() {
            return this.items.filter( item => item.title !== "");
        },

        labels() {
            // return this.origLabels;
            return this.localItems.length < 8 ? this.localItems.concat(this.localItems) : this.localItems;
        }
    },

    methods: {
        getAngle() {
            return 360 / this.numOfParts;
        },

        getAngleInRadians() {
            const angleInDegrees = this.getAngle();
            return -angleInDegrees * Math.PI / 180.0;
        },

        getCartesianCoordinates() {
            const centerX = this.getCenterCoords().x;
            const centerY = this.getCenterCoords().y;
            const angleInRadians = this.getAngleInRadians();
            const radius = this.getRadius();

            return {
                x: centerX + radius * Math.cos(angleInRadians),
                y: centerY + radius * Math.sin(angleInRadians)
            }
        },

        getCenterCoords() {
            return {
                x: 500 / 2,
                y: 500 / 2
            }
        },

        getRadius() {
            return 500 / 2;
        },

        getSVGData() {
            const centerX = this.getCenterCoords().x;
            const centerY = this.getCenterCoords().y;
            const radius = this.getRadius();
            const cartesianCoordinateX = this.getCartesianCoordinates().x;
            const cartesianCoordinateY = this.getCartesianCoordinates().y;

            // M = MoveTo, L = Draw Line, A = Draw Arc
            return `M${centerX},${centerY} l${radius},0 A${radius},${radius} 0 0,0 ${cartesianCoordinateX}, ${cartesianCoordinateY} z`;
        },

        getPathTransform(index) {
            const centerX = this.getCenterCoords().x;
            const centerY = this.getCenterCoords().y;            
            const rotateAmount = this.getAngle() * index;

            return `rotate(${rotateAmount} ${centerX} ${centerY})`;
        },

        getTextTransform() {
            const centerX = this.getCenterCoords().x; // 250
            const centerY = this.getCenterCoords().y; // 250
            const rotateAmount = (this.getAngle() / 2.2) * -1;

            return `rotate(${rotateAmount} ${centerX} ${centerY})`;            
        },

        getFillColor(index) {
            return this.bgColors[index] !== undefined ? this.bgColors[index] : this.bgColors[index - this.bgColors.length];
        },

        getTextFill(index) {
            const bgColor = tinycolor(this.getFillColor(index));
            const brightness = bgColor.getBrightness();

            return brightness < 125 ? "rgba(255, 250, 245, 0.95)" : "rgba(0, 0, 150, 0.9)";
        },

        getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min) + min);
        },

        resetWheel() {
           return this.wheelRotation !== undefined ? Math.ceil(this.wheelRotation) + 1 : 1;
        },

        spinWheel() {
            const resetValue = this.resetWheel();

            this.winner = this.getRandomInt(0, this.numOfParts);
            const baseTurns = this.getRandomInt(1, 2);
            const interimTurns = this.getRandomInt(2, 3);
            const winnerOffset = 1 - (this.winner / this.numOfParts);
            const compensation = -0.25 + (((1/this.numOfParts) / 2) / this.getRandomInt(1, 3));
            const turns = baseTurns + winnerOffset + compensation;
            
            // eslint-disable-next-line no-console
            console.log("2", winnerOffset, 1/this.numOfParts);

            this.wheelRotation =  interimTurns + turns + compensation;

            anime({
                targets: '.wheel',
                rotate: [
                    {
                        value: `${resetValue}turn`,
                        duration: 1500,
                        easing: "easeInSine"
                    }, {
                        value: "0turn",
                        duration: 0,
                        easine: "linear"
                    },
                    {
                        value: `${interimTurns}turn`,
                        duration: interimTurns * 1000,
                        easing: "linear"
                    },
                   
                    {
                        value: `+=${turns}turn`,
                        duration: turns * this.getRandomInt(4000, 6000),
                        easing: "cubicBezier(0.150, 0.50, 0.250, 1.000)"
                        // easing: "easeOutSine"
                        // easing: "cubicBezier(0.1, 0.5, 0.1, 1)"
                    }
                ],

                begin: () => {
                    this.isspining = true;
                    this.$emit('spin-begin');
                    // eslint-disable-next-line no-console
                    console.log("b", this);                    
                },

                complete: () => {
                    this.isspining = false;
                    this.$emit('spin-complete', {
                        winner: this.labels[this.winner].title,
                        color: this.getFillColor(this.winner)
                    });
                   // alert(`Winner is ${this.labels[this.winner]}`);
                }
                
            });
        }

  }
}
</script>

<style>

#wheel {
    font-size: 1px;
    position: relative;
}

.wheel-wrapper {
    padding: 15px;
    position: relative;
    overflow: hidden;
}

.wheel {
    width: 55vw;
    height: 55vw;
    max-width: 90vh;
    max-height: 90vh;
    filter: drop-shadow(rgba(0,0,0,0.25) 0 2px 15px);
    will-change: transform;
    transform: translate3d(0,0,0);
}

.wheel-border {
    position: absolute;
    top: 10px;
    right: 10px;
    bottom: 10px;
    left: 10px;
    pointer-events: none;

    /*background: url(../assets/wheel-overlay.svg) 0 0 no-repeat;*/
    background-size: 100% 100%;
}

.wheel-border svg {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.wheel-middle {
    position: absolute;
    top: 10px;
    right: 10px;
    bottom: 10px;
    left: 10px;
    pointer-events: none;

    background: url(../assets/wheel-middle@4x.png) 50% 50% no-repeat;
    background-size: 15% 15%;
}


.top {
    position: absolute;
    top: 10px;
    left: 50%;
    margin-top: 0.25%;
    width: 3.5%;
    height: 3.5%;
    background: url(../assets/top.png) 0 0 no-repeat;
    background-size: 100% auto;
    transform: translate(-50%, 0);
}


@media (orientation: portrait) {

    .wheel {
        width: 55vh;
        height: 55vh;
        max-width: 55vw;
        max-height: 55vw;
    }

}

text {
    font-family: 'Henny Penny', cursive;
    font-size: 0.85vw;
    font-weight: 900;
    letter-spacing: 0.1em;
    /*fill: rgba(2505, 255, 255, 1);*/
    filter: drop-shadow(rgba(0,0,0,1) 0 1px 10px);
}

@media (orientation: portrait) {
    text {
        font-size: 1.25vh;
    }
}


</style>
