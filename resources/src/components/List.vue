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



</style>