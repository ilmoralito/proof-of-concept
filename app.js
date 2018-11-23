const form = document.querySelector('#form');

form.addEventListener('submit', handleSubmit);

function handleSubmit(event) {
    event.preventDefault();

    const startDate = this.querySelector('#startDate').value;
    const endDate = this.querySelector('#endDate').value;
    const queryString = getQueryString(startDate, endDate);

    fetch(`https://demozilla.herokuapp.com/app.php?${queryString}`)
        .then(response => response.json())
        .then(json => render(json));
}

function getQueryString(startDate, endDate) {
    return `startDate=${startDate}&endDate=${endDate}`;
}

function render(dataset) {
    const rows = getRows(dataset);

    const table = `
        <table>
            <thead>
                <tr>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Tiempo</th>
                    <th>Distancia</th>
                </tr>
            </thead>

            <tbody>
                ${rows}
            </tbody>
        </table>`;

    document.querySelector('#data').innerHTML = table;
}

function getRows(dataset) {
    return dataset.map(dataToRow).join('');
}

function dataToRow(data) {
    return `
        <tr>
            <td>${data.startDate}</td>
            <td>${data.endDate}</td>
            <td>${data.time}</td>
            <td>${data.distance}</td>
        </tr>`;
}
