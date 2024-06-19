import config from '../../config.js'; //import api config
const api = config.api;

//create function to fetch the words from the api
async function fetchWords() {
    try{
        const response = await fetch(api);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Failed to fetch words:'. error);
        return null;
    }
}

//create function to process that data
function processData(data) {
    if (!data) {
        return;
    }
    const container = document.getElementById('words');

    const ol = document.createElement('ol');

    Object.keys(data).forEach(key => {
        const li = document.createElement('li');
        li.textContent = `${data[key][1]}`;
        ol.appendChild(li);
    })
    container.appendChild(ol);
}

fetchWords().then(processData)