window.addEventListener("load", () => {
    const loader = document.getElementById("loader");
    loader.style.opacity = "0";
    setTimeout(() => {
        loader.style.display = "none";
    }, 500);
});

window.addEventListener("scroll", () => {
    const nav = document.getElementById("mainNav");
    if (window.scrollY > 50) {
        nav.classList.add("scrolled");
    } else {
        nav.classList.remove("scrolled");
    }
});

// Tab Filter Logic
function filterBooks(category) {
    const cards = document.querySelectorAll(".book-card");
    const buttons = document.querySelectorAll(".tab-btn");

    buttons.forEach((btn) => {
        btn.classList.remove("active");
        if (btn.innerText.toLowerCase().includes(category))
            btn.classList.add("active");
    });

    cards.forEach((card) => {
        card.style.display = "none";
        if (card.classList.contains(category)) {
            card.style.display = "block";
        }
    });
}

// Counter Logic
const counters = document.querySelectorAll(".counter");
const startCounters = () => {
    counters.forEach((counter) => {
        const updateCount = () => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText.replace(/,/g, "");
            const inc = target / 200;
            if (count < target) {
                counter.innerText = Math.ceil(count + inc).toLocaleString();
                setTimeout(updateCount, 15);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };
        updateCount();
    });
};

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                startCounters();
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.5 },
);
observer.observe(document.querySelector(".stats-grid"));
