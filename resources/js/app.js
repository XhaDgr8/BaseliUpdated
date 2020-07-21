/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {
    
    var languages = ["Abkhazian", "Afar", "Afrikaans", "Akan", "Albanian", "Amharic", "Arabic", "Aragonese", "Armenian", "Assamese", "Avaric", "Avestan", "Aymara", "Azerbaijani", "Bambara", "Bashkir", "Basque", "Belarusian", "Bengali", "Bihari languages", "Bislama", "Bosnian", "Breton", "Bulgarian", "Burmese", "Catalan, Valencian", "Central Khmer", "Chamorro", "Chechen", "Chichewa, Chewa, Nyanja", "Chinese", "Church Slavonic, Old Bulgarian, Old Church Slavonic", "Chuvash", "Cornish", "Corsican", "Cree", "Croatian", "Czech", "Danish", "Divehi, Dhivehi, Maldivian", "Dutch, Flemish", "Dzongkha", "English", "Esperanto", "Estonian", "Ewe", "Faroese", "Fijian", "Finnish", "French", "Fulah", "Gaelic, Scottish Gaelic", "Galician", "Ganda", "Georgian", "German", "Gikuyu, Kikuyu", "Greek (Modern)", "Greenlandic, Kalaallisut", "Guarani", "Gujarati", "Haitian, Haitian Creole", "Hausa", "Hebrew", "Herero", "Hindi", "Hiri Motu", "Hungarian", "Icelandic", "Ido", "Igbo", "Indonesian", "Interlingua (International Auxiliary Language Association)", "Interlingue", "Inuktitut", "Inupiaq", "Irish", "Italian", "Japanese", "Javanese", "Kannada", "Kanuri", "Kashmiri", "Kazakh", "Kinyarwanda", "Komi", "Kongo", "Korean", "Kwanyama, Kuanyama", "Kurdish", "Kyrgyz", "Lao", "Latin", "Latvian", "Letzeburgesch, Luxembourgish", "Limburgish, Limburgan, Limburger", "Lingala", "Lithuanian", "Luba-Katanga", "Macedonian", "Malagasy", "Malay", "Malayalam", "Maltese", "Manx", "Maori", "Marathi", "Marshallese", "Moldovan, Moldavian, Romanian", "Mongolian", "Nauru", "Navajo, Navaho", "Northern Ndebele", "Ndonga", "Nepali", "Northern Sami", "Norwegian", "Norwegian Bokmål", "Norwegian Nynorsk", "Nuosu, Sichuan Yi", "Occitan (post 1500)", "Ojibwa", "Oriya", "Oromo", "Ossetian, Ossetic", "Pali", "Panjabi, Punjabi", "Pashto, Pushto", "Persian", "Polish", "Portuguese", "Quechua", "Romansh", "Rundi", "Russian", "Samoan", "Sango", "Sanskrit", "Sardinian", "Serbian", "Shona", "Sindhi", "Sinhala, Sinhalese", "Slovak", "Slovenian", "Somali", "Sotho, Southern", "South Ndebele", "Spanish, Castilian", "Sundanese", "Swahili", "Swati", "Swedish", "Tagalog", "Tahitian", "Tajik", "Tamil", "Tatar", "Telugu", "Thai", "Tibetan", "Tigrinya", "Tonga (Tonga Islands)", "Tsonga", "Tswana", "Turkish", "Turkmen", "Twi", "Uighur, Uyghur", "Ukrainian", "Urdu", "Uzbek", "Venda", "Vietnamese", "Volap_k", "Walloon", "Welsh", "Western Frisian", "Wolof", "Xhosa", "Yiddish", "Yoruba", "Zhuang, Chuang", "Zulu"];
    var countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua &amp; Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia &amp; Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Cape Verde", "Cayman Islands", "Chad", "Chile", "China", "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cruise Ship", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kuwait", "Kyrgyz Republic", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Mauritania", "Mauritius", "Mexico", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Namibia", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre &amp; Miquelon", "Samoa", "San Marino", "Satellite", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "South Africa", "South Korea", "Spain", "Sri Lanka", "St Kitts &amp; Nevis", "St Lucia", "St Vincent", "St. Lucia", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor L'Este", "Togo", "Tonga", "Trinidad &amp; Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks &amp; Caicos", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "Uruguay", "Uzbekistan", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen", "Zambia", "Zimbabwe"];

    function appendToSelect( name, array ) {

        var option = '';
        for (var i=0;i<array.length;i++){
            option += '<option value="'+ array[i] + '">' + array[i] + '</option>';
        }
        $(name).append(option);
    }

    appendToSelect('.countries', countries);
    appendToSelect('.languages', languages);

    var inc = 0;

    $('.asSyn').click(function () {
        
        $word = $(this).attr('data-word');
        $lang = $(this).attr('data-language');
        $cntry = $(this).attr('data-countary');

        inc = inc + 1;
        var ell = 'syn-lang-' + inc;
        var elc = 'syn-cntry-' + inc;
        var elw = 'syn-word-' + inc;
        $feilds = `
        <div class="row g-3 align-items-center mb-2">

            <div class="col-6">
                <select required name='` + ell + `' class="form-select ` + ell + ` form-control border border-dark">
                    <option selected value='` + $lang + `'>` + $lang + `</option>
                </select>
            </div>

            <div class="col-6">
                <select required name='` + elc + `' class="form-select ` + elc + ` form-control border border-dark">
                    <option selected value='` + $cntry + `'>` + $cntry + `</option>
                </select>
            </div>

            <div class="col-12 mt-2">
                <input required name='` + elw + `' value='` + $word + `' class="form-select ` + elw + ` form-control border border-dark">
            </div>
        </div>
        <hr>
        `;
        $("#append").append($feilds);
        appendToSelect("." + elc, countries);
        appendToSelect("." + ell, countries);
    });

    $('#appender').click(function () {
        
        inc = inc + 1;
        var ell = 'syn-lang-' + inc;
        var elc = 'syn-cntry-' + inc;
        var elw = 'syn-word-' + inc;
        $feilds = `
        <div class="row g-3 align-items-center mb-2">

            <div class="col-6">
                <select required name='` + ell + `' class="form-select ` + ell + ` form-control border border-dark">
                
                </select>
            </div>

            <div class="col-6">
                <select required name='` + elc + `' class="form-select ` + elc + ` form-control border border-dark">
                    
                </select>
            </div>

            <div class="col-12 mt-2">
                <input required type="text" name="` + elw + `" placeholder="Synonum ` + inc + `"
                    class="form-control border border-dark">
            </div>
        </div>
        <hr>
        `;
        $("#append").append($feilds);
        appendToSelect("." + elc, countries);
        appendToSelect("." + ell, countries);
    });

})


