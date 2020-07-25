<template>
    <div>
        <div v-bind:class="{ 'd-none': readyToLoad }">
            <button type="button" class="btn btn-primary shadow-sm btn-block text-white"
                    v-on:click="printIt">Load Data</button>
        </div>
        <div v-bind:class="{ 'd-none': !readyToLoad }">
            <button v-on:click="pusher()" type="button"
                    class="btn btn-primary shadow-sm btn-block text-white">Ready For Upload</button>
        </div>
        <div class="row mt-4 bg-info">
            <div v-for="(word, index) in words" class="col-6">
                <h3 class="text-primary">{{words['word']}}</h3>
                <hr>
                <p>Lang: {{word['language']}}</p>
                <p>Lang: {{word['countary']}}</p>
                <p>Lang: {{word['defination']}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                pa : 'Make Data Ready to Print',
                readyToLoad : false,
                words: [],
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            pusher () {
                printJS ({
                    printable: this.words,
                    type: 'json',
                    properties: ['word', 'language', 'countary', 'defination'],
                    header: '<h3>My custom header</h3>',
                    style: '.custom-h3 { color: red; }'
                })
            },
            printIt () {
                axios.get('/word/export')
                .then((response)=>{
                    console.log(response.data)
                    this.words = response.data[0];
                });
                this.readyToLoad = 'a';
            },
        }
    }
</script>


