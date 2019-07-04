'use strict'
document.addEventListener('DOMContentLoaded', e => {
    let date = new Date()
    const year = date.getFullYear()
    let yearContent = document.querySelector('#year')
    yearContent.innerHTML = year

    // Get the referrer value from the URL
    const referrer = window.location.href.slice(window.location.href.indexOf('?') + 1)

    let formdata = JSON.stringify({ referrer: referrer })

    // initiate a fetch call
    fetch('scripts/display.php', {
        method: 'post',
        body: formdata
    })
        .then(response => {
            return response.json()
        })
        .then(data => {
            console.log(data)
            for (var i = 0; i < data.length; i++) {

                $("#data").append("<tr><td>" + data[i].id + "</td><td>" + data[i].firstName + "</td><td>" + data[i].middleName + "</td><td>" + data[i].lastName + "</td><td>" + data[i].email + "</td><td>" + data[i].phone + "</td><td>" + data[i].city + "</td><td>" + data[i].gender + "</td><td>" + data[i].organisation + "</td><td>" + data[i].dob + "</td><td>" + data[i].sector + "</td><td>" + data[i].organisation + "</td><td>" + data[i].referringChannel + "</td><td>" + data[i].created_at + "</td><td>")
            };
        })
        .catch(error => {
            console.log('The Request Failed', error)
        })
})
