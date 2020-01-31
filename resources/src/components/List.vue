<template>
    <div class="list">
        <div class="list-wrapper">
            <p class="list-legend">Wheel of</p>
            <div class="list-content">
                <input class="list-title"  type="text" value="Fruits">
                <!--
                <ul>
                    <li v-for="(item, index) in items" :key="index">
                        <input type="text" placeholder="New item" v-model="item.title" @input="shouldAddNew(index)" :key="index" @keyup.8="shouldDelete(index)">
                    </li>
                </ul>    
                -->
                <ListArea :items="items" @change="itemsChange"></ListArea>
            </div>
        </div>
    </div>
</template>

<script>

import ListArea from "./ListArea";

export default {

    name: "List",

    props: {
        items: Array,
    },

    components: {
        ListArea
    },

    computed: {
        /*
        localItems() {
            let items = this.items;
                items.push({title: ""});
            return items;
        }
        */
    },

    methods: {

        itemsChange(items) {
                    // eslint-disable-next-line no-console
        console.log('ic', items);   
            this.$emit("change", items);
        },
        
        shouldAddNew(index) {
            if (index === this.items.length-1 && this.items[index].title !== "") {
                this.items.push({title: ""});
            }
        },

        shouldDelete(index) {
            if (this.items[index].title === "" && this.items.length > 3) {
                this.items.splice(index, 1);
            }
        }
    }


}

</script>

<style scoped>

.list {
    padding: 3vh 0 0 0;
    flex: 1 1 auto;
    display: flex;
    align-items: stretch;
    justify-content: stretch;
}

@media (orientation: portrait) {

    .list {
        padding: 3vw 0 0 0;
    }
}

.list-wrapper {
    position: relative;
    flex: 1 1 auto;
    display: flex;
    padding: 10px;
    background: linear-gradient(180deg, #A3A3B0 0%, #9696AF 10.28%, #504F66 22.18%, #646381 33.55%, #68677E 53.03%, #80809A 66.01%, #474851 81.16%, #393A40 93.07%, #202127 103.89%);
    box-shadow: inset 0px 1px 2px rgba(255, 255, 255, 0.25), inset 0px -2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
}

.list-legend {
    position: absolute;
    top: 0.5vh;
    left: 50%;
    transform: translate(-50%, -50%);
    margin: 0;
    padding: 1vh 2vh; 

    font-family: Lobster Two;
    font-size: 2vh;
    line-height: 1em; 
    text-align: center;
    letter-spacing: 0.05em;
    color: rgba(253, 254, 208, 0.9);

    background: linear-gradient(180deg, #68B954 0%, #418D36 47.92%, #1F551E 100%);
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.35), inset 0px 1px 1px rgba(255, 255, 255, 0.15);
    border-radius: 5px;
}

@media (orientation: portrait) {

    .list-legend {
        font-size: 2vw;
    }
}

.list-content {
    flex: 1 1 auto;
    display: flex;    
    flex-direction: column;
    padding-top: 4vh;

    background: linear-gradient(180deg, #183616 0%, #2A4334 56.57%, #18221B 100%);
    box-shadow: inset 0px -2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 3px;
}

input[type="text"] {
    appearance: none;
    margin: 0;
    padding: 0;
    display: block;
    width: 100%;
    background: transparent;
    box-shadow: none;    
    border: none;

    font-family: Henny Penny;
    letter-spacing: 0.05em;
    color: rgba(253, 254, 208, 0.9);
}

input[type="text"]::placeholder {
    color: white;
}

input[type="text"]:focus {
    outline: none;
}

.list-title {
    font-size: 4vh;
    text-align: center;
    text-shadow: 2px 2px 1px rgba(0, 0, 0, 0.75);
}

@media (orientation: portrait) {

    .list-title {
        font-size: 4vw;
    }
}

</style>