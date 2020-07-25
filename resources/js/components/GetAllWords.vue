<template>
    <div class="row m-0">
        <div v-for="word in words" :id="word['word']" class="col-md-3 col-6">
            <button @click="addToSynonyms(word['id'], word['word'], word['language'], word['countary'])" type="button"
                    class="mt-3 btn btn-outline-primary font-weight-bold text-dark roboto shadow-sm">
                <h5 v-text="word['word']"></h5>
                <p class="m-0">
                    <span>lang: {{word['language']}} </span>
                    <span>cntry: {{word['countary']}} </span>
                </p>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                words: [],
                found_synos: []
            }
        },
        created() {
            axios.get('/word/all')
                .then((response)=>{this.words = response.data;})
            Fire.$on('WordCreated', () => {
                axios.get('/word/all')
                    .then((response)=>{this.words = response.data;})
            });
            Fire.$on('returnAll', (words) => {
                words.forEach((word) => {
                    document.getElementById(word['word']).style.opacity = "1"
                })
            });
        },
        methods: {
            addToSynonyms(id, word, language, countary) {
                document.getElementById(word).style.display = "none";
                var synonym = [id, word, language, countary];
                Fire.$emit('addToSynonums', synonym);
                axios.get('/synonyms/' + id + '')
                    .then((response)=>{
                        if(response.data.length > 0) {
                            response.data.forEach((founds) => {
                                this.words.forEach((word) => {
                                    if (word['word'] == founds['word']){
                                        document.getElementById(founds['word']).style.opacity = "0";
                                        var synonym = [founds['id'], founds['word'], founds['language'], founds['countary']];
                                        Fire.$emit('addToSynonums', synonym);
                                    }
                                });
                            });
                        }
                    });
            },

        }
    }

</script>
