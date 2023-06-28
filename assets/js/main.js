(function () {
    "use strict";

    /**
       * Sticky Header on Scroll
       */
    const selectHeader = document.querySelector('#header');
    if (selectHeader) {
        let headerOffset = selectHeader.offsetTop;
        let nextElement = selectHeader.nextElementSibling;

        const headerFixed = () => {
            if ((headerOffset - window.scrollY) <= 0) {
                selectHeader.classList.add('sticked');
                if (nextElement) nextElement.classList.add('sticked-header-offset');
            } else {
                selectHeader.classList.remove('sticked');
                if (nextElement) nextElement.classList.remove('sticked-header-offset');
            }
        }
        window.addEventListener('load', headerFixed);
        document.addEventListener('scroll', headerFixed);
    }

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all)
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener))
            } else {
                selectEl.addEventListener(type, listener)
            }
        }
    }

    // Get all elements with class hover-sound
    // var buttons = document.querySelectorAll('.hover-sound');

    var header = document.querySelector('header');

    // Get all anchor elements inside the header
    var buttons = header.querySelectorAll('a');

    // Create a new audio element
    var audio = new Audio('assets/Selection.mp3'); // Update with the correct path to your audio file

    // Variable to track hovering state
    var isHovering = false;

    // Function to play audio
    function playAudio() {
        audio.currentTime = 0;
        audio.play();
    }

    // Function to stop audio
    function stopAudio() {
    }

    /* Main Javascript code made by Valelii Kozhevets */

    // Add event listeners for mouseover and mouseout events
    buttons.forEach(function (button) {
        button.addEventListener('mouseover', function (event) {
            // Check if audio is playing or button is already in hovering state
            if (isHovering || event.target !== button) {
                return;
            }
            isHovering = true;
            playAudio();
        });

        button.addEventListener('mouseout', function (event) {
            // Check if mouseout event is not on a child element of the button
            if (!button.contains(event.relatedTarget)) {
                isHovering = false;
                stopAudio();
            }
        });
    });

    /**
 * Easy on scroll event listener 
 */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)

    }
    document.addEventListener("mousemove", function (event) {
        var creditsDiv = document.querySelector(".credits"); // Get the credits div element
        var parentDiv = creditsDiv.parentNode; // Get the parent element of the credits div
        var screenWidth = window.innerWidth; // Get the width of the screen

        if (screenWidth > 1200) { // Check if the screen width is greater than 1200 pixels
            creditsDiv.style.position = "absolute"; // Set the position of the element to absolute
            creditsDiv.style.left = Math.max(screenWidth * 0.4, Math.min(screenWidth * 0.6 - creditsDiv.offsetWidth, event.clientX - 130)) + "px"; // Set the left position to the current x-coordinate of the mouse pointer minus 50 pixels, but not outside the 10% and 90% of the screen width
            creditsDiv.style.top = parentDiv.offsetTop + 90 + "px"; // Set the top position to the top of the parent element
        }
    });

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
        })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)

    /**
     * Scrolls to an element with header offset
     */
    const scrollto = (el) => {
        let elementPos = select(el).offsetTop
        window.scrollTo({
            top: elementPos,
            behavior: 'smooth'
        })
    }

    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    /**
     * Mobile nav toggle
     */
    on('click', '.mobile-nav-toggle', function (e) {
        select('body').classList.toggle('mobile-nav-active')
        this.classList.toggle('bi-list')
        this.classList.toggle('bi-x')
    })

    /**
 * Scroll with ofset on links with a class name .scrollto
 */
    on('click', '.scrollto', function (e) {
        if (select(this.hash)) {
            e.preventDefault()

            let body = select('body')
            if (body.classList.contains('mobile-nav-active')) {
                body.classList.remove('mobile-nav-active')
                let navbarToggle = select('.mobile-nav-toggle')
                navbarToggle.classList.toggle('bi-list')
                navbarToggle.classList.toggle('bi-x')
            }
            scrollto(this.hash)
        }
    }, true)

    /**
     * Scroll with ofset on page load with hash links in the url
     */
    window.addEventListener('load', () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash)
            }
        }
    });

})()