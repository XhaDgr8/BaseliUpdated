<template>
    <div class="container bg-secondary rounded-lg py-3 mt-3">
        <h4 class="roboto">Make Them All Related as synonyms of each others</h4>
        <div class="col-12">
            <p class="alert alert-warning">! Remember definitions of all the synonyms will become same automatically</p>
        </div>
        <div style="max-height: 13rem;overflow-y: scroll" class="col-12">
            <p v-for="logs in word_logs" class="alert alert-info">{{logs}}</p>
        </div>
        <div class="w-100" style="max-height: 13rem;overflow-y: scroll">
            <div v-if="words != ''" class="row m-0 w-100">
                <div v-for="synonym in words" class="col-md-3 col-6">
                    <button type="button"
                            class="mt-3 btn btn-outline-primary font-weight-bold text-dark roboto shadow-sm">
                        <h5 v-text="synonym['word']"></h5>
                        <p class="m-0">
                            <span>lang: {{synonym['language']}} </span>
                            <span>cntry: {{synonym['countary']}} </span>
                        </p>
                    </button>
                </div>
                <div class="container mt-3 mb-5">
                    <button @click="makeRelation" class="btn btn-primary container font-weight-bold
              text-dark success roboto shadow">Make Them All Synonyms of each Other</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                words: [],
                word_ids: [],
                word_logs: []
            }
        },
        created() {
            Fire.$on('addToSynonums', (synonyms) => {
                this.words.push({
                    'id' : synonyms[0],
                    'word' : synonyms[1],
                    'language' : synonyms[2],
                    'countary' : synonyms[3],
                })
            });
        },
        methods: {
            makeRelation() {
                this.words.forEach((word) => {
                    this.word_ids.push(word['id'])
                })
                axios.post('/makeRelation/', this.word_ids)
                    .then((response) => {
                        this.word_logs = response.data;
                        this.words = [];
                    })
                Fire.$emit('returnAll', this.words);
            }
        },
    }
</script>
