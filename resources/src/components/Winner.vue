<template>
    <div class="winner">
        <div class="box" :style="cssStyle">
            <div class="sun" >
                <div class="content">
                <p class="legend">
                    Winner is
                </p>
                <p class="title">{{title}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

const tinycolor = require("tinycolor2");

export default {
    
    name: "Winner",

    props: {
        winner: Object
    },

    computed: {
        cssStyle() {
            return { backgroundColor: this.color, color: this.getFGColor() }
        },

        title() {
            return this.winner.winner;
        },

        color() {
            return this.winner.color;
        }
    },

    methods: {
        getFGColor() {
            const bgColor = tinycolor(this.color);
            const brightness = bgColor.getBrightness();

            return brightness < 125 ? "rgba(253, 254, 208, 0.9)" : "rgba(0, 0, 150, 0.9)";
        },

    }
}
</script>

<style scoped>

.winner {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 10vh;
    left: 0;

    display: flex;
    justify-content: center;
    align-items: center;
}

.box {
    display: flex;
    width: 60vw;
    height: 50vh;

    box-shadow: 0px 3px 25px rgba(0, 0, 0, 0.75);
    border-radius: 15px;

}

.sun {
    flex: 1 1 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;

    background: url(./../assets/sun.svg) 50% 50% no-repeat;   
    background-size: 150% auto;
}


.legend {
    margin: 0 0 2vh 0;
    font-family: Lobster Two;
    font-size: 2.5vh;
    line-height: 1em; 
    text-align: center;
    letter-spacing: 0.05em;
      
    text-align: center;

text-shadow: 0px 1px 0px rgba(0, 0, 0, 0.25);

    
}

.title {
    margin: 0;
    font-family: Henny Penny;
    font-size: 6vh;
    letter-spacing: 0.05em;
    text-align: center;

text-shadow: 0px 1px 5px rgba(0, 0, 0, 0.5);

    

}

</style>