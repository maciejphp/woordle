import config from './config.js';
const api = config.api;

const container = document.querySelector("#container");
const textInput = document.querySelector("#textInput");
const button = document.querySelector("#submitButton");
let guesses = 7;

let words;
let guessWord;

const alert = document.querySelector(".alert");
function setAlert(display, text) {
    if (!display) {
        alert.style.display = "none";
        return;
    }else {
        alert.style.display = "Block";
    }

    alert.innerText = text;
}

async function getWords() {
    const response = await fetch(api);
    words = await response.json();
    guessWord = words[Math.floor(Math.random() * words.length)][1].toLowerCase();
    console.log(guessWord);
}
getWords();



//connect to da server
const webSocket = new WebSocket('wss://goofy-woordle-game.glitch.me/');
webSocket.onopen = () => {
    webSocket.send("yo");
}

button.addEventListener("click", ()=> {
    //zet
    setAlert(false);

    const word = textInput.value;
    let coloredWord = "";
    textInput.value = "";
    let wordExists = false;

    //check of het woordenlijst ingeladen is
    if (!guessWord) {
        setAlert(true, "het woord is nog niet ingeladen");
        return;
    }

    //kijk of het woord 6 letter is
    if (word.length != 6) {
        setAlert(true, "het woord is niet 6 letters lang");
        return;
    }

    //check of het woord bestaat
    for (let wordInwordList of words) {
        wordInwordList = wordInwordList[1].toLowerCase();
        if (wordInwordList === word.toLowerCase()) {
            wordExists = true;
            break;
        }
    }
    if (!wordExists) {
        setAlert(true, "het woord bestaat in onze woorden lijst");
        return;
    }

    //kijk if je nog beurten over hebt
    guesses--;
    if (guesses <= 0) {
        setTimeout(function() {
            location.reload();
        }, 1000);
        setAlert(true, `je beurten zijn zijn op. het word was ${guessWord}`);
    }

    //kijk of je een letter hebt geraden
    for (let i = 0; i < word.length; i++) {
        const letter = word.charAt(i).toLowerCase();

        let letterRightPlace = false;
        let wordHasLetter = false;
        
        for (let ii = 0; ii < guessWord.length; ii++) {
            const guessLetter = guessWord.charAt(ii);

            if (guessLetter === letter && i === ii) {
            console.log(i,ii)

                letterRightPlace = true;
                break;
            }else if (guessLetter === letter) {
                wordHasLetter = true;
                // break;
            }      
        }

        if (letterRightPlace) {
            coloredWord += `<span class='green'>${letter}</span>`;
        }else if (wordHasLetter) {
            coloredWord +=`<span class='orange'>${letter}</span>`;
        }else {
            coloredWord +=`<span class='letter'>${letter}</span>`;
        }
    }

    //laat het op het scherm zien
    const div = document.createElement("div");
    div.innerHTML = coloredWord;
    container.appendChild(div);

    //kijk of je het woord hebt geraden
    if (word === guessWord) {
        alert("je hebt het word geraden, jippie");
        setTimeout(function() {
            window.location.href= "pages/correctGuess.php";
        }, 1000);
    }
});