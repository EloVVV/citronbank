const parentSlider = document.querySelector('.main-slider');

const nextButton = parentSlider.querySelector('.button-next-slide');
const prevButton = parentSlider.querySelector('.button-prev-slide');

const nextArrow = parentSlider.querySelector('.button-next-slide .arrow-icon');
const prevArrow = parentSlider.querySelector('.button-prev-slide .arrow-icon');

const wrapper = parentSlider.querySelector('.slider-wrapper');
const slide = parentSlider.querySelectorAll('.slide-box');

const parentScroll = parentSlider.querySelector('.slider_scroll');
const scroll = document.getElementById('scroll');



const slidesArr = Array.from(slide);


// const dotEl = slider.querySelector('.dots');

const size = slide.length;

// for (let i = 1; i <= size; i++) {
//     dotEl.insertAdjacentHTML(`beforeend`, `
//         <div class="dot ${i === 1 ? "active" : ""}"></div>
//     `);
// }



let currentSlide = 0;
slide[currentSlide].classList.add('active');
prevArrow.classList.add('disable');

const scrollWidth = parentScroll.offsetWidth / slide.length;

let scrollPosition = 0;

scroll.style.width = scrollWidth+'px';
scroll.style.left = scrollPosition;

nextButton.addEventListener('click', () => {
    if(currentSlide === size - 2) {
        nextArrow.classList.toggle('disable');
    }
    if(currentSlide === size - 1) {
        
        return false;
    } 
    prevArrow.classList.remove('disable');

    currentSlide++;
    slide.forEach((slide) => {
        slide.classList.remove('active');
        // nextArrow.classList.remove('disable');
    });

    slide[currentSlide].classList.add('active');
    scrollPosition += scrollWidth;

    scroll.style.left = scrollPosition + 'px';
});

prevButton.addEventListener('click', () => {
    if(currentSlide === 1) prevArrow.classList.add('disable');
    if(currentSlide === 0) {
        
        return false;
    } 
    nextArrow.classList.remove('disable');
    
    currentSlide--;
    slide.forEach((slide) => {
        slide.classList.remove('active');
        // prevArrow.classList.remove('disable');
    });

    slide[currentSlide].classList.add('active');
    scrollPosition -= scrollWidth;

    scroll.style.left = scrollPosition + 'px';
});





// nextButton.onclick = () => {
//     slide.forEach((item,index) => {
//         slide[index].classList.remove('active');
//         index = index + 1;
//         slide[index].classList.toggle('active');
//     })
// }


// slidesArr.forEach((item, index) => {

//     nextButton.onclick = () => {
//         nextSlide(index++);
//     }

//     prevButton.onclick = () => {
//         prevSlide(index--);
//     }
    
// })

function nextSlide(index) {
    slide[currentSlide].classList.remove('active');
    currentSlide = index + 1;
    slide[currentSlide].classList.toggle('active');
}
function prevSlide(index) {
    slide[currentSlide].classList.remove('active');
    currentSlide = index;
    slide[currentSlide].classList.toggle('active');
}
