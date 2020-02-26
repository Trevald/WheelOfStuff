<template>
    <div class="alert">
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


</style>