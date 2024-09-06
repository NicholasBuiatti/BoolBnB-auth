//controllo peso file prima di inviare
document.getElementById('image').addEventListener('change', function() {
    let file = this.files[0];
    if (file.size > 5 * 1024 * 1024) {
        document.getElementById('fileSizeError').style.display = 'block';
        // disabilito l'invio del form se il file è troppo grande
        document.getElementById('apartmentForm').onsubmit = function(event) {
            event.preventDefault();
        }
    } else {
        document.getElementById('fileSizeError').style.display = 'none';
        // permetto l'invio del form se il file rispetta le dimensioni
        document.getElementById('apartmentForm').onsubmit = function(event) {
            return true;
        };
    }

});
//---------------------

//chiamata API per reperire l'indirizzo 
let apiAnswer = [];
const apiKey = "RUfkTtEK0CYbHBG3YE2RSEslSRGAWZcu";
const limit = 5;
let indirizzo = document.getElementById('input_indirizzo');
let selectedAddress = '';
indirizzo.addEventListener('input', function() {
    if (indirizzo.value.length > 5) {
        let addressInput = indirizzo.value;
        const url_tomtom =
            `https://api.tomtom.com/search/2/search/${encodeURIComponent(addressInput)}.json?key=${apiKey}&typeahead=true&limit=${limit}&countrySet={IT}`;
        axios.get(url_tomtom)
            .then(function(response) {

                apiAnswer = response.data;

                console.log(apiAnswer);

                let lista = document.getElementById('opzioni');
                lista.innerHTML = '';

                for (let i = 0; i < apiAnswer.results.length; i++) {
                    let indirizzoCompleto = apiAnswer.results[i].address.freeformAddress;
                    let newOption = document.createElement("li");
                    newOption.innerHTML = indirizzoCompleto;

                    newOption.addEventListener('click', function() {
                        indirizzo.value = indirizzoCompleto;
                        selectedAddress = indirizzoCompleto;
                        apiAnswer = [];
                        lista.innerHTML = '';

                        console.log("Indirizzo selezionato:", selectedAddress);
                    });

                    lista.append(newOption);
                }
                indirizzo.addEventListener('focusout',function(){
                    setTimeout(()=>{
                        lista.innerHTML="";

                    },500);
                });

            });
    }
})


document.getElementById('btnSend').addEventListener('click', function() {
    if (selectedAddress == indirizzo.value) {
        console.log("l'indirizzo è uguale")
        document.getElementById('addressError').style.display = 'none';
        document.getElementById('apartmentForm').onsubmit = function(event) {
            return true;
        };
    } else {
        console.log("l'indirizzo NON è uguale")
        document.getElementById('apartmentForm').onsubmit = function(event) {
            event.preventDefault();
        }
        document.getElementById('addressError').style.display = 'block';
    }
});

