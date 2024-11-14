fetch('data/ad.json')
    .then(response => response.json())
    .then(data => {
        const adContainer = document.getElementById('ad-container');
        adContainer.innerHTML = data[0].content;
    });
