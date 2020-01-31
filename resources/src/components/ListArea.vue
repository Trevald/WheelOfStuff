<template>
    <textarea v-model="listAsText" @input="inputChange" autocomplete="off" placeholder="Add some things..."></textarea>
</template>

<script>

export default {

    name: "ListArea",

    model: {
        prop: "value",
        event: "input"
    },

    props: {
        items: Array
    },

    data() {
        return {
            listAsText: undefined
        }
    },

    methods: {
        inputChange() {
            this.$emit('change', this.listAsText.split("\n").map(i => { return {title: i }}));
        }
    },

    mounted() {
        // eslint-disable-next-line no-console
        console.log('la', this.items);        
        this.listAsText = this.items !== undefined ? this.items.map(i => { return i.title }).join("\n") : "";
    }

}


</script>

<style scoped>

textarea {
    appearance: none;
    margin: 0;
    padding: 1rem;
    display: flex;
    flex: 1 1 auto;
    width: 100%;
    background: transparent;
    box-shadow: none;    
    border: none;

    font-family: Henny Penny;
    font-size: 2.5vh;
    line-height: 2.5;
    letter-spacing: 0.05em;
    color: rgba(253, 254, 208, 0.9);
    resize: none;
}

@media (orientation: portrait) {

    textarea {
        font-size: 2.5vw;
    }
}

textarea:focus {
    outline: none;
}

</style>