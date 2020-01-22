<template>
  <div id="wheel">
      <div class="wheel-wrapper">
        <svg viewBox="0 0 500 500" class="wheel" ref="wheel">
            <g v-for="(label, index) in labels" :key="index" :transform="getPathTransform(index)">
                <path :d="getSVGData()" :fill="getFillColor(index)"  />
                <text x="460" y="250" :fill="getTextFill(index)" text-anchor="end" :transform="getTextTransform(index)">{{label}}</text>
            </g>
        </svg>
      </div>
    <div  style="position: fixed; top: 10px; left: 10px;">
        <button type="button" @click="spinWheel($event)">Spinn</button>
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

  data() {
      return {
          winner: undefined,
          wheelRotation: undefined,
          origLabels: [
              "Apple",
              "Banana",
              "Blueberry",
              "Lemon",
              "Orange",
              "Pear",
              "Pineapple",
              "Raspberry",
              "Strawberry"
          ],
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

        labels() {
            // return this.origLabels;
            return this.origLabels.length < 2 ? this.origLabels.concat(this.origLabels) : this.origLabels;
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
            const baseTurns = this.getRandomInt(2, 3);
            const interimTurns = this.getRandomInt(3, 4);
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

                complete: () => {
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
}

.wheel-wrapper {
    overflow: hidden;
    padding: 15px;
}

.wheel {
    width: 85vh;
    height: 85vh;
    filter: drop-shadow(rgba(0,0,0,0.25) 0 2px 15px);
    will-change: transform;
}

@media (orientation: portrait) {
    .wheel {
        width: 85vw;
        height: 85vw;
    }
}

text {
    font-family: "Helvetica Neue";
    font-size: 1vh;
    font-weight: 900;
    letter-spacing: 0.05em;
    /*fill: rgba(2505, 255, 255, 1);*/
    filter: drop-shadow(rgba(0,0,0,1) 0 1px 10px);
}

@media (orientation: portrait) {
    text {
        font-size: 2vw;
    }
}

</style>
