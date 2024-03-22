const sidebarToggle = document.querySelector("#sidebar-toggle");
if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("collapsed");
    });
}

document.querySelector("#theme-toggle").addEventListener("click", () => {
    toggleLocalStorage();
    toggleRootClass();
});

function toggleRootClass() {
    const currentTheme = document.documentElement.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-bs-theme', newTheme);
    toggleLocalStorage(newTheme);
}

function toggleLocalStorage(theme) {
    localStorage.setItem('theme', theme);
}

function applyInitialTheme() {
    const savedTheme = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
    if(savedTheme === 'light'){
        document.getElementById("theme-toggle").innerHTML = '<i class="fa-regular fa-moon"></i>';
    } else {
        document.getElementById("theme-toggle").innerHTML = '<i class="fa-regular fa-sun"></i>';
    }
}

applyInitialTheme();
