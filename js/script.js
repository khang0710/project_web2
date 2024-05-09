document.addEventListener("DOMContentLoaded", function () {
    var toggleSearch = document.getElementById('toggleSearch');
    var searchContainer = document.getElementById('searchContainer');

    toggleSearch.addEventListener('click', function () {
        if (searchContainer.style.display === 'block') {
            searchContainer.style.display = 'none';
        } else {
            searchContainer.style.display = 'block';
        }
    });
    searchButtonClose.addEventListener('click', function () {
        if (searchContainer.style.display === 'block') {
            searchContainer.style.display = 'none';
        }
    });
});

//--------------------------------------------------
const listItem = document.querySelector('.listitem')
const imgs = document.getElementsByClassName('item')
const nextBtn = document.getElementById('next-btn')
const returnBtn= document.getElementById('return-btn')
let len = imgs.length/4
let current = 0


const changeSlide = () => {
    if (current == len-1) {
        current = 0
        listItem.style.transform = `translateX(0px)`;
    } else {
        current++
        listItem.style.transform = `translateX(${1080 * -1 * current}px)`;
    }
}


nextBtn.addEventListener('click',() => {
    changeSlide()
});
returnBtn.addEventListener('click',() =>{
    if (current == 0) {
        current =len-1
        listItem.style.transform = `translateX(${1080 * -1 * current}px)`;
    } else {
        current--
        listItem.style.transform = `translateX(${1080 * -1 * current}px)`;
    }
});
