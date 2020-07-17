<template>

    <div class="col-12 mt-3">
        <div class="row g-3 align-items-center mb-2">

            <div class="col-6">
                <select name="syno-lang" class="form-select form-control border border-dark" >
                    <option selected>Language</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

            <div class="col-6">
                <select name="syno-cntry" class="form-select form-control border border-dark" >
                    <option selected>Countary</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

            <div class="col-12 mt-2"> <input type="text" name="syno-word" placeholder="Synonum" class="form-control border border-dark"> </div>
            
        </div>
        <hr>
        <div class="mb-2" v-for="instance in instances">
            <div v-html="instance.html"></div>
        </div>
        <button @click="add" type="button" class="btn btn-primary container font-weight-bold text-dark roboto shadow-sm">
            Add New Synonum
        </button>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                new: '<div class="row g-3 align-items-center mb-2"> <div class="col-6"> <select name="syno-lang" class="form-select form-control border border-dark" > <option selected>Language</option> <option value="1">One</option> <option value="2">Two</option> <option value="3">Three</option> </select> </div><div class="col-6"> <select name="syno-cntry" class="form-select form-control border border-dark" > <option selected>Countary</option> <option value="1">One</option> <option value="2">Two</option> <option value="3">Three</option> </select> </div><div class="col-12 mt-2"> <input type="text" name="syno-word" placeholder="Synonum" class="form-control border border-dark"> </div></div><hr>',
                instances: [
                    { html: this.new }
                ]
            };
        },
        methods: {
            add() {
                this.instances.push({html: this.new})
            }
        },

    }
</script>
