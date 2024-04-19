const container = document.querySelector("#container");
const textInput = document.querySelector("#textInput");
const button = document.querySelector("#submitButton");

let guesses = 8;

const words = [
    "ginger",
    "mensen",
    "tafels",
    "vaders",
    "tanden",
    "rammen",
    "katten",
    "laders",
    "potjes",
    "laders",
    "koffie"
];

async function logMovies() {
    const response = await fetch("http://customapis.dylanvanderven.fyi/Words.php");
    const movies = await response.json();
    console.log(movies);
}
logMovies()  

const guessWord = words[Math.floor(Math.random() * words.length)];
console.log(guessWord);

button.addEventListener("click", ()=> {
    const word = textInput.value;
    let coloredWord = "";
    textInput.value = "";

    //kijk of het woord 6 letter is
    if (word.length != 6) {
        alert("het woord is niet 6 letters lang");
        return;
    }

    //kijk of je een letter hebt geraden
    for (let i = 0; i < word.length; i++) {
        const letter = word.charAt(i);

        let letterRightPlace = false;
        let wordHasLetter = false;
        
        for (let ii = 0; ii < guessWord.length; ii++) {
            const guessLetter = guessWord.charAt(ii);

            if (guessLetter === letter && i === ii) {
                letterRightPlace = true;
                break;
            }else if (guessLetter === letter) {
                wordHasLetter = true;
                break;
            }      
        }

        if (letterRightPlace) {
            coloredWord += `<span class='green'>${letter}</span>`;
        }else if (wordHasLetter) {
            coloredWord +=`<span class='orange'>${letter}</span>`;
        }else {
            coloredWord +=`<span>${letter}</span>`;
        }
    }

    //laat het op het scherm zien
    const div = document.createElement("div");
    div.innerHTML = coloredWord;
    container.appendChild(div);

    //kijk of je het woord hebt geraden
    if (word === guessWord) {
        alert("je hebt het word geraden");
    }

    guesses--;
    if (guesses <= 0) {
        alert(`je beurten zijn zijn op. het word was ${guessWord}`);
    }
})