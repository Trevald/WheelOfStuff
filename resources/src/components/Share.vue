<template>
    <div class="alert">
        <div class="box">
            <div class="sun" >
                <div class="content">
                    <p class="legend">
                        Your link to 
                    </p>
                    <p class="title">{{title}}</p>
                    <input type="text" readonly v-model="url" class="url" @click.stop="selectAll($event)">
                    <button class="btn-copy" type="button" @click.stop="copy()">Copy to clipboard</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    
    name: "Share",

    props: {
        title: String,
        url: String
    },

    methods: {
        copy() {
            navigator.clipboard.writeText(this.url);
        },

        selectAll(event) {
            event.target.select();
        }
    }
}
</script>

<style scoped>

.alert .box {
    background-color: #2B6927;
    color: #FDFED0;
}

.url {
    display: block;
    margin: 0 0 1.5vw 0;
    padding: 2vh;
    width: 70ch;
    max-width: 100%;
    flex: 1 1 100%;

    font-family: Courier;
    font-size: 1.75vh;
    text-align: center;
    letter-spacing: 0.05em;

    color: rgba(255, 255, 255, 0.9);
    
    background: rgba(0, 0, 0, 0.5);
    border-radius: 10px;

}

.btn-copy {

padding: 1.5vh 2vw;

font-family: Lobster Two;
font-style: normal;
font-weight: normal;
font-size: 2vh;
align-items: center;
text-align: center;
    letter-spacing: 0.1em;

    color: #000000;



    background: linear-gradient(0deg, #E6E9BD, #E6E9BD);
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.35);
    border-radius: 100rem;
    transition: all .3s ease;
}

.btn-copy:active {
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.5);
    transform: translateY(2px);
}

</style>