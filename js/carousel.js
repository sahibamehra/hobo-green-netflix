document.addEventListener("DOMContentLoaded", function () {

    fetch('carouselData.php')
        .then(response => response.json())
        .then(data => {
            const carouselInner = document.getElementById('myNetflix-carousel-inner');
            data.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'myNetflix-carousel-item';
                const paddedId = String(item.SerieID).padStart(5, '0');
                div.innerHTML = `
                    <a href='./views/serie/view.php?serieID=${item.SerieID}&serieTitel=${item.SerieTitel}&imdbLink=${item.IMDBLink}&paddedId=${paddedId}'>
                    <img src="./images/${paddedId}.jpg" alt="Slide ${index + 1}" onerror="this.onerror=null;this.src='./images/error.png';">
                    </a>
                    <div class="myNetflix-caption">${item.SerieTitel} <br> (${item.GenreNamen})</div>
                `;
                carouselInner.appendChild(div);
            });
            let currentIndex = 0;
            const totalSlides = data.length;
            const visibleItems = 3;
            const totalSets = Math.ceil(totalSlides / visibleItems);
            let autoScrollInterval = setInterval(nextSlide, 3000);

            document.getElementById('myNetflix-next').addEventListener('click', () => {
                nextSlide();
                resetInterval();
            });

            document.getElementById('myNetflix-prev').addEventListener('click', () => {
                prevSlide();
                resetInterval();
            });

            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalSets;
                updateCarousel();
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + totalSets) % totalSets;
                updateCarousel();
            }

            function updateCarousel() {
                carouselInner.style.transform = `translateX(-${currentIndex * 100 / visibleItems}%)`;
            }

            function resetInterval() {
                clearInterval(autoScrollInterval);
                autoScrollInterval = setInterval(nextSlide, 3000);
            }
        });

///////// HISTORY

fetch('carouselData.php?action=history')
.then(response => response.json())
.then(data => {
    const carouselInner = document.getElementById('myNetflix-carousel-inner-history');
    data.forEach((item, index) => {
        const div = document.createElement('div');
        div.className = 'myNetflix-carousel-item';
        const paddedId = String(item.SerieID).padStart(5, '0');
        div.innerHTML = `
            <a href='./views/serie/view.php?serieID=${item.SerieID}&serieTitel=${item.SerieTitel}&imdbLink=${item.IMDBLink}&paddedId=${paddedId}'>
            <img src="./images/${paddedId}.jpg" alt="Slide ${index + 1}" onerror="this.onerror=null;this.src='./images/error.png';">
            </a>
            <div class="myNetflix-caption">${item.SerieTitel} <br> (${item.GenreNamen})</div>
        `;
        carouselInner.appendChild(div);
    });
    let currentIndex = 0;
    const totalSlides = data.length;
    const visibleItems = 3;
    const totalSets = Math.ceil(totalSlides / visibleItems);
    let autoScrollInterval = setInterval(nextSlide, 3000);

    document.getElementById('myNetflix-next-history').addEventListener('click', () => {
        nextSlide();
        resetInterval();
    });

    document.getElementById('myNetflix-prev-history').addEventListener('click', () => {
        prevSlide();
        resetInterval();
    });

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSets;
        updateCarousel();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSets) % totalSets;
        updateCarousel();
    }

    function updateCarousel() {
        carouselInner.style.transform = `translateX(-${currentIndex * 100 / visibleItems}%)`;
    }

    function resetInterval() {
        clearInterval(autoScrollInterval);
        autoScrollInterval = setInterval(nextSlide, 3000);
    }
});

///////// editor

fetch('carouselData.php?action=editor')
.then(response => response.json())
.then(data => {
    const carouselInner = document.getElementById('myNetflix-carousel-inner-editor');
    data.forEach((item, index) => {
        const div = document.createElement('div');
        div.className = 'myNetflix-carousel-item';
        const paddedId = String(item.SerieID).padStart(5, '0');
        div.innerHTML = `
            <a href='./views/serie/view.php?serieID=${item.SerieID}&serieTitel=${item.SerieTitel}&imdbLink=${item.IMDBLink}&paddedId=${paddedId}'>
            <img src="./images/${paddedId}.jpg" alt="Slide ${index + 1}" onerror="this.onerror=null;this.src='./images/error.png';">
            </a>
            <div class="myNetflix-caption">${item.SerieTitel} <br> (${item.GenreNamen})</div>
        `;
        carouselInner.appendChild(div);
    });
    let currentIndex = 0;
    const totalSlides = data.length;
    const visibleItems = 3;
    const totalSets = Math.ceil(totalSlides / visibleItems);
    let autoScrollInterval = setInterval(nextSlide, 3000);

    document.getElementById('myNetflix-next-editor').addEventListener('click', () => {
        nextSlide();
        resetInterval();
    });

    document.getElementById('myNetflix-prev-editor').addEventListener('click', () => {
        prevSlide();
        resetInterval();
    });

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSets;
        updateCarousel();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSets) % totalSets;
        updateCarousel();
    }

    function updateCarousel() {
        carouselInner.style.transform = `translateX(-${currentIndex * 100 / visibleItems}%)`;
    }

    function resetInterval() {
        clearInterval(autoScrollInterval);
        autoScrollInterval = setInterval(nextSlide, 3000);
    }
});


///////// trending

fetch('carouselData.php?action=trending')
.then(response => response.json())
.then(data => {
    const carouselInner = document.getElementById('myNetflix-carousel-inner-trending');
    data.forEach((item, index) => {
        const div = document.createElement('div');
        div.className = 'myNetflix-carousel-item';
        const paddedId = String(item.SerieID).padStart(5, '0');
        div.innerHTML = `
            <a href='./views/serie/view.php?serieID=${item.SerieID}&serieTitel=${item.SerieTitel}&imdbLink=${item.IMDBLink}&paddedId=${paddedId}'>
            <img src="./images/${paddedId}.jpg" alt="Slide ${index + 1}" onerror="this.onerror=null;this.src='./images/error.png';">
            </a>
            <div class="myNetflix-caption">${item.SerieTitel} <br> (${item.GenreNamen})</div>
        `;
        carouselInner.appendChild(div);
    });
    let currentIndex = 0;
    const totalSlides = data.length;
    const visibleItems = 3;
    const totalSets = Math.ceil(totalSlides / visibleItems);
    let autoScrollInterval = setInterval(nextSlide, 3000);

    document.getElementById('myNetflix-next-trending').addEventListener('click', () => {
        nextSlide();
        resetInterval();
    });

    document.getElementById('myNetflix-prev-trending').addEventListener('click', () => {
        prevSlide();
        resetInterval();
    });

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSets;
        updateCarousel();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSets) % totalSets;
        updateCarousel();
    }

    function updateCarousel() {
        carouselInner.style.transform = `translateX(-${currentIndex * 100 / visibleItems}%)`;
    }

    function resetInterval() {
        clearInterval(autoScrollInterval);
        autoScrollInterval = setInterval(nextSlide, 3000);
    }
});




});