<template>
    <div class="container">
        <div class="row mb-2" v-for="(main, index) in wordmain">
            <div v-if="index != 0" class="col-md-6">
                    <label :for="index+'_word'" class="label label-primary p-0"> Word </label>
                    <input type="text" :id="index+'_word'"
                           :name="index+'_word'" required
                           class="form-control border border-dark rounded-pill">
            </div>
            <div v-if="index != 0" class="col-md-3">
                <label :for="index+'_language'" class="label label-primary p-0"> Language </label>
                <select :name="index+'_language'" :id="index+'_language'"
                        class="form-select languages form-control border border-dark rounded-pill">
                    <option v-for="language in languages" v-text="language" v-bind:value="language"></option>
                </select>
            </div>
            <div v-if="index != 0" class="col-md-3">
                <label :for="index+'_countary'" class="label label-primary p-0"> Country </label>
                <select :name="index+'_countary'" :id="index+'_countary'"
                        class="form-select countries form-control border border-dark rounded-pill">
                    <option v-for="countary in countries" v-text="countary" v-bind:value="countary"></option>
                </select>
            </div>
        </div>
        <div class="row m-0 mt-3 mb-5">
            <button v-on:click="appendNewWord" type="button" class="btn btn-primary rounded-circle font-weight-bold text-dark success roboto shadow-sm"> + </button>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                languages : ["N/A","Abkhazian", "Afar", "Afrikaans", "Akan", "Albanian", "Amharic", "Arabic", "Aragonese", "Armenian", "Assamese", "Avaric", "Avestan", "Aymara", "Azerbaijani", "Bambara", "Bashkir", "Basque", "Belarusian", "Bengali", "Bihari languages", "Bislama", "Bosnian", "Breton", "Bulgarian", "Burmese", "Catalan, Valencian", "Central Khmer", "Chamorro", "Chechen", "Chichewa, Chewa, Nyanja", "Chinese", "Church Slavonic, Old Bulgarian, Old Church Slavonic", "Chuvash", "Cornish", "Corsican", "Cree", "Croatian", "Czech", "Danish", "Divehi, Dhivehi, Maldivian", "Dutch, Flemish", "Dzongkha", "Ingl", "Esperanto", "Estonian", "Ewe", "Faroese", "Fijian", "Finnish", "French", "Fulah", "Gaelic, Scottish Gaelic", "Galician", "Ganda", "Georgian", "German", "Gikuyu, Kikuyu", "Greek (Modern)", "Greenlandic, Kalaallisut", "Guarani", "Gujarati", "Haitian, Haitian Creole", "Hausa", "Hebrew", "Herero", "Hindi", "Hiri Motu", "Hungarian", "Icelandic", "Ido", "Igbo", "Indonesian", "Interlingua (International Auxiliary Language Association)", "Interlingue", "Inuktitut", "Inupiaq", "Irish", "Italian", "Japanese", "Javanese", "Kannada", "Kanuri", "Kashmiri", "Kazakh", "Kinyarwanda", "Komi", "Kongo", "Korean", "Kwanyama, Kuanyama", "Kurdish", "Kyrgyz", "Lao", "Lat.", "Latvian", "Letzeburgesch, Luxembourgish", "Limburgish, Limburgan, Limburger", "Lingala", "Lithuanian", "Luba-Katanga", "Macedonian", "Malagasy", "Malay", "Malayalam", "Maltese", "Manx", "Maori", "Marathi", "Marshallese", "Moldovan, Moldavian, Romanian", "Mongolian", "Nauru", "Navajo, Navaho", "Northern Ndebele", "Ndonga", "Nepali", "Northern Sami", "Norwegian", "Norwegian Bokmål", "Norwegian Nynorsk", "Nuosu, Sichuan Yi", "Occitan (post 1500)", "Ojibwa", "Oriya", "Oromo", "Ossetian, Ossetic", "Pali", "Panjabi, Punjabi", "Pashto, Pushto", "Persian", "Polish", "Portuguese", "Quechua", "Romansh", "Rundi", "Russian", "Samoan", "Sango", "Sanskrit", "Sardinian", "Serbian", "Shona", "Sindhi", "Sinhala, Sinhalese", "Slovak", "Slovenian", "Somali", "Sotho, Southern", "South Ndebele", "Spanish, Castilian", "Sundanese", "Swahili", "Swati", "Swedish", "Tagalog", "Tahitian", "Tajik", "Tamil", "Tatar", "Telugu", "Thai", "Tibetan", "Tigrinya", "Tonga (Tonga Islands)", "Tsonga", "Tswana", "Turkish", "Turkmen", "Twi", "Uighur, Uyghur", "Ukrainian", "Urdu", "Uzbek", "Venda", "Vietnamese", "Volap_k", "Walloon", "Welsh", "Western Frisian", "Wolof", "Xhosa", "Yiddish", "Yoruba", "Zhuang, Chuang", "Zulu"],
                countries : ["N/A","A. Centr","Amaz","Arg","Bol","Bra","C. Rica","Carib","Chl","Col","Cub","Ecu","Esp","Guat","Hon","Mex","Nic","P. Rico","Pan","Par","Per","R.","Salv","Suram","Uru","Ven"],
                appendable: [{
                    word: '',
                    lang: '',
                    cntry: '',
                }],
                wordmain: [],
            }
        },
        created() {
            this.wordmain[0] = this.appendable[0]
        },
        methods: {
            appendNewWord() {
                this.wordmain.push(this.appendable[0])
            },
        }
    }
</script>
